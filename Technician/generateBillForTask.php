<?php
    $status = $_POST['status'];
    $ticketId = $_POST['ticketId'];
    $serviceType = $_POST['serviceType'];

    $conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bc292174f8cae7", "68916e25", "heroku_a43ceec7a5c075b");
    //$conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bbd12ae4b2fcc3", "df9ea7aa", "heroku_80d6ea926f679b3");
    //$conn = mysqli_connect("localhost", "root", "", "fyp");
    
    
    if($conn) {
        $sql = "UPDATE ticket SET `STATUS` = '".$status."' WHERE ID = '".$ticketId."'";
        $res = mysqli_query($conn, $sql);
       if($res) {
            echo "Successfully updated ticket";
        }
    } else echo "Connection failed";


    $sql1 = "select t.TYPE, t.HOMEOWNER, t.SERVICEDATE, s.RATE 
    from ticket t inner join servicerate s 
    on t.TYPE = s.SERVICE 
    where t.ID = $ticketId and 
    s.EFFECTDATE = (SELECT MAX(s.EFFECTDATE) from servicerate s where s.SERVICE = $serviceType);";

    if($conn) {
        $res1 = mysqli_query($conn, $sql1);
        if($res1) {
            $count = 0;
            while($row = mysqli_fetch_assoc($res1)) {
                if($count == 0) {
                    $type = $row['TYPE'];  
                    $homeowner = $row['HOMEOWNER'];
                    $serviceDate = $row['SERVICEDATE'];
                    $serviceRate = $row['RATE'];
                    echo "Service Date: " + $serviceDate;
                    $count++;
                    $sql2 = "insert into bill (BILLINGDATE, HOMEOWNER, SERVICE, AMOUNT)  VALUES ($serviceDate, $homeowner, $type, $serviceRate)";

                    $res2 = mysqli_query($conn, $sql2);
                    if($res2) {
                        echo "Successfully inserted bill";
                    } else echo "Having trouble inserting the data into bill table";
                } 
            } 
        } else echo "Having trouble fetching the data for generating bill";
    } else echo "Connection failed";
?>
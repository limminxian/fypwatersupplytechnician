<?php include_once 'conn.php';
    $status = $_POST['status'];
    $ticketId = $_POST['ticketId'];
    $serviceType = $_POST['serviceType'];

    $conn = getDB();
    
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
                    $count++;
                    $sql2 = "insert into bill (BILLINGDATE, HOMEOWNER, SERVICE, AMOUNT) values ('".$serviceDate."', '".$homeowner."', '".$type."', '".$serviceRate."')";
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2) {
                        echo "Successfully inserted bill";
                    } else echo "Having trouble inserting the data into bill table";
                } 
            } 
        } else echo "Having trouble fetching the data for generating bill";
    } else echo "Connection failed";
?>
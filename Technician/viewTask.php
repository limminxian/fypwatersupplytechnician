<?php
    $conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bc292174f8cae7", "68916e25", "heroku_a43ceec7a5c075b");
    //$conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bbd12ae4b2fcc3", "df9ea7aa", "heroku_80d6ea926f679b3");
    //$conn = mysqli_connect("localhost", "root", "", "fyp");
    if($conn){
        $ticketID = $_GET['ticketID'];
        $sql = "select h.STREET, h.BLOCKNO, h.UNITNO, h.POSTALCODE, h.AREA, h.ID as HOMEOWNERID, u.NAME, t.STATUS, t.DESCRIPTION, k.NAME as SERVICETYPE, t.ID, a.ID as TASKID
            from users u 
            inner join homeowner h on u.ID = h.ID
            inner join ticket t on h.ID = t.HOMEOWNER
            inner join servicetype k on t.TYPE = k.ID
            where t.ID = '$ticketID'";

        $res = mysqli_query($conn, $sql);
        $tasks = array();
        if($res) {
            while($row = mysqli_fetch_assoc($res)) {
                $tasks[] = array("status" => "success", "message" => "Data fetched", "STREET" => $row['STREET'], "BLOCKNO" => $row['BLOCKNO'], "UNITNO" => $row['UNITNO'], "POSTALCODE" => $row['POSTALCODE'], 
                "AREA" => $row['AREA'], "NAME" => $row['NAME'], "STATUS" => $row ['STATUS'], "DESCRIPTION" => $row['DESCRIPTION'], "SERVICETYPE" => $row['SERVICETYPE'], "ID" => $row['ID'], "TASKID" => row['TASKID'], "HOMEOWNERID" => row['HOMEOWNERID']);
            }
        } else $tasks = array("status" => "failed", "message" => "Having trouble fetching the data");
    } else $tasks = array("status" => "failed", "message" => "Database connection failed");
    echo json_encode(array("tasks" => $tasks), JSON_PRETTY_PRINT);
?>
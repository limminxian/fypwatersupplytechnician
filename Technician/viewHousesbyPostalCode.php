<?php
    $conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bc292174f8cae7", "68916e25", "heroku_a43ceec7a5c075b");
    //$conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bbd12ae4b2fcc3", "df9ea7aa", "heroku_80d6ea926f679b3");
    //$conn = mysqli_connect("localhost", "root", "", "fyp");
    if($conn) {
        #hdb-apartment - unit # & id
        #landed - street & id
        $postalCode = $_GET['postalCode'];
        $sql = "select h.ID, STREET, UNITNO, HOUSETYPE
            from homeowner h
            inner join company c on h.SUBSCRIBE = c.ID
            where POSTALCODE = '$postalCode'";
        $res = mysqli_query($conn, $sql);
        $addresses = array(); 
        if($res) {
            while($row = mysqli_fetch_assoc($res)) {
                $addresses[] = array("status" => "success", "message" => "Data fetched", "ID" => $row['ID'], "STREET" => $row['STREET'], 
                 "UNITNO" => $row['UNITNO'], "HOUSETYPE" => $row['HOUSETYPE']);
            } 
        } else $addresses = array("status" => "failed", "message" => "Having trouble fetching the data");
    } else $addresses = array("status" => "failed", "message" => "Database connection failed");
    echo json_encode(array("addresses" => $addresses), JSON_PRETTY_PRINT);
?>
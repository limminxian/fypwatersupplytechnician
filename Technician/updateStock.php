<?php
if (!empty($_POST['serial'])) {
    $conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bc292174f8cae7", "68916e25", "heroku_a43ceec7a5c075b");
    //$conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bbd12ae4b2fcc3", "df9ea7aa", "heroku_80d6ea926f679b3");
    //$conn = mysqli_connect("localhost", "root", "", "fyp");
    $serial = $_POST['serial'];
    if($conn) {
        $sql = "insert into equipment (EQUIPMENT) values ('".$serial."')";
        $res = mysqli_query($conn, $sql);
        if($res) {
            echo "Equipment row is added";
        }
    } else echo "Connection failed";
} else echo "Serial is null";
?>
<?php
if (!empty($_POST['serial']) && !empty($_POST['homeownerId']) && !empty($_POST['taskId'])) {
    $conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bc292174f8cae7", "68916e25", "heroku_a43ceec7a5c075b");
    //$conn = mysqli_connect("us-cdbr-east-06.cleardb.net", "bbd12ae4b2fcc3", "df9ea7aa", "heroku_80d6ea926f679b3");
    //$conn = mysqli_connect("localhost", "root", "", "fyp");
    $serial = $_POST['serial'];
    $homeownerId = $_POST['homeownerId'];
    $taskId = $_POST['taskId'];
    $serviceType = $_POST['serviceType'];

    if($conn) {
        if($serviceType == "installation") {
            $sql = "insert into equipment (EQUIPMENT, HOMEOWNER, INSTALLTASK) values ('".$serial."', '".$homeownerId."', '".$taskId."')";
        } else echo "Installation row cannot be added";
        if($serviceType == "uninstallation") {
            $sql = "insert into equipment (EQUIPMENT, HOMEOWNER, UNINSTALLTASK) values ('".$serial."', '".$homeownerId."', '".$taskId."')";
        } else echo "Uninstallation row cannot be added";
        $res = mysqli_query($conn, $sql);
        if($res) {
            echo "Equipment row is added";
        }
    } else echo "Connection failed";
} else echo "Serial, HomeownerID and taskID is null";
?>
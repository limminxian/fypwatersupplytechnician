<?php include_once 'conn.php'; 
function getDB(){
  
//Database 1
  $hostName = "us-cdbr-east-06.cleardb.net";
  $username = "bc292174f8cae7";
  $password = "68916e25";
  $db = "heroku_a43ceec7a5c075b";
  $port = "";
  
//Database 2
  // $hostName = "us-cdbr-east-06.cleardb.net";
  // $username = "bcd6f3dd4c4cab";
  // $password = "ec185dd8";
  // $db = "heroku_f92e6718b416bf8";
  // $port = "";
  
  $connection = mysqli_connect($hostName, $username, $password, $db);
  return $connection;
}
?>
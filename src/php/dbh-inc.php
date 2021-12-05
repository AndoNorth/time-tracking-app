<?php
// database credentials
$serverName = "localhost";
$dbUserName = "mysqluser";
$dbPassword = "password123";
$dbName = "list_database";
// connect to db
$conn = createConnectionToDB($serverName, $dbUserName, $dbPassword, $dbName);
/* create connetion to DB */
function createConnectionToDB($serverName, $dbUserName, $dbPassword, $dbName){
    $conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

    if(mysqli_connect_errno()){
        echo "error connecting :" . mysqli_connect_error() . "\n";
        exit();
    }
    else {
        echo "connection successful\n";
        return $conn;
    }
}
?>
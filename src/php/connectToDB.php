<?php
/* connectToDB
*  brief: this tests connection to DB, and POST request data
*/
// database credentials
$serverName = "localhost";
$userName = "mysqluser";
$password = "password123";
$dbName = "test";
// test connections
createConnectionToDB1($serverName, $userName, $password, $dbName);
createConnectionToDB2($serverName, $userName, $password, $dbName);

/* create connetion to DB - method 1 */
function createConnectionToDB1($serverName, $userName, $password, $dbName){
    $conn = mysqli_connect($serverName, $userName, $password, $dbName);

    if(mysqli_connect_errno()){
        echo "error connecting : " . mysqli_error() . "\n";
        exit();
    }
    else {
        echo "connection successful\n";
        checkPOSTIntegrity();
    }
}

/* create connetion to DB - method 2 */
function createConnectionToDB2($serverName, $userName, $password, $dbName){
    try {
        $conn = new PDO("mysql:host=$serverName;dbName=$dbName", $userName, $password);
    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "connection successful\n";
        checkPOSTIntegrity();
    }
    catch (PDOException $error) {
        echo "error connecting : " . $error->getMessage() . "\n";
    }
}

/* check POST data (body) */
function checkPOSTIntegrity(){
    // check if request is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        // check if POST request has POST data
        if(isset($data)) {
            foreach($data as $key => $value){
                echo "POST body: key : $key, value : $value\n";
            }
        }
        else{
            echo "error: empty POST request\n";
        }
    }
    else{
        echo "error: not POST request\n";
    }
}
?>
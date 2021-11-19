<?php
/* addListItemToDB
*  brief: from POST request make query to add list-item to DB
*/
// database credentials
$serverName = "localhost";
$userName = "mysqluser";
$password = "password123";
$dbName = "test";
// test connection & POST data integrity
$data = checkPOSTIntegrity();
$conn = createConnectionToDB($serverName, $userName, $password, $dbName);
addListItemToDB(convertDataToQuery($data));

/* create connetion to DB */
function createConnectionToDB($serverName, $userName, $password, $dbName){
    $conn = mysqli_connect($serverName, $userName, $password, $dbName);
    if(mysqli_connect_errno()){
        exit("error connecting : " . mysqli_error() . "\n");
    }
    else {
        echo "connection successful\n";
        return $conn;
    }
}

/* query DB */
function runQuery($conn, $query) {
    $run = mysqli_query($conn, $query) or die(mysqli_error());
    if($run){
        echo "list item added\n";
    }
    else {
        echo "query error : " . mysqli_error() . "\n";
    }
}

/* check POST integrity */
function checkPOSTIntegrity(){
    // check if request is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        // check if POST request has POST data
        if(isset($data)) {
            checkDataIntegrity($data);
            return $data;
        }
        else{
            exit("error: empty POST request\n");
        }
    }
    else{
        exit("error: not POST request\n");
    }
}

/* check POST data(body) is correct for DB */
function checkDataIntegrity($data){
    // gettype(value) - returns string
    foreach($data as $key => $value){
        echo "POST body: key : $key, value : $value\n";
    }
}

/* parse data to query string */
function parseDataToQueryString($data){
return $query;
}
?>
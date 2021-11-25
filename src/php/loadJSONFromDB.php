<?php
/* addJSONToDB
*  brief: from POST request make query to load test data from DB
*/
// database credentials
$serverName = "localhost";
$userName = "mysqluser";
$password = "password123";
$dbName = "test";
// connectToDB and load table data
$data = checkPOSTIntegrity();
$conn = createConnectionToDB($serverName, $userName, $password, $dbName);
var_dump($data);
$query = parseDataToQueryString($data);
$run = runQuery($conn, $query);
showQueryData($run);
$conn->close();

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
        echo "data loaded from DB\n";
        return $run;
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
    echo "test POST body: \n";
    // gettype(value) - returns string
    foreach($data as $key => $value){
        echo "key : $key, value : $value\n";
    }
}

/* parse data to query string */
function parseDataToQueryString($data){
    $keys = join(', ',array_keys($data));
    $table = "test";
    $query = "SELECT $keys FROM $table";
    echo "mySQL Query: $query\n";
    return $query;
}

/* echo query data */
function showQueryData($run){
    if($run->num_rows > 0){ // mysqli_num_rows($run) > 0
        // output data of each row
        while($row = $run->fetch_assoc()){ // $row = mysqli_fetch_assoc($run)
            echo "id:".$row["id"].
            " - firstName: ".$row["firstName"].
            " - lastName: ".$row["lastName"].
            " - age: ".$row["age"]."\n";
        }
    }
    else{
        echo "database is empty\n";
    }
}
?>
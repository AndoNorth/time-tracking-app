<?php
/* addListItemToDB
*  brief: from POST request make query to add list-item to DB
*/
// database credentials
$serverName = "localhost";
$userName = "mysqluser";
$password = "password123";
$dbName = "test";
$secret = 'SpicyRice';// JWT secret
// test connection & POST data integrity
$data = checkPOSTIntegrity();
$conn = createConnectionToDB($serverName, $userName, $password, $dbName);
var_dump($data);
$query = parseDataToQueryString($data);
runQuery($conn, $query);
$conn->close();
/** generic database iterface **/
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
        echo "query successful\n";
    }
    else {
        echo "query error : " . mysqli_error() . "\n";
    }
}
/** Data validation **/
/* check request type */
function checkRequestType(){
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
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
        // request JWT
    }
    else{
        exit("error: bad request\n");
    }
}
/* loop through data */
function dataValidation($data){
    // gettype(value) - returns string
    foreach($data as $key => $value){
        echo "key : $key, value : $value\n";
    }
}
/** Create database queries **/
/* parse data to query string */
function parseDataToQueryString($data){
    $keys = join(', ',array_keys($data));
    $valuesArray = array_values($data);
    $values = '';
    foreach($valuesArray as $value)
    {
      $type = gettype($value);
      if($values)
      {
        $values = $values.', ';
      }
      if( $type == 'string' )
      {
        $values = $values.'"'.$value.'"';
      }
      elseif( $type == 'integer' )
      {
        $values = $values.$value;
      }
      else 
      {
        echo 'error: wrong type';
      }
    }
    $table = "test";
    $query = "INSERT INTO $table ($keys) VALUES($values);";
    echo "mySQL Query: $query\n";
return $query;
}
/** User authentication **/
/* validate login credentials */
function validateLoginCredentials(){
    // loop through
}
/** JWT **/
/* create JWT for user - SHA256 encoding */
function createJWT($username, $userid, $secret){
    $header = json_encode(['typ'=>'JWT', 'alg'=>'HS256']); // { "typ": "JWT",   "alg": "HS256" }
    $payload = json_encode(['username' => $username, 'userid' => $userid]); // { "username": "Jamal", "userid": 0}
    $utf8header = utf8_encode($header);
    $utf8payload = utf8_encode($payload);
    $base64Header = base64_encode($utf8header);
    $base64Payload = base64_encode($utf8payload);
    $signature = hash_hmac('sha256', $base64Header . "." . $base64Payload, $secret, true);
    $base64Signature = base64_encode($signature);
    $jwt = $base64Header . "." . $base64Payload . "." . $base64Signature;
    return $jwt;
}
/* decode JWT token */
function decodeJWT($token, $secret){
    list($base64header, $base64payload, $base64signature) = explode('.', $token);
    $utf8header = base64_decode($base64header);
    $utf8payload = base64_decode($base64payload);
    $jsonheader = utf8_decode($utf8header);
    $jsonpayload = utf8_decode($utf8payload);
    $header = json_decode($jsonheader);
    $payload = json_decode($jsonpayload);
    $jwtSignatureRef = hash_hmac('sha256', $base64Header . "." . $base64Payload, $secret, true);
    $jwtValid = strcmp($base64signature, $jwtSignatureRef);
    return $jwtValid;
}
?>
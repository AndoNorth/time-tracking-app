<?php
/* addListItemToDB
*  brief: from POST request make query to add list-item to DB
*/
// database credentials
$serverName = "localhost";
$userName = "mysqluser";
$password = "password123";
$dbName = "test";
$secret = 'spicyrice';// JWT secret
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
    $payload = json_encode(['username' => $username]); // { "username": "Jamal" }
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    return $jwt;
}
/* decode JWT token */
function decodeJWT($JWT, $secret){
    $jsonObject = base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1])));
    $decodedJWT = json_decode($jsonObject);
    // return yes or no
}
?>
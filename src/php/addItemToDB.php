<?php
/* addListItemToDB
*  brief: from POST request make query to add list-item to DB
*/
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_start();
    // initialise variables
    $userid=$_COOKIE['userid'];
    if(isset($userid)){
        $userid=$_SESSION['userid'];
    }
    $data = json_decode(file_get_contents('php://input'), true);
    $itemName=$data['item-name'];
    $tag=$data['tag'];
    $desc=$data['item-desc'];
    $timestamps=$data['time-stamps'];
    require_once 'addItemToDB-inc.php';
    // error handling for data, !== false, if anything besides false then go into braces
    if(emptyListItem($userid, $itemName, $tag, $desc, $timestamps) !== false){
        http_response_code(400);
        exit("error: bad request");
    }
    require_once 'dbh-inc.php';
    if(userIdExists($conn, $userid) !== false){
        http_response_code(400);
        exit("error: userid doesnt exist");
    }
    // add list item
    if(listItemExists($conn, $userid, $itemName, $tag, $desc) !== false){
        // list item exists move on
    }
    else{
        // attempt to add a list item
        if(addListItemToDb($conn, $userid, $itemName, $tag, $desc) !== false){
            http_response_code(500);
            exit("error: listItem could not be added");
        }
    }
    // add time stamp
    foreach($timestamps as $timestamp){
        $startTime = $timestamp['startTime'];
        $endTime = $timestamp['endTime'];
        if(timeStampExists($conn, $userid, $itemName, $tag, $desc, $startTime, $endTime) !== false){
            http_response_code(400);
            exit("error: timeStamp already exists");
        }
        if(addTimeStampToDb($conn, $userid, $itemName, $tag, $desc, $startTime, $endTime) !== false){
            http_response_code(400);
            exit("error: timeStamp could not be added");
        }
        else{
            http_response_code(201);
            exit();
        }
    }
} else {
    http_response_code(400);
    exit("error: bad request - not POST");
}
?>
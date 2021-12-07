<?php
/* addListItemToDB
*  brief: from POST request make query to add list-item to DB
*/
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // initialise variables
    $userid=$_POST['userid'];
    $itemName=$_POST['itemName'];
    $tag=$_POST['tag'];
    $desc=$_POST['desc'];
    $timestamps=$_POST['timestamps'];
    require_once 'addItemToDB-inc.php';
    // error handling for data
    if(emptyInputSignup($userid, $itemName, $tag, $desc, $timestamps) !== false){
        exit("error: bad request");
    }
    if(userIdExists !== false){
        exit("error: userid doesnt exist");
    }
    require_once 'dbh-inc.php';
    if(listItemExists($userid, $itemName, $tag, $desc) !== false){
        if(addListItemToDb($userid, $itemName, $tag, $desc) !== false){
            exit("error: listItem could not be added");
        }
    }
    // check whether time stamp exists
        // add time stamps to db
} else {
    exit("error: bad request");
}
?>
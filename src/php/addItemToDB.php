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
    if(emptyInputSignup($userid, $itemName, $tag, $desc, $timestamps) !== false){
        exit("error: bad request");
    }
    if(userIdExists){
        
    }
    require_once 'addItemToDB-inc.php';
    // error handling for data
    require_once 'dbh-inc.php';
    // addListItemToDb();
} else {
    exit("error: bad request");
}
?>
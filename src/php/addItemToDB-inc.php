<?php
/* error handling */
function emptyListItem($userid, $itemName, $tag, $desc){
    $result;
    if(empty($userid) || empty($itemName) ||
    empty($tag) || empty($desc) ||
    empty($timestamps)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function userIdExists($conn, $userid){
    $sql = "SELECT * FROM list_users WHERE userId = ?;";
    $stmt = mysqli_stmt_init($conn); // use prepared statements to make query
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "i", $userid); // i = int
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return true;
    }
    else{
        return false;
    }
}
// does list item exist in DB
function listItemExists($userid, $itemName, $tag, $desc){
    $sql = "SELECT * FROM list_items WHERE (userId, itemName, Tag, Description) = (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "isss", $userid, $itemName, $tag, $desc); // i = int
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return true;
    }
    else{
        return false;
    }
}
// does time stamp exist in DB
function timeStampExists($userid, $itemName, $tag, $desc, $startTime, $endTime){
    $sql = "SELECT * FROM list_items WHERE (userId, itemName, Tag, Description, startTime, endTime) = (?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "isssss", $userid, $itemName, $tag, $desc, $startTime, $endTime);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return true;
    }
    else{
        return false;
    }
}
/* interact with DB */
// add list item to DB
function addListItemToDb($userid, $itemName, $tag, $desc){
    $sql = "INSERT INTO list_items (userId, itemName, Tag, Description) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "isss", $userid, $itemName, $tag, $desc); // ssss = string string string string
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}
// add time stamp to DB
function addTimeStampToDb($userid, $itemName, $tag, $desc, $startTime, $endTime){
    $sql = "INSERT INTO list_items (userId, itemName, Tag, Description, startTime, endTime) VALUES (?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "isssss", $userid, $itemName, $tag, $desc, $startTime, $endTime); // ssss = string string string string
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}
?>
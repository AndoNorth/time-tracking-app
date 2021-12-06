<?php
// error handling
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
// add list item to DB
function addListItemToDb($userid, $itemName, $tag, $desc){
    $sql = "INSERT INTO list_users (userId, itemName, Tag, Description) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssss", $userid, $itemName, $tag, $desc); // ssss = string string string string
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /src/php/signup.php?error=none");
    exit();
}
?>
<?php
/* error handling - return true if error */
function emptyListItem($userid, $itemName, $tag, $desc, $timestamps){
    $result;
    if(empty($userid) || empty($itemName) ||
    empty($tag) || empty($desc) ||
    empty($timestamps)) {
        echo "$userid, $itemName, $tag, $desc, $timestamps\n";
        $result = true;
    }
    else {
        foreach($timestamps as $timestamp){
            foreach($timestamp as $stamp){
                if(empty($stamp)){
                    $result = true;
                }
                else{
                    $result = false;
                }
            }
        }
    }
    return $result;
}
function userIdExists($conn, $userid){
    $sql = "SELECT * FROM list_users WHERE userId = ?;";
    $stmt = mysqli_stmt_init($conn); // use prepared statements to make query
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return true;
    }
    mysqli_stmt_bind_param($stmt, "i", $userid); // i = int
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return false;
    }
    else{
        return true;
    }
}
// does list item exist in DB
function listItemExists($conn, $userid, $itemName, $tag, $desc){
    $sql = "SELECT * FROM list_items WHERE (userId, itemName, Tag, Description) = (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return true;
    }
    mysqli_stmt_bind_param($stmt, "isss", $userid, $itemName, $tag, $desc); // i = int
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return false;
    }
    else{
        return true;
    }
}
// does time stamp exist in DB
function timeStampExists($conn, $userid, $itemName, $tag, $desc, $startTime, $endTime){
    // STR_TO_DATE(?, '%Y-%m-%dT%H:%i:%sZ'), CAST(? AS DATETIME)
    $sql = "SELECT * FROM list_timestamps WHERE (userId, itemName, Tag, Description, startTime, endTime) = (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return true;
    }
    $format = 'Y-m-d\TH:i:s\Z'; // ISO8601 format
    //$format = 'Y-m-d H:i:s'; // mysql format
    //date($format, strtotime($string)), DateTime::createFromFormat($format, $string);
    $stime = strtotime($startTime);
    $etime = strtotime($endTime);
    $sstime = date($format, $stime);
    $eetime = date($format, $etime);
    mysqli_stmt_bind_param($stmt, "isssss", $userid, $itemName, $tag, $desc, $sstime, $eetime);
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
function addListItemToDb($conn, $userid, $itemName, $tag, $desc){
    $sql = "INSERT INTO list_items (userId, itemName, Tag, Description) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return true;
    }
    mysqli_stmt_bind_param($stmt, "isss", $userid, $itemName, $tag, $desc); // ssss = string string string string
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return false;
}
// add time stamp to DB
function addTimeStampToDb($conn, $userid, $itemName, $tag, $desc, $startTime, $endTime){
    // STR_TO_DATE(?, '%Y-%m-%dT%H:%i:%sZ'), CAST(? AS DATETIME)
    $sql = "INSERT INTO list_timestamps (userId, itemName, Tag, Description, startTime, endTime) VALUES (?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        return true;
    }
    $format = 'Y-m-d\TH:i:s\Z'; // ISO8601 format
    $format = 'Y-m-d H:i:s'; // mysql format
    //date($format, strtotime($string)), DateTime::createFromFormat($format, $string);
    $stime = strtotime($startTime);
    $etime = strtotime($endTime);
    $sstime = date($format, $stime);
    $eetime = date($format, $etime);
    mysqli_stmt_bind_param($stmt, "isssss", $userid, $itemName, $tag, $desc, $sstime, $eetime); // ssss = string string string string
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return false;
}
?>
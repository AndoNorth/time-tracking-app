<?php
// error handling functions
function emptyInputSignup($firstName, $lastName, $email, $username, $pwd, $pwdRepeat){
    $result;
    if(empty($firstName) || empty($lastName) ||
    empty($email) || empty($username) ||
    empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function invalidName($name){
    $result;
    // regular expression to only allow letters and numbers
    if(!preg_match("/^[a-zA-Z]*$/", $name)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function invalidUid($username){
    $result;
    // regular expression to only allow letters and numbers
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email){
    $result;
    // built in php function
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd, $pwdRepeat){
    $result;
    if($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function uidExists($conn, $username){
    $result;
    $sql = "SELECT * FROM list_users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn); // use prepared statements to make sign up form secure
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: /src/php/signup.php?error=stmtfaileduid");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username); // ss = string string, if more add more others exist
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        // for login form
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function emailExists($conn, $email){
    $result;
    $sql = "SELECT * FROM list_users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn); // use prepared statements to make sign up form secure
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: /src/php/signup.php?error=stmtfailedemail");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email); // ss = string string, if more add more others exist
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        // for login form
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function createUser($conn, $firstName, $lastName, $email, $username, $pwd){
    $result;
    $sql = "INSERT INTO list_users (firstName, lastName, usersEmail, usersUid, usersPwd) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn); // use prepared statements to make sign up form secure
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: /src/php/signup.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $email, $username, $hashedPwd); // ss = string string, if more add more others exist
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /src/php/signup.php?error=none");
    exit();
}
function emptyInputLogin($username, $pwd){
    $result;
    if(empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username);
    if($uidExists===false){
        $uidExists = emailExists($conn, $username);
        if($uidExists===false){
            header('location: /src/php/login.php?error=wronglogin');
            exit();
        }
    }
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    if($checkPwd === false){
        header('location: /src/php/login.php?error=wronglogin');
        exit();        
    }
    else if ($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header('location: /');
        exit();
    }
}
?>
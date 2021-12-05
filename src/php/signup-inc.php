<?php
// check if request to this page was a submit request
if(isset($_POST["submit"])){
    // get the variables passed by submit
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
    // includes
    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';
    // error handling - (!--false, if anything besides false then throw error)
    if(emptyInputSignup($firstName, $lastName, $email, $username, $pwd, $pwdRepeat) !== false){
        header("location: /src/php/signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($username) !== false){
        header("location: /src/php/signup.php?error=invaliduid");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: /src/php/signup.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: /src/php/signup.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn, $username) !== false){
        header("location: /src/php/signup.php?error=usernametaken");
        exit();
    }
    if(emailExists($conn, $email) !== false){
        header("location: /src/php/signup.php?error=emailtaken");
        exit();
    }
    // if no errors - create user
    createUser($conn, $firstName, $lastName, $email, $username, $pwd);
} else {
    header("location: /src/php/signup.php"); // send user back to signup.php
    exit();
}
?>
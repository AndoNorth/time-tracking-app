<?php
if(isset($_POST['submit'])){
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    // error handling - (!--false, if anything besides false then throw error)
    if(emptyInputLogin($username, $pwd) !== false){
        header("location: /src/php/login.php?error=emptyinput");
        exit();
    }
    loginUser($conn, $username, $pwd);
}
else{
    header('location: /src/php/login.php');
}
?>
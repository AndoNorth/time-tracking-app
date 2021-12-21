<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/css/website_stylesheet.css">
    <link rel="icon" href="/src/time_tracking_16x16.ico"/>
    <title>Time Tracking App</title>
</head>
<body>
    <div class="page">
<header>
    <h1>Time Tracking App</h1>
    <ul>
        <li><a href="/">Home</a></li>
        <?php
        if( isset($_SESSION["useruid"]) || isset($_COOKIE["userid"]) ){
            echo '<li><a href="/src/php/profile.php">Profile</a></li>';
            echo '<li><a href="/src/php/logout-inc.php">Log out</a></li>';          
        } else {
            echo '<li><a href="/src/php/signup.php">Sign up</a></li>';
            echo '<li><a href="/src/php/login.php">Log in</a></li>';
        }
        ?>
    </ul>
</header>
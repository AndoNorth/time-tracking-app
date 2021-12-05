<?php include_once 'header.php';?>
<section class="page-contents">
    <div class="login-form">
        <form action="login-inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email...">
            <input type="password" name="pwd" placeholder="Password...">
            <button type="submit" name="submit">Log In</button>
        </form>
    </div>
</section>
<?php include_once 'footer.php';?>
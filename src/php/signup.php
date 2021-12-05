<?php include_once 'header.php';?>
<div class="page-contents">
    <div class="signup-form-form">
        <form action="signup-inc.php" method="post">
            <input type="text" name="name" placeholder="Full Name...">
            <input type="text" name="email" placeholder="Email...">
            <input type="text" name="uid" placeholder="Username...">
            <input type="password" name="pwd" placeholder="Password...">
            <input type="password" name="pwdrepeat" placeholder="Repeat password...">
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
</div>
<?php include_once 'footer.php';?>
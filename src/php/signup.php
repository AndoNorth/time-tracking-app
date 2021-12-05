<?php include_once 'header.php';?>
<div class="page-contents">
    <section class="signup-form">
        <form action="/src/php/signup-inc.php" method="post">
            <input type="text" name="firstName" placeholder="First Name...">
            <input type="text" name="lastName" placeholder="Last Name...">
            <input type="text" name="email" placeholder="Email...">
            <input type="text" name="uid" placeholder="Username...">
            <input type="password" name="pwd" placeholder="Password...">
            <input type="password" name="pwdRepeat" placeholder="Repeat password...">
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </section>
</div>
<?php include_once 'footer.php';?>
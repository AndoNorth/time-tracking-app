<?php include_once 'header.php';?>
<section class="page-contents">
    <div class="login-form">
        <form action="login-inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email...">
            <input type="password" name="pwd" placeholder="Password...">
            <button type="submit" name="submit">Log In</button>
        </form>
        <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == 'emptyinput'){
                    echo "<p>Fill in all fields</p>";
                }
                if($_GET['error'] == 'wronglongin'){
                    echo "<p>Incorrect login details</p>";
                }
            }
        ?>
    </div>
</section>
<?php include_once 'footer.php';?>
<?php include_once 'php/header.php';?>
<div class="page-contents">
    <?php 
        if(isset($_SESSION["useruid"]) || isset($_COOKIE["userid"])){
            include_once 'php/time_tracking_app.php';
        }
        else{
            echo '<h1>login to view content</h1>';
        }
    ?>
</div>
<?php include_once 'php/footer.php';?>
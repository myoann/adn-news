<?php
session_start();
if (isset($_SESSION["USER_ID"]) && isset($_SESSION["EMAIL"])){
$USER_ID=$_SESSION['USER_ID'];
$EMAIL=$_SESSION['EMAIL'];
header("location: home.php");
}
?>
<!--
==============================
    IMPORT HEADER
==============================
-->
<?php include("./section/_header.php"); ?>

<!--
==============================
    CONTENT
==============================
-->
<div class="container">
    <div class="info">
        <h1>Flat Login Form</h1><span>Made with <i class="fa fa-heart"></i> by <a href="http://andytran.me">Andy Tran</a></span>
    </div>
</div>
<div class="form">
    <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
    <form class="form-horizontal register-form" role="form">

        <!-- First name input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="title"></label>
            <div class="col-md-4">
                <input id="title" name="title" type="text" placeholder="Title" class="form-control input-md">

            </div>
        </div>
        <div class="clearfix"></div>

        <!-- Last name input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="imagelink"></label>
            <div class="col-md-4">
                <input id="imagelink" name="imagelink" type="text" placeholder="Image's URL" class="form-control input-md">

            </div>
        </div>
        <div class="clearfix"></div>

        <!-- Email input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="description"></label>
            <div class="col-md-4">
                <input id="description" name="description" type="text" placeholder="Description" class="form-control input-md" required="">

            </div>
        </div>
        <div class="clearfix"></div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="link"></label>
            <div class="col-md-4">
                <input id="link" name="link" type="te" placeholder="Password (required)" class="form-control input-md" required="">

            </div>
        </div>
        <div class="clearfix"></div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="signup"></label>
            <div class="col-md-4">
                <button id="signup" name="signup" class="btn btn-primary">Sign Up</button>
            </div>
        </div>
    </form>
</div>
<video id="video" autoplay="autoplay" loop="loop" poster="polina.jpg">
    <source src="http://andytran.me/A%20peaceful%20nature%20timelapse%20video.mp4" type="video/mp4"/>
</video>

<!--
==============================
    IMPORT FOOTER
==============================
-->
<?php include("./section/_footer.php"); ?>
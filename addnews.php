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
<form class="form-horizontal" role="form">

    <!-- Title input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="title"></label>
        <div class="col-md-4">
            <input id="title" name="title" type="text" placeholder="Title" class="form-control input-md">

        </div>
    </div>
    <div class="clearfix"></div>

    <!-- Image Link input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="imagelink"></label>
        <div class="col-md-4">
            <input id="imagelink" name="imagelink" type="text" placeholder="Image's URL" class="form-control input-md">

        </div>
    </div>
    <div class="clearfix"></div>

    <!-- Description input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="description"></label>
        <div class="col-md-4">
            <input id="description" name="description" type="text" placeholder="Description" class="form-control input-md" required="">

        </div>
    </div>
    <div class="clearfix"></div>

    <!-- Link input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="link"></label>
        <div class="col-md-4">
            <input id="link" name="link" type="text" placeholder="Link" class="form-control input-md" required="">

        </div>
    </div>
    <div class="clearfix"></div>

    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="addnews"></label>
        <div class="col-md-4">
            <button id="addnews" name="addnews" class="btn btn-primary">Add a news</button>
        </div>
    </div>
</form>

<!--
==============================
    IMPORT FOOTER
==============================
-->
<?php include("./section/_footer.php"); ?>
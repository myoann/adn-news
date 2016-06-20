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
<?php
    if (isset($_GET['title_news'])){
        ?>
        <script>getNewsByTitle();</script>
        <?php
    }else{
        ?>
        <script>displayNews();</script>
        <?php
    }
?>
<section id="home">
    <div class="content"></div>
    <a id="bt_add_news" title="Add a news" class="fa fa-plus" href="addnews.php"></a>
</section>


<!--
==============================
    IMPORT FOOTER
==============================
-->
<?php include("./section/_footer.php"); ?>
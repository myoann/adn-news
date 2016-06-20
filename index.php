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

<!--
==============================
    IMPORT FOOTER
==============================
-->
<?php include("./section/_footer.php"); ?>

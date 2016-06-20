<?php
  session_start();

  if (isset($_SESSION["USER_ID"]) && isset($_SESSION["EMAIL"])){
    $USER_ID=$_SESSION['USER_ID'];
    $EMAIL=$_SESSION['EMAIL'];
    header("location: home.php");
  }else{
    // on redirige l'utilisateur vers la page de connexion
    //header("location: login.php");
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

    <!-- Email input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="email"></label>
      <div class="col-md-4">
        <input id="email" name="email" type="email" placeholder="Email" class="form-control input-md" required="">

      </div>
    </div>
    <div class="clearfix"></div>

    <!-- Password input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="pwd"></label>
      <div class="col-md-4">
        <input id="pwd" name="pwd" type="password" placeholder="Password" class="form-control input-md" required="">

      </div>
    </div>
    <div class="clearfix"></div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="signup"></label>
      <div class="col-md-4">
        <button id="login" name="login" class="btn btn-primary">Sign Up</button>
      </div>
    </div>
  </form>

<!-- 
==============================
    IMPORT FOOTER 
==============================
-->
<?php include("./section/_footer.php"); ?>
<?php include 'includes/header.php'; include 'includes/_facebookSDK.php'; include 'login.php';?>
<?php 
  if(isset($_SESSION['login_user'])){
    header("location: uploadPic.php");
  }
?>
<div id="fb-root"></div>
<div class="Head">
    <h1 id="hawkstagram">Hawkstagram</h1>
</div>
<div><?php include 'includes/nav.php'?></div>
<div class="overlay">
    <div class="container">
        <div id="boxes" class="col">
            <div class="IITSignIn form-box">
                <form action="uploadPic.php" method="post">
                    <div class="text-center">
                        <h2 id="loginIITHeader">Illinois Tech Login</h2>
                    </div>
                    <div class="form-group">
                        <!-- <label for="username" class="control-label">Username</label> -->
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <!-- <label for="Password" class="control-label">Username</label> -->
                        <input type="password" class="form-control" id="Password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-red" value="Login" id="username" name="register">
                    </div>
                </form>
            </div>

            <div class="outsideSign-In form-box">
                <h3>Not a Student?</h3>
                <div class="fb-login-button " data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="false"></div>
            </div>
        </div>

    </div>
</div>
</div>
</body>

</html>

<?php include 'includes/footer.php'; ?>

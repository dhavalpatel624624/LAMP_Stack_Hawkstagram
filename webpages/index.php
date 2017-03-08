<?php include 'includes/header.php';?>
<div class="Head">
    <h1 id="hawkstagram">Hawkstagram</h1>
</div>
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
                <form id="form2" "action="_logincheck.php" method="post">
                    <div class="text-center">
                        <h3 id="loginOutsideHeader">Not a Student?</h3>
                    </div>
                    <br><br>
                    <div class="colButton form-group">
                        <input type="submit" class="form-control btn btn-brown" value="Register">
                        <input type="submit" id="login" class="form-control btn btn-red" value="Login" id="username" name="login">
                    </div>
                    <?php if (isset($_GET['error'])): ?>
                        <p class="text-center text-danger bg-danger"><?= $_GET['error']; ?></p>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</html>

<?php include 'includes/footer.php'; ?>

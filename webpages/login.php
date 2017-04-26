<?php include 'includes/dbconnect.php';?>
<?php
  //references: https://www.formget.com/login-form-in-php/ 
  //http://stackoverflow.com/questions/29459814/redirect-to-another-page-based-on-user-type 
  session_start(); // Starting Session
  $error=''; // Variable To Store Error Message
  if (isset($_POST['register'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
      $error = "Username or Password is invalid";
    }
    else
    {
      // Define $username and $password
      $username=$_POST['username'];
      $password=$_POST['password'];
      // To protect MySQL injection for Security purpose
      $username = stripslashes($username);
      $password = stripslashes($password);
      $username = mysql_real_escape_string($username);
      $password = mysql_real_escape_string($password);
      // SQL query to fetch information of registerd users and finds user match.
      $query = mysql_query("select * from users where salted_password='$password' AND username='$username'", $slavedb);
      $rows = mysql_num_rows($query);
      if ($rows == 1) {
      $_SESSION['login_user']=$username; // Initializing Session
      header("location: uploadPic.php"); // Redirecting To Other Page
      } 
      else {
        $error = "Username or Password is invalid";
      }
    }
  }
?>
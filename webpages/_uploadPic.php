<?php include 'includes/header.php'; ?>
<?php
  if (isset($_POST['upload'])) {
      $title = $_POST['title'];
      $description = $_POST['description'];
  }
  $target = "photouploads/";
  $target = $target. basename($_FILES['photo']['name']);

  $tmpname = $_FILES['photo']['tmp_name'];
  move_uploaded_file($tmpname, $target);

  if (!empty($result)) {
      header('Location: profile.php');
  }else {
      echo "fail";
  }

?>
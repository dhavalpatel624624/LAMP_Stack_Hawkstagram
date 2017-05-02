<?php include 'includes/header.php'; ?>
<?php
  if (isset($_POST['upload'])) {
      $title = $_POST['title'];
      $description = $_POST['description'];
  }
  $tmpname = $_FILES['photo']['name'];
  $target = "photouploads/";
  $target = $target. basename($tmpname);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  //$query = ;

  move_uploaded_file($tmpname, $target);
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        echo 'Here is some more debugging info:';
        print_r($_FILES);

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($tmpname, $target_file)) {
                echo "The file " . basename($tmpname) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>
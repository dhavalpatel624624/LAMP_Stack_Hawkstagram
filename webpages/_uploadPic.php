<?php include 'includes/dbconnect.php';?>
<?php

//references for code:
//http://stackoverflow.com/questions/6106470/php-convert-a-blob-into-an-image-file
//http://php.net/manual/en/features.file-upload.post-method.php
//https://vikasmahajan.wordpress.com/2010/07/07/inserting-and-displaying-images-in-mysql-using-php/
//http://packetcode.com/article/preventing-sql-injection-php-security

// check if a file was submitted
if(!isset($_FILES['photo']))
{
    echo '<p>Please select a file</p>';
}
else
{
    try {
    $msg= upload();  //this will upload your image
    echo $msg;  //Message showing success or failure.
    }
    catch(Exception $e) {
    echo $e->getMessage();
    echo 'Sorry, could not upload file';
    }
}
if(isset($_POST['description'])){
  $unsafe_variable = $_POST['description'];
  $description = mysql_real_escape_string($unsafe_variable);
}
else {
  $description = '';
}

// the upload function

function upload() {
    $maxsize = 10000000; //set to approx 10 MB

    //check associated error code
    if($_FILES['photo']['error']==UPLOAD_ERR_OK) {

        //check whether file is uploaded with HTTP POST
        if(is_uploaded_file($_FILES['photo']['tmp_name'])) {

            //checks size of uploaded image on server side
            if( $_FILES['photo']['size'] < $maxsize) {

               //checks whether uploaded file is of image type
              //if(strpos(mime_content_type($_FILES['photo']['tmp_name']),"image")===0) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['photo']['tmp_name']),"image")===0) {
                  $uploaddir = '/var/www/uploads/';
                  $uploadfile = $uploaddir . basename($_FILES['photo']['name']);

                  if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {

                  // prepare the image for insertion
                  $imgData = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
                  $imgPath = mysql_real_escape_string($_FILES["photo"]["name"]);
                  $imgSize = mysql_real_escape_string($_FILES["photo"]["size"]);
                  mysql_select_db($dbname, $masterdb);
                  // put the image in the db...
                  // our sql query - STILL NEEDS TO HAVE A CORRECT USER_ID
                  $sql = "INSERT INTO photos
                  (user_id, caption, image_path, image_size, image)
                  VALUES
                  (4, '$description', '$imgPath','$imgSize', '$imgData')";

                  // insert the image
                  mysql_query($sql) or die("Error in Query: " . mysql_error());
                  $msg='<p>Image successfully saved in database with id ='. mysql_insert_id().' </p>';
                }
                else
                    $msg="<p>Uploaded file is not an image.</p>";
            }
             else {
                // if the file is not less than the maximum allowed, print an error
                $msg='<div>File exceeds the Maximum File limit</div>
                <div>Maximum File limit is '.$maxsize.' bytes</div>
                <div>File '.$_FILES['photo']['name'].' is '.$_FILES['photo']['size'].
                ' bytes</div><hr />';
                }
        }
        else{
            $msg="File not uploaded successfully.";
        }
    }
    else {
        $msg= file_upload_error_message($_FILES['photo']['error']);
    }
    return $msg;
}

// Function to return error message based on error code

function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}
?>
<?php include 'includes/header.php';

//$path_parts = pathinfo($_GET['file']);
$file_name  = 'Capture.PNG';
$file_path  = './photouploads/' . $file_name;
file_get_contents($file_path);

?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!--?php while($row = mysqli_fetch_object($result)): ?-->
            <div class="panel panel-info">
                <div class="panel-heading text-center"><h4><!--?= $row -> title ?--></h4></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <?php
                            echo '<img src="' . htmlspecialchars($file_path) . '"/>';
                        ?>
                    </div>
                </div>
                <!-- php $userid = $row -> user_id; ?>
             <!?php endwhile; ?-->
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <form  action="viewPic.php" method="post">
                                <div class="form-group">
                                    <label for="photo" class="control-label">Choose your photo:</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description of your Insta pic" rows="8" cols="40"></textarea>
                                </div>

                                <input type="submit" class="form-control btn btn-red" value="Download" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/header.php'; include 'includes/nav.php';?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panelHead text-center"><h2 id="photoUpload">Photo Upload</h2></div>
                <div class="panel-body">
                    <form class="" action="_uploadPic.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="photo" class="control-label">Choose Photos:</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>;
                        <div class="form-group">
                            <label for="description" class="control-label">Write Description:</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Where was this picture taken? What was the name of the event?" rows="8" cols="40"></textarea>
                        </div>
                        .<div class="form-group">
                            <input type="submit" class="form-control btn btn-brown" id="submit" name="upload" value="Upload your photo">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>

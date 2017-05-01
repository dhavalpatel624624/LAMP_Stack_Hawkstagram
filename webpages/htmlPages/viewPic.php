<?php include_once('galleryFrame/resources/UberGallery.php');

//$path_parts = pathinfo($_GET['file']);
$file_name  = 'Capture.PNG';
$file_path  = './photouploads/' . $file_name;
file_get_contents($file_path);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/navLoggedOut.css">
    <link rel="stylesheet" type="text/css" href="gallaryFrame/resources/colorbox/1/colorbox.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/rebase-min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
    <script type="text/javascript" src="resources/colorbox/jquery.colorbox.js"></script>
    <title>Hawkstagram</title>
</head>
<body>
<div class="Head">
    <h1 id="hawkstagram">Hawkstagram</h1>
</div>
<?php include 'includes/nav.php'?>
<div class="container">

    <?php $files = scandir('galleryFrame/galleries'); ?>
    <?php foreach ($files as $file): ?>

        <?php $dir = 'galleryFrame/galleries/' . $file; ?>

        <?php if (is_dir($dir) && $file != '.' && $file != '..'): ?>
            <h2 class="gallery"><?php echo ucwords($file); ?></h2>
            <?php $gallery = UberGallery::init()->createGallery($dir, $file); ?>
        <?php endif; ?>

    <?php endforeach; ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("a[rel='graduation']").colorbox({maxWidth: "90%", maxHeight: "90%", opacity: ".5"});
        $("a[rel='luncheon']").colorbox({maxWidth: "90%", maxHeight: "90%", opacity: ".5"});
        $("a[rel='misc']").colorbox({maxWidth: "90%", maxHeight: "90%", opacity: ".5"});
    });
</script>
<?php include 'includes/footer.php'; ?>
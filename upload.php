<?php
//------------------------------------------------------------------------------
//Upload images
//------------------------------------------------------------------------------
//initialize variables
$photoFileName = '';

$photoFileNameERROR = false;

$photoRecord = array();


if (isset($_POST["btnSubmit"])) {


    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["filArtwork"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["filArtwork"]["tmp_name"]);
        if ($check !== false) {
            echo 'File is an image - ' . $check["mime"] . '.';
            $uploadOk = 1;
        } else {
            $errorMsg[] = "File is not an image.";
            $photoFileNameERROR = true;
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {

        $errorMsg[] = 'Sorry, file already exists.';
        $photoFileNameERROR = true;
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["filArtwork"]["size"] > 500000) {
        $errorMsg[] = 'Sorry, your file is too large.';
        $photoFileNameERROR = true;
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $errorMsg[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        $photoExtERROR = true;
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo 'Sorry, your file was not uploaded.';
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["filArtwork"]["tmp_name"], $target_file)) {
            echo '<p id ="noErrorUpload">The file ' . basename($_FILES["filArtwork"]["name"]) . ' has been uploaded.</p>';

            $photoFileName = htmlentities(basename($_FILES["filArtwork"]["name"]), ENT_QUOTES, "UTF-8");
            $photoRecord[] = $photoFileName;
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    }
} else { // if button not pressed print upload form.
    ?>
    <form action="<?php PHP_SELF; ?>" method="post" enctype="multipart/form-data">
        <fieldset class="wrapper">
            Select image to upload:
            <input type="file" name="filArtwork" id="filArtwork">

            <?php
        }
        ?>

<?php
$targetDir = "../imgs/";
$targetFile = $targetDir . basename($_FILES["imgLink"]["name"]);

$uploadOk = 1;

$imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
  
    $check = getimagesize($_FILES["imgLink"]["tmp_name"]);
    if($check !== false) {
        $message = "<div>File is an image of type - " . $check["mime"] . ".</div>";
        $uploadOk = 1;
    } else {
        $message = "<div>File is not an image.</div>";
        $uploadOk = 0;
    }
}

if($imageFileType != "jpg" && $imageFileType != "png") {
    $message = "<div> Only jpg and png files are allowed </div>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    $message = "<div>The file was not uploaded.</div>";
} else { // upload file
    if (move_uploaded_file($_FILES["imgLink"]["tmp_name"], $targetFile)) {
        $message = "<div>The file ". basename( $_FILES["imgLink"]["name"]). " has been uploaded.</div>";
    } else {
        $message = "<div>Error uploading your file.</div>";
    }
}
?>
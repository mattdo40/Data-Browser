<?php
$targetDir = "../imgs/";
$target_file = $targetDir . basename($_FILES["imgLink"]["name"]);

echo "<p>Upload information</p><ul>";
echo  "<li>Target folder for the upload :". $target_file . "</li>";
echo  "<li>File name :". basename($_FILES["imgLink"]["name"]) . "</li>";
// basename: Returns the base name of the given path

$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
  
    $check = getimagesize($_FILES["imgLink"]["tmp_name"]);
    if($check !== false) {
        $message = "<li>File is an image of type - " . $check["mime"] . ".</li>";
        $uploadOk = 1;
    } else {
        $message = "<li>File is not an image.</li>";
        $uploadOk = 0;
    }
}
// Verify if file already exists
if (file_exists($target_file)) {
    $message = "<li>The file already exists.</li>";
    $uploadOk = 0;
}
// Verify the file size
if ($_FILES["imgLink"]["size"] > 500000) {
    $message = "<li>The file is too large.</li>";
    $uploadOk = 0;
}
// Verify certain file formats
if($imageFileType != "jpg" && $imageFileType != "png") {
    $message = "<li>Only jpg and png files are allowed for the upload.</li>";
    $uploadOk = 0;
}
// Verify if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $message = "<li>The file was not uploaded.</li>";
} else { // upload file
    if (move_uploaded_file($_FILES["imgLink"]["tmp_name"], $target_file)) {
        $message = "<li>The file ". basename( $_FILES["imgLink"]["name"]). " has been uploaded.</li>";
    } else {
        $message = "<li>Error uploading your file.</li>";
    }
}
?>
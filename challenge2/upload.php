<?php
#This code is a mix of two tutorials. The links to which are provided here
#https://www.codexworld.com/php-file-upload/
#https://www.codexworld.com/store-retrieve-image-from-database-mysql-php/
session_start();
include 'dbConfig.php';
$statusMsg = '';
//file upload path
$targetDir = "images/";
$fileName = basename($_FILES["image"]["name"]);
$_SESSION["filenme"] = $fileName;
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$fileSize = $_FILES["image"]["size"];

if(isset($_POST["submit"]) && !empty($_FILES["image"]["name"])) {
    //allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        //upload file to server
	if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
		$db->query("INSERT into images (image_name, file_type, file_size, file_path, uploaded) VALUES ('$fileName', '$fileType', '$fileSize', '$targetFilePath', NOW())");
		$statusMsg = "The file ".$fileName. " has been uploaded.";
		header("Location: http://www.jtbd4k.me/challenge2/view.php");
        }else{
		$statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}
?>

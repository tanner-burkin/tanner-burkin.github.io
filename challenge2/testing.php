<?php

require_once 'dbConfig.php';
$statusMsg = '';
//file upload path
$targetDir = "images/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["image"]["name"])) {
    //allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        //upload file to server
	if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
		$db->query("INSERT into images (file_path, uploaded) VALUES ('$targetFilePath', NOW())");
		$statusMsg = "The file ".$fileName. " has been uploaded.";
        }else{
		$statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

//display status message
echo $statusMsg;
?>

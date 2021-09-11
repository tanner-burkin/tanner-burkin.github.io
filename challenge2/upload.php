<?php
// Include the database configuration file
require_once 'dbConfig.php';

// If file upload form is submitted
$status = $statusMsg = '';
$targetDir = "temporary/";
if(isset($_POST["submit"])){
    $status = 'error';
    if(!empty($_FILES["image"]["name"])) {
        // Get file info
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_files($_FILES["image"]["tmp_name"], $targetFilePath)){


                // Insert image path into database
                $insert = $db->query("INSERT into images (file_path, uploaded) VALUES ('$targetFilePath', NOW())");

                if($insert){
                        $status = 'success';
                        $statusMsg = "File uploaded successfully.";
                }else{
                        $statusMsg = "File upload failed, please try again.";
                }

            }else{
                $statusMsg = "Sorry there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    }else{
        $statusMsg = 'Please select an image file to upload.';
    }
}

// Display status message
echo $statusMsg;
?>


<?php

include_once(dirname(__FILE__) . '/../config.php');

class FileUploader
{
   

    public static function Deletefile($targetfile){
        $done=false;
        $ROOT_PATH = $GLOBALS['ROOT_PATH_GLOBAL'];
        if (file_exists($ROOT_PATH.$targetfile)) {
            unlink($ROOT_PATH.$targetfile);
                $done = true;
            } else {
                // File not found.
            }
        return $done;
    }
    

    
    public static  function UploadFile($fileToUpload="fileToUpload",$target_dir){
        $ROOT_PATH = $GLOBALS['ROOT_PATH_GLOBAL'];

        $filename =  uniqid()."_".basename($_FILES[$fileToUpload]["name"]);
        $target_file = $target_dir . $filename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
       
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$fileToUpload]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;  $filename ="-1";
        }
        // Check file size
        if ($_FILES[$fileToUpload]["size"] > 1500000) {
            //echo "Sorry, your file is too large."; 
            $filename ="-2";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $filename ="-3";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded."; 
           // $filename ="-4";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$fileToUpload]["tmp_name"], $ROOT_PATH.$target_file)) {
                echo "The file ". basename( $_FILES[$fileToUpload]["name"]). " has been uploaded.";
            } else {
                $filename ="-10";
                //echo "Sorry, there was an error uploading your file.";
            }
        }
        return $filename;
    }

}
?>
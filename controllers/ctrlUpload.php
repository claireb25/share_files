<?php 

// upload file
$uploadOk = 1;
$file_name = $_FILES['file_name']['name'];
$file_size = $_FILES['file_name']['size'];


if(isset($_FILES['file_name'])){
    $target_dir = "assets/medias/uploads";
    $file_name = $_FILES['file_name']['name'];
    $import = move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_dir.'/'.$file_name);
    if($import == false)
    { 
        echo "non";
    }else 
    { 
        echo "oui";
    }
}
// upload de user 
$sender_email = $_POST['sender_email'];
$receiver_email = $_POST['receiver_email'];
$message = $_POST['message'];


// insertion bdd

require("models/file.class.php");
require("models/user.class.php");

$id_user = User::insertUser($sender_email, $receiver_email,$message);


File::insertFile($file_name, $file_size, $id_user);


// if ($_FILES["file_name"]["size"] > 2000000000) {
//     echo "fichier trop lourd" ;
//     $uploadOk = 0;
// }

// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } 
// else {
   
// }
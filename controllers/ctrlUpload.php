<?php 
$uploadOk = 1;

if(isset($_FILES['file_name'])){
    $target_dir = "assets/medias/uploads";
    $file_name = $_FILES['file_name']['name'];
    $import = move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_dir.'/'.$file_name);
    if($import == false){ echo "non";}else { echo "oui";}
}



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
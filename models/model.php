<?php
require_once 'dbManager.php';

// insert a user
// function insertUser($sender_email,$receiver_email,$message){
    $db = new dbManager("share_files");
//     echo $db->getBdd();
	
//     $response = $db->prepare("INSERT INTO user(sender_email, receiver_email, `message`) VALUES (':sender_email', ':receiver_email',':message')");
//     $response->bindParam(":sender_email", $sender_email);
//     $response->bindParam(":receiver_email", $receiver_email);
//     $response->bindParam(":message", $message);
//     $response->execute();
//     return $db->lastInsertedId();
// }

// //insert a file
function insertFile($file_name, $file_size, $id_user){
   $db = new dbManager("share_files");
    $response = $db->getBdd()->prepare("INSERT INTO `files`(`file_name`, `file_size`, `upload_date`, `delete_date`, id_user) VALUES ('file_name', ':file_size', CURRENT_TIMESTAMP, DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 48 HOUR), ':id_user')");
    $response->bindParam(":file_name",$file_name,PDO::PARAM_STR);
    $response->bindParam(":file_size",$file_size, PDO::PARAM_INT);
    $response->bindParam(":id_user",$id_user, PDO::PARAM_INT);
    $response->execute();
    
};
//get a file and all its infos
function getFile($id_user){
    $db = new dbManager("share_files");
    $response = $db->getBdd()->prepare("SELECT sender_email,receiver_email,`message`,`file_name`,file_size,delete_date FROM user INNER JOIN files ON user.id = id_user WHERE user.id = :id_user");
    $response->bindParam(":id_user", $id_user, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}


// delete from bdd after 2 days
// function deleteFile(){
//     $this->_db = new dbManager();
//     $resposne = $db->prepare('DELETE user, files FROM user INNER JOIN files ON user.id = files.id_user WHERE delete_date < NOW()');
// }
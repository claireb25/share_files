<?
require_once '../utils/db.php';



// insert a user
function insertUser($sender_email,$receiver_email,$message){
    global $db;
    $response = $db->prepare("INSERT INTO user(sender_email, receiver_email, `message`) VALUES (':sender_email', ':receiver_email',':message')");
    $response->bindParam(":sender_email", $sender_email);
    $response->bindParam(":receiver_email", $receiver_email);
    $response->bindParam(":message", $message);
    $response->execute();
    return $db->lastInsertedId();
}

//insert a file
function insertFile($file_name, $file_size, $id_user){
    global $db;
    $response = $db->prepare("INSERT INTO `files`(`file_name`, `file_size`, `upload_date`, `delete_date`, id_user) VALUES ('file_name', ':file_size', CURRENT_TIMESTAMP, DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 48 HOUR), ':id_user')");
    $response->bindParam(":file_name",$file_name);
    $response->bindParam(":file_size",$file_size);
    $response->bindParam(":id_user",$id_user);
    $response->execute();
    
}
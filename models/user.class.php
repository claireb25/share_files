<?php
require_once 'dbManager.php';

class User{
// insert a user
public function insertUser($sender_email,$receiver_email,$message){
    $db = new dbManager("share_files");
    echo $db->getBdd();
    $response = $db->prepare("INSERT INTO user(sender_email, receiver_email, `message`) VALUES (':sender_email', ':receiver_email',':message')");
    $response->bindParam(":sender_email", $sender_email);
    $response->bindParam(":receiver_email", $receiver_email);
    $response->bindParam(":message", $message);
    $response->execute();
    return $db->lastInsertedId();
}
}

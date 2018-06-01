<?php
require_once 'dbManager.php';

class User{
// insert a user
public static function insertUser($sender_email,$receiver_email,$message,$user_hash){
    $db = new dbManager("share_files");
    $response = $db->getBdd()->prepare("INSERT INTO user(sender_email, receiver_email, `message`, user_hash) VALUES (:sender_email, :receiver_email,:message, :user_hash)");
    $response->bindParam(":sender_email", $sender_email, PDO::PARAM_STR);
    $response->bindParam(":receiver_email", $receiver_email, PDO::PARAM_STR);
    $response->bindParam(":message", $message, PDO::PARAM_STR);
    $response->bindParam(":user_hash", $user_hash, PDO::PARAM_STR);
    $response->execute();
    return $db->getBdd()->lastInsertId();
}
}

<?php 
class File{

    //insert a file
    public static function insertFile($file_name, $file_size, $id_user){
    $db = new dbManager("share_files");
        $response = $db->getBdd()->prepare("INSERT INTO `files`(`file_name`, `file_size`, `upload_date`, `delete_date`, id_user) VALUES (:file_name, :file_size, CURRENT_TIMESTAMP, DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 48 HOUR), :id_user)");
        $response->bindParam(":file_name",$file_name,PDO::PARAM_STR);
        $response->bindParam(":file_size",$file_size, PDO::PARAM_INT);
        $response->bindParam(":id_user",$id_user, PDO::PARAM_INT);
        $response->execute();   
    }

    //get a file and all its infos
    public static function getFile($user_hash){
        $db = new dbManager("share_files");
        $response = $db->getBdd()->prepare("SELECT sender_email,receiver_email,`message`,`file_name`,file_size, delete_date, user_hash FROM user INNER JOIN files ON user.id = id_user WHERE user_hash = :user_hash");
        $response->bindParam(":user_hash", $user_hash, PDO::PARAM_INT);
        $response->execute();
        return $response->fetch(PDO::FETCH_ASSOC);
    }

    // delete from bdd after 2 days
    public static function deleteFile(){
        $this->_db = new dbManager();
        $response = $db->getBdd()->prepare('DELETE user, files FROM user INNER JOIN files ON user.id = files.id_user WHERE delete_date < NOW()');
        $response->execute();
    }


    public static function download($file_name){
    $url_image = realpath('./')."/assets/medias/uploads/" . $file_name;
            header('Content-Description: File Transfer'); 
            header("Content-Disposition: attachment; filename=" . basename($file_name)); 
            header("Content-Type: application/force-download"); 
            header("Content-Transfer-Encoding: " . $type . "\n");
            header("Content-Length: " . filesize(realpath('./')."/assets/img/meme/" . $file_name)); 
            header("Pragma: no-cache"); 
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public"); 
            header("Expires: 0"); 
            readfile($url_image); 
            
    }
}
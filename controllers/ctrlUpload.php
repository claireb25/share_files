<?php 

// PHP Envoyeur Email //

if (isset($_POST['sender_email'])&& !empty($_POST['sender_email'])
    && isset($_POST['receiver_email'])&& !empty($_POST['receiver_email']) 
        && isset($_POST['message']) && !empty($_POST['message'])
            && isset($_FILES['file_name'])&& !empty($_FILES['file_name'])){

              
                $sender_email = htmlspecialchars($_POST['sender_email']);
                $receiver_email = htmlspecialchars($_POST['receiver_email']);
                $message = htmlspecialchars($_POST['message']);
               
                if (preg_match('#^([\w\.-]+)@([\w\.-]+)(\.[a-z]{2,4})$#',trim($_POST['sender_email']))
                    && preg_match('#^([\w\.-]+)@([\w\.-]+)(\.[a-z]{2,4})$#',trim($_POST['receiver_email']))){
                    
                    require("models/file.class.php");
                    require("models/user.class.php");
                    $url = "http://localhost/share_files/download";
                    $key = "php c'est genial, les goupils aussi";
                     
                    $current_time = time();
                    $user_hash = hash_hmac('ripemd160', $current_time, $key);
                    $target_dir = "assets/medias/uploads/". $user_hash;  

                    mkdir($target_dir, 0777);
                    $dlLink = $url . "/" . $user_hash;
                        
                   
                    $id_user = User::insertUser($sender_email, $receiver_email,$message,$user_hash);    
              
                    
                    $file_count = count($_FILES['file_name']['name']);
                    
                    for($i=1; $i<$file_count; $i++){
                        $temp_name = $_FILES["file_name"]["tmp_name"][$i];
                        $file_size = $_FILES['file_name']['size'][$i];
                        $file_name = $_FILES['file_name']['name'][$i];
                        // var_dump($file_size);
                        // var_dump($file_name);
                        // var_dump($temp_name);
                        
                        $import = move_uploaded_file($temp_name, $target_dir.'/'.$file_name);
                        
                        File::insertFile($file_name, $file_size, $id_user);
                    };

                 
                    $to      = $receiver_email;
                    $subject = $sender_email . " vous a envoyé des fichiers via Share Files";
                    $message = $sender_email. ' vous a envoyé des fichiers
                    <a href='.$dlLink.'> Télécharger </a>';
                    
                    mail($to, $subject, $message);
                   
                    if($import == false)
                    {
                        header('Location: /share_files');;
                        session_start();
                        $_SESSION = array(
                        "sender_email" => $_POST['sender_email'],
                        "receiver_email" => $_POST['receiver_email'],
                        "message" => $_POST['message'],
                        "file_name" => $_FILES['file_name']
                        );  
                    }else
                    {
                        echo "c'est tout bon";
                    }


    }}
    else 
    {
        header('Location: /share_files');;
        session_start();
        $_SESSION = array(
        "sender_email" => $_POST['sender_email'],
        "receiver_email" => $_POST['receiver_email'],
        "message" => $_POST['message'],
        "file_name" => $_FILES['file_name']
        );
    };

// require_once 'vendor/autoload.php';

// $loader = new Twig_Loader_Filesystem('views');
// $twig = new Twig_Environment($loader, array(
//     'cache'=> false
// ));
// $template = $twig->load('homepage.html.twig');
// echo $template->render(array('test'=>$test));



// function reArrayFiles(&$file_name) {

//     $file_ary = array();
//     $file_count = count($file_name['file_name']);
//     $file_keys = array_keys($file_name);

//     for ($i=0; $i<$file_count; $i++) {
//         foreach ($file_keys as $key) {
//             $file_ary[$i][$key] = $file_name[$key][$i];
//             var_dump($_FILES[$file_name]);
//         }
//     }

//     return $file_ary;

// }


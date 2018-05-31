<?php 

// upload file
$uploadOk = 1;
$file_name = $_FILES['file_name']['name'];
$file_size = $_FILES['file_name']['size'];


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


            $target_dir = "assets/medias/uploads";
            $file_name = $_FILES['file_name']['name'];
            $import = move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_dir.'/'.$file_name);
            // ajout à la bdd
            
            
            require("models/file.class.php");
            require("models/user.class.php");
            $id_user = User::insertUser($sender_email, $receiver_email,$message);
            File::insertFile($file_name, $file_size, $id_user);
            
            $to      = $receiver_email;
            $subject = $sender_email . " vous a envoyé des fichiers via Share Files";
            $message = $sender_email. ' vous a envoyé des fichiers';
            
            
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
    else {
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

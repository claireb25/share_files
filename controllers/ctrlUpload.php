<?php 

// PHP Envoyeur Email //

if (isset($_POST['sender_email'])&& !empty($_POST['sender_email'])
    && isset($_POST['receiver_email'])&& !empty($_POST['receiver_email']) 
        && isset($_POST['message']) && !empty($_POST['message'])
            && isset($_FILES['file_name'])&& !empty($_FILES['file_name'])){

                $sender_email = htmlentities($_POST['sender_email']);
                $receiver_email = htmlentities($_POST['receiver_email']);
                $message = htmlentities($_POST['message'], ENT_NOQUOTES);
               
                if (preg_match('#^([\w\.-]+)@([\w\.-]+)(\.[a-z]{2,4})$#',trim($_POST['sender_email']))
                    && preg_match('#^([\w\.-]+)@([\w\.-]+)(\.[a-z]{2,4})$#',trim($_POST['receiver_email']))){
                    
                    require("models/file.class.php");
                    require("models/user.class.php");
                    $url = "https://claireb.promo-17.codeur.online/share_files/download";
                    $key = "php c'est genial, les goupils aussi";
                     
                    $current_time = time();
                    $user_hash = hash_hmac('ripemd160', $current_time, $key);
                    $target_dir = "assets/medias/uploads/". $user_hash;  

                    mkdir($target_dir, 0777);
                    $dlLink = $url . "/" . $user_hash;
                        
                   $id_user = User::insertUser($sender_email, $receiver_email,$message,$user_hash);    
                 
                   function multiple(array $_files, $top = TRUE)
                    {
                        $files = array();
                        foreach($_files as $name=>$file){
                            if($top) $sub_name = $file['name'];
                            else    $sub_name = $name;
                        
                            if(is_array($sub_name)){
                                foreach(array_keys($sub_name) as $key){
                                    $files[$name][$key] = array(
                                        'name'     => $file['name'][$key],
                                        'type'     => $file['type'][$key],
                                        'tmp_name' => $file['tmp_name'][$key],
                                        'error'    => $file['error'][$key],
                                        'size'     => $file['size'][$key],
                                    );
                                    $files[$name] = multiple($files[$name], FALSE);
                                }
                            }else{
                                $files[$name] = $file;
                            }
                        }
                        return $files;
                    }

                    $files = multiple($_FILES);

                  
                    $vide= array_shift($files['file_name']);
                 

                    $file_count = count($files['file_name']);
                    $size =0;
                   
                    // var_dump($files["file_name"][0]);
                    for($i=0; $i<$file_count; $i++){
                        $temp_name = $files["file_name"][$i]["tmp_name"];
                        $file_size = $files['file_name'][$i]['size'];
                        $file_name = $files['file_name'][$i]['name'];
                        $size +=$file_size;
                        //var_dump($size);
                        // var_dump($file_size);
                        // var_dump($file_name);
                        //var_dump($temp_name);

                        $import = move_uploaded_file($temp_name, $target_dir.'/'.$file_name);
                        File::insertFile($file_name, $file_size, $id_user);
                    };
                
                    $to      = $receiver_email;
                    $subject = $sender_email . " vous a envoyé des fichiers via Share Files";
                    $mail = "<html>
                    <head>
                    <title>HTML email</title>
                    </head>
                    <body> 
                        <section>" .$sender_email. '<p> vous a envoyé des fichiers</p>
                            <p> '.$file_count .'fichiers - taille : '.round($size/ 1024) .'ko</p>
                            <a href='.$dlLink.'><button type="submit" class="btn-pink">Télécharger</button></a><br><p>'
                            .$message.'</p>
                        </section>
                    </body>
                    </html>';
                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    mail($to, $subject, $mail,$headers);
                   
                    if($import == false)
                    {
                        header('Location: state');
                        $_SESSION['uploadError'] = array(
                        "sender_email" => $_POST['sender_email'],
                        "receiver_email" => $_POST['receiver_email'],
                        "message" => $_POST['message'],
                        "file_name" => $_FILES['file_name']
                        );  
                    }
                    else
                    {
                        header('Location: state');
                      
                    }
                    
    }
}
else 
{
    header('Location: /share_files');
    $_SESSION = array(
    "sender_email" => $_POST['sender_email'],
    "receiver_email" => $_POST['receiver_email'],
    "message" => $_POST['message'],
    "file_name" => $_FILES['file_name']
    );
} ;


// require_once 'vendor/autoload.php';

// $loader = new Twig_Loader_Filesystem('views');
// $twig = new Twig_Environment($loader, array(
//     'cache'=> false
// ));
// $template = $twig->load('homepage.html.twig');
// echo $template->render(array('test'=>$test));

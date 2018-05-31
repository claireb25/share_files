<?php
require('models/file.class.php');




// $test = getFile();


require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));
$template = $twig->load('homepage.html.twig');
echo $template->render(array('test'=>$test));

// PHP Envoyeur Email //

if (isset($_POST['sender_email'])){
    if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
       }};

if (!empty($_POST['receiver_email'])){
    if (!filter_var($receiver_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
           }};

if (!empty($_POST['file_name'])){
};

if(empty($message)){
exit();
};

// if(isset($_FILES['file_name'])){
//     $target_dir = "assets/medias/uploads";
//     $file_name = $_FILES['file_name']['name'];
// }


// $_FILES ['file_name']{{
// echo "L'email a été envoyé.";
// }};


//$sender_email = $_POST['sender_email'];
//$point = strpos($sender_email,".");
//$aroba = strpos($sender_email,"@");
//if($point=='')
// {
// echo "Votre email doit comporter un <b>point</b>";
// }
// elseif($aroba=='')
// {
// echo "Votre email doit comporter un <b>'@'</b>";
// }
// else
// {
// echo "Votre email est: '<a href=\"mailto:"."$sender_email"."\"><b>$sender_email</b></a>'";
// } 

// PHP Fin //

// PHP Receveur Email //
// $receiver_email = $_POST['receiver_email'];
// $point = strpos($receiver_email,".");
// $aroba = strpos($receiver_email,"@");

// if (!filter_var($receiver_email, FILTER_VALIDATE_EMAIL)) {
//     $emailErr = "Invalid email format";
//   }

// if($point=='')
// {
// echo "Votre email doit comporter un <b>point</b>";
// }
// elseif($aroba=='')
// {
// echo "Votre email doit comporter un <b>'@'</b>";
// }
// else
// {
// echo "Votre email est: '<a href=\"mailto:"."$receiver_email"."\"><b>$receiver_email</b></a>'";
// } 

// PHP Fin //

// PHP Message //

// $message = $_POST['message'];

// if(empty($message))
// {
// exit();
// }

// // PHP Fin //

// if (isset($_POST['sender_email']) && empty($_POST['receiver_email']) && empty($_POST['']) && empty($_POST['file_name']))
// {
//     echo '<p>'.'hello '.$_POST['file_name'].'</p>';
// }
// else
// {
//     echo '<p>il manque un renseignement</p>';
// }


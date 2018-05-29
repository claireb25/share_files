<?php
require('models/file.class.php');

//$test = getFile();

require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));
$template = $twig->load('homepage.html.twig');
echo $template->render(array('test'=>$test));


// PHP Envoyeur Email //

$_POST = ['senderEmail'];
$senderEmail = $_POST['sender_email'];
$point = strpos($senderEmail,".");
$aroba = strpos($senderEmail,"@");

if($point=='')
{
echo "Votre email doit comporter un <b>point</b>";
}
elseif($aroba=='')
{
echo "Votre email doit comporter un <b>'@'</b>";
}
else
{
echo "Votre email est: '<a href=\"mailto:"."$senderEmail"."\"><b>$senderEmail</b></a>'";
} 

// PHP Fin //

// PHP Receveur Email //
$receiverEmail = $_POST['receiver_email'];
$point = strpos($receiverEmail,".");
$aroba = strpos($receiverEmail,"@");

if($point=='')
{
echo "Votre email doit comporter un <b>point</b>";
}
elseif($aroba=='')
{
echo "Votre email doit comporter un <b>'@'</b>";
}
else
{
echo "Votre email est: '<a href=\"mailto:"."$receiverEmail"."\"><b>$receiverEmail</b></a>'";
} 

// PHP Fin //

// PHP Message //

$message = $_POST['message'];

if(empty($message))
{
exit();
}

// PHP Fin //

if (isset($_POST['sender_email']) && empty($_POST['receiver_email']) && empty($_POST['']) && empty($_POST['file_name']))
{
    echo '<p>'.'hello '.$_POST['file_name'].'</p>';
}
else
{
    echo '<p>il manque un renseignement</p>';
}


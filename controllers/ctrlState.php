<?php

require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));
$template = $twig->load('state.html.twig');

if (isset($_SESSION['uploadError'])){
	$data = array( 'error' => true, 'userData' => $_SESSION['uploadError']);
	echo $template->render(array('session'=>$data));
} else {
	$data = array( 'error' => false );
	echo $template->render(array('session'=>$data));
}

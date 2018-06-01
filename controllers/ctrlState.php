<?php

require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));
$template = $twig->load('state.html.twig');

echo $template->render(array('session'=>$_SESSION['uploadError']));
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

var_dump($_FILES);
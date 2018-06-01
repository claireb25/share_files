<?php 



require 'models/file.class.php';
// $file = getFile();

require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));
$template = $twig->load('download.html.twig');

echo $template->render(array());






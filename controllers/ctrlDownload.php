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
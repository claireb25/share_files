<?php 

if(isset($_GET['name'])){
    require 'models/file.class.php';
    $user_hash = $_GET['name'];
    $files = File::getFile($user_hash);

    require_once 'vendor/autoload.php';
    
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));

   
    
    $template = $twig->load('download.html.twig');

    echo $template->render(array('files'=>$files, "user"=>$user_hash));
}









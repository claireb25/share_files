<?php 

if(isset($_GET['name'])){
    require 'models/file.class.php';
    // $user_hash = $_GET['name'];
    // $files = File::getFile($user_hash);
    // ajout pour essai frontend
    $user_hash = "essai user";
    $files = array(array('file_name' => 'essai_nom',
                    'file_type' => 'type',
                    'file_size' => '1200'),
                    array('file_name' => 'essai_nom2',
                    'file_type' => 'type2',
                    'file_size' => '2100'),
                    array('file_name' => 'essai_nom2',
                    'file_type' => 'type2',
                    'file_size' => '2100'),
                    array('file_name' => 'essai_nom2',
                    'file_type' => 'type2',
                    'file_size' => '2100') );
    require_once 'vendor/autoload.php';
    
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));

    $template = $twig->load('download.html.twig');

    echo $template->render(array('files'=>$files, "user"=>$user_hash));



}









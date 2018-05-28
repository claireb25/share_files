<?php
 
$url = explode("/",$_SERVER['REQUEST_URI'],4);
if (count($url)>3){
    array_pop($url);
}

$path = implode("/", $url);
switch($path){
    case "/share_files":
    case "/share_files/" :
        require('controllers/ctrlHomepage.php');
        break;
}
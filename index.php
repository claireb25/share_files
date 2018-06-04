<?php
if (!isset($_SESSION)){
	session_start();
}


if (isset($_GET['action'])){
    switch ($_GET['action']) { 
        case "home":
            require('controllers/ctrlHome.php');
        break;
   
        case "upload":
            require('controllers/ctrlUpload.php');
        break;

        case "download/":
            require('controllers/ctrlDownload.php');
        break;
        
        case "state":
        	require('controllers/ctrlState.php');
        break;

        default:
            require('controllers/ctrlHome.php');
        break;
    }
} 


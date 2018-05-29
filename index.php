<?php

echo $_GET['action'];
if (isset($_GET['action'])){
    switch ($_GET['action']) { 
        case "home":
            require('controllers/ctrlHome.php');
        break;
   
        case "upload":
            require('ctrlUpload.php');
        break;
    }
} else {
    require('controllers/ctrlHome.php');
}

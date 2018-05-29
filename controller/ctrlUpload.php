<?php

//if (isset($_POST['nom']) && isset($_POST['email'])) {

//	echo 'Votre nom est '.$_POST['nom'].' et votre fonction est '.$_POST[''];
//}
require('db.php');

$bd = $bdd->query('SELECT * FROM share_files');


// PHP pour l'email envoyeur //

$monEmail = $_POST['monEmail'];
$point = strpos($monEmail,".");
$aroba = strpos($monEmail,"@");


if($point=='')
{
echo "Votre email doit comporter un <b>point</b>";
}
elseif($aroba=='')
{
echo "Votre email doit comporter un <b>'@'</b>";
}
else
{
echo "Votre email est:'<a href=\"mailto:"."$monEmail"."\"><b>$monEmail</b></a>'";
} 

// Fin PHP pour l'email receveur //

// PHP pour l'email receveur //

$tonEmail = $_POST['tonEmail'];
$point = strpos($tonEmail,".");
$aroba = strpos($tonEmail,"@");


if($point=='')
{
echo "Votre email doit comporter un <b>point</b>";
}
elseif($aroba=='')
{
echo "Votre email doit comporter un <b>'@'</b>";
}
else
{
echo "Votre email est: '<a href=\"mailto:"."$tonEmail"."\"><b>$tonEmail</b></a>'";
} 

// Fin PHP pour l'email receveur //

// PHP du message //

$message = $_POST['message'];
print("$nom");

// Fin du message //

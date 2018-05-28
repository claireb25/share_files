<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=share_files;charset=utf8', 'admin', 'online2017');
}
catch(Exception $e) {
    die('Erreur:'.$e->getMessage());
}

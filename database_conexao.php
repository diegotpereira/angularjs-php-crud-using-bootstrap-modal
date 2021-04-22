<?php

try {
    //code...
    $connect = new PDO("mysql:host=localhost;dbname=angularjs_php_crud_bootstrap_modal", "root", "root");
} catch (PDOException $e) {
    //throw $th;
    echo 'ERROR: ' . $e->getMessage();
}



?>
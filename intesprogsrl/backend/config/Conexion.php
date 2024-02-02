<?php
if (!isset($_SESSION)) {
    session_start();
}

// Define database
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'intesprogsrl');

// Connecting database
try {
    $connect = new PDO("mysql:host=" . dbhost . ";dbname=" . dbname, dbuser, dbpass);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $connect->exec("set names utf8"); // Añadido para establecer el conjunto de caracteres UTF-8
}
catch (PDOException $e) {
    echo $e->getMessage();
}
?>

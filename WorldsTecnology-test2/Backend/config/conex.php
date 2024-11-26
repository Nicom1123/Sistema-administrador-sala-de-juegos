<?php

$servername = "localhost";
$username = "root";
$password = "root"; // Prueba con una cadena vacía
$dbname = "usc";

$mysqli = new mysqli($servername, $username, $password, $dbname);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


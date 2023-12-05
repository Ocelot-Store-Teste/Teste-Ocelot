<?php
/*
//Connection for awardspace
$hostname = "fdb33.awardspace.net";
$user = "4005147_db";
$password = "8ss@@pGj6L9r";
$database = "4005147_db";
$connection = mysqli_connect($hostname, $user, $password, $database) or die('Não foi possível conectar!');
*/


//Connection for localhost

$hostname = "localhost";
$user = "root";
$password = "";
$database = "ocelot";
$connection = mysqli_connect($hostname, $user, $password, $database) or die('Não foi possível conectar!');

date_default_timezone_set('America/Sao_Paulo');

?>
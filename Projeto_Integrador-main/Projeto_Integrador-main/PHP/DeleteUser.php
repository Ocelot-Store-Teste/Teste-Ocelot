<?php
include('../PHP/Connection.php');

if(!isset($_SESSION)){
    session_start();
}
$email = $_SESSION['email'];
$sql_code = "DELETE FROM user where email = '$email'";
$sql_query = $connection->query($sql_code) or die("Falha na execução do código SQL:" . $connection->error);

session_destroy();

header("Location: ../Index.html");

?>
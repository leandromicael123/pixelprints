<?php include("createsession_cookies.php");
$email = $_POST["email"];
$password = $_POST["password"];
$sessao = $_POST["sessao"];

echo login($email, $password, $sessao);
?>
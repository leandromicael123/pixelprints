<?php
if (!empty($_POST))
{
session_start();
include("sendmailexample.php");    include ("databasestart.php");
$emailrecipiente = "feroleandro@gmail.com";
if($_SESSION["session"]==true)
{
    $nome =$_SESSION["Nome"];
    $email =  $_SESSION["Email"];
    $telefone = $_SESSION["Telefone_pess"];
    $empresa = $_SESSION["Nomeempresa"];
    $nif = $_SESSION["NIF"];
    $tipoconta = $_SESSION["tipoconta"];
    if(isset($_COOKIE["Cod_id"]))
{
$codid = $_COOKIE["Cod_id"];
}
else{
    $codid = $_SESSION["Cod_id"];
}
}
else
{
    $tipoconta = trim(mysqli_real_escape_string($conexao,$_POST["tipoconta"]));
$nome = trim(mysqli_real_escape_string($conexao,$_POST["nome"]));
$email = trim(mysqli_real_escape_string($conexao,$_POST["email"]));
$telefone = trim(mysqli_real_escape_string($conexao,$_POST["tel"]));
$empresa = trim(mysqli_real_escape_string($conexao,$_POST["emp"]));
$nif =  trim(mysqli_real_escape_string($conexao,$_POST["nif"]));
}
$messagem = trim(mysqli_real_escape_string($conexao,$_POST["message"]));

$titulo = "Revendas";
$conteudo = "Nome: ".$nome.";<br>tipo de cliente: ".$tipoconta.";<br> Email: ".$email.";<br> Número de telefone: ".
$telefone.";<br> Nome da empresa: ".$empresa.";<br> NIF: ".$nif.";<br><br> Messagem: <br>".$messagem."";


send_email($emailrecipiente,$titulo, $conteudo);
    echo "<script>window.location.assign('Index.php')</script>";
} 
?>
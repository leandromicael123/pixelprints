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
$nome = mysqli_real_escape_string($conexao,$_POST["nome"]);
$email = mysqli_real_escape_string($conexao,$_POST["email"]);
$telefone = mysqli_real_escape_string($conexao,$_POST["tel"]);
$nif =  mysqli_real_escape_string($conexao,$_POST["nif"]);
$empresa = mysqli_real_escape_string($conexao,$_POST["emp"]);
}
$descricao = mysqli_real_escape_string($conexao,$_POST["descricao"]);
$quantidade = mysqli_real_escape_string($conexao,$_POST["Quantidade"]);
$data = mysqli_real_escape_string($conexao,$_POST["data"]);
$data = date("d-m-Y", strtotime($data));

$titulo = "Orcamentos";
if(isset($codid))
{
    $conteudo ="Id de utilizador :".$codid."<br>";
}
$conteudo .= "Nome: ".$nome.";<br> Email: ".$email.";<br> Número de telefone: ".
$telefone.";<br> Nome da empresa: ".$empresa.";<br> NIF: ".$nif.";<br><br> descrição do produto: <br>".$descricao."<br> <br>Prazo de entrega: <br>".$data."<br> <br>Quantidade: <br>".$quantidade."<br> <br>";



send_email($emailrecipiente,$titulo, $conteudo);
echo "<script>window.location.assign('Index.php')</script>";
}
?>
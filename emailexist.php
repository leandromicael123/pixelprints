<?php
error_reporting(0);
session_start();
function seemeail($value){ 
    include ("databasestart.php");
$email = mysqli_real_escape_string($conexao,$_POST["email"]);

 $select = "SELECT * FROM `utilizador_bd` WHERE `Email` = '$value' " ;
 $Query = MySQLi_query($conexao,  $select); 
 if($_SESSION["Email"] == $_POST["email"])
 {
    return 2;
 }
 if(mysqli_num_rows($Query)>=1){
    return 1;
 }
 return 0;
}
echo seemeail($_POST["email"]);
?>
<?php 
include ("navbar/navbar.php"); ?>

<body>
    <div class="blueacc_menu login">
        <div class="menu login">

            <?php
error_reporting(0);
session_start();
include ("databasestart.php");
include ("sendmailexample.php");
if(($_SESSION["session"]== true))
{ 
    echo "<script>window.location.assign('Index.php')</script>";
}
if (!empty($_POST))
{
    $email = mysqli_real_escape_string($conexao,$_POST["email"]);
    $titulo = "Recuperacao de palavra-passe - pixelprints";
    $select = "SELECT * FROM `utilizador_bd` WHERE `Email` = '$email' " ;
    $Query = MySQLi_query($conexao,  $select);
    $secret_cod = uniqid(rand()); 
    if(mysqli_num_rows($Query)>=1){
        while ($Result = MySQLi_fetch_array($Query)) 
    {
       $codid = $Result["Cod_id"];
    }
        $select1 = "SELECT * FROM `resetpassword` WHERE `Utilizador_assoc` = '$codid'";
    
        $Query1 = MySQLi_query($conexao,  $select1);
               if(mysqli_num_rows($Query1)>=1)
        {
         
            $insert = "UPDATE resetpassword
            SET uniqueid = '$secret_cod'";
        }
        else{
$insert = "INSERT INTO `resetpassword` (`Utilizador_assoc`, `uniqueid`) VALUES ('$codid', '$secret_cod')";
        }
   $Query = MySQLi_query($conexao,  $insert);  
   if ($Query)
   {
  $conteudo = "Link para a recuperação de password - http://".$_SERVER['HTTP_HOST'].dirname($_SERVER["PHP_SELF"]). "/resetpassword_actual.php?code=".$secret_cod;
  send_email($email ,$titulo, $conteudo);   echo "<script>window.location.assign('emailenviado.php?result=1')</script>"; return;
} 
 echo "<script>window.location.assign('emailenviado.php?result=0')</script>"; }echo "<script>window.location.assign('emailenviado.php?result=0')</script>";}

?>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="../Jquery/loginsignin.js"></script>
</body>

</html>
<div style='display:none'>

    <script src="../Jquery/jquery.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
</div>
<?php include ("navbar/navbar.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="blueacc_menu login">
        <div class="menu login">

            <form action="" class='form_flex login' method='POST' autocomplete="off">
                <div class="titleacc_login"><img src="../img/icons/icon-person.png" class='icons-img'>
                    <div class="textacc">Mudar a palavra-passe</div>
                </div>
                <div class="flex_join_login">
                    <input type="password" maxlength="100" minlength="8" placeholder='*PASSWORD' name='password'
                        class="reg-classe email-login" required>
                    <input type="password" minlength="8" placeholder='*REPETIR PASSWORD' name='repetir_password'
                        class="reg-classe password-login" required>
                </div>
                <div class="btn-enviar btn-envem recvpassword">></div>
                <a href="signin.php" class='init_ses'>Não tem conta?</a>
            </form>

        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="../Jquery/loginsignin.js"></script>
</body>
<script>
AOS.init();
</script>

</html>

<?php 

include ("databasestart.php");

if($_POST["password"] == $_POST["repetir_password"])
{
$code = mysqli_real_escape_string($conexao , $_GET["code"]); 
$password = mysqli_real_escape_string($conexao,$_POST["password"]);
$Select = "SELECT * FROM resetpassword WHERE uniqueid = '$code'";
$Query = MySQLi_query($conexao,  $Select);  
if ($Query)
{ if(mysqli_num_rows($Query)==0)
    {
        echo "<script>window.location.assign('Index.php')</script>";
    }
    if(mysqli_num_rows($Query)>=1){if (!empty($_POST))
{
    while ($Result = MySQLi_fetch_array($Query)) 
    {
       $id = $Result["Utilizador_assoc"];
    }
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $Insert = "UPDATE `utilizador_bd` SET `Password` = '$hashed_password' WHERE `utilizador_bd`.`Cod_id` = '$id'";
    $Query = MySQLi_query($conexao,  $Insert);  
    if ($Query)
    {
        $Delete = "DELETE FROM resetpassword WHERE uniqueid = '$code'";
        $Query = MySQLi_query($conexao,  $Delete);  
        echo "<script>window.location.assign('emailenviado.php?result=2')</script>";
    }
}
}
}}
?>
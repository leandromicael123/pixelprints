<?php include ("navbar/navbar.php"); ?>
<body>
<div class="blueacc_menu">
    <div class="menu">
         
        <form action="" class='form_flex' method='POST' autocomplete="off">
        <div class="titleacc edit"><img src="../img/icons/icon-person.png" class='icons-img'><div class="textacc">Modificar detalhes da conta</div></div>
        <div class="flex_join">
            <input type="text" autocomplete="off" value ='<?php echo $_SESSION["Nome"] ?>' maxlength="100" placeholder='NOME' data-aos="fade-up"
     data-aos-duration="1000" name ='nome' class="reg-classe mandatory icnrr" require>
            <input type="email" autocomplete="off" value ='<?php echo $_SESSION["Email"] ?>' maxlength="50" placeholder='EMAIL' name ='email' data-aos="fade-up"
     data-aos-duration="1000" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title='Email incorreto' class="reg-classe mandatory incrr" require></div>
            <div class="flex_join">
            <input type="text" autocomplete="off" value ='<?php echo $_SESSION["Morada"] ?>' placeholder='MORADA' data-aos="fade-up"
     data-aos-duration="1000" name ='morada' class="reg-classe" >
            <input type="text" autocomplete="off" value ='<?php echo $_SESSION["Codpostal"] ?>' placeholder='CÓDIGO POSTAL' data-aos="fade-up"
     data-aos-duration="1000" name ='cod' class="reg-classe" ></div>
            <div class="flex_join">
            <input type="tel" autocomplete="off" value ='<?php echo $_SESSION["Telefone_pess"] ?>' placeholder='TELEFONE' maxlength="9" data-aos="fade-up"
     data-aos-duration="1000" name ='tel' pattern="[0-9]+" class="reg-classe mandatory incrr" >
            <input type="text" autocomplete="off" value ='<?php echo $_SESSION["NIF"] ?>' placeholder='NIF' pattern="[0-9]+" data-aos="fade-up"
     data-aos-duration="1000" name ='nif' maxlength="9" class="reg-classe"  > </div>
     <div class="flex_join">
     <input type="text" autocomplete="off" value ='<?php echo $_SESSION["Nomeempresa"] ?>' placeholder='NOME DA EMPRESA' minlength="2" data-aos="fade-up"
     data-aos-duration="1000" name ='empresa' class="reg-classe mandatory incrr" >
     <select name="tipoconta" class="reg-classe" data-aos="fade-up"
     data-aos-duration="1000" id="">
     <?php 
     switch($_SESSION["tipoconta"])
     {
     case "Cliente-final":
        echo "<option value='0' class='reg-classe-option'>Cliente-final</option>
        <option value='1' class='reg-classe-option'>Revendedor</option>";
         break;
        default:
        echo "<option value='1' class='reg-classe-option'>Revendedor</option>
        <option value='0' class='reg-classe-option'>Cliente-final</option>"; break;
    } ?>
    </select></div>
    </div>
        <div class="btn-enviar btn-envem edit">></div>
      
        <input type="submit" class='submit' style='display:none'> 
        </form>
   
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script><script src="../Jquery/loginsignin.js"></script>
</body>
</html>
<script src="../Jquery/jquery.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script></body>
</html>
<div style='display:none'>
<?php
if(($_SESSION["session"]!= true))
{
    echo "<script>window.location.assign('Index.php')</script>";
} if (!empty($_POST))
{
    include("emailexist.php");
    include ("databasestart.php");
$nome = mysqli_real_escape_string($conexao,$_POST["nome"]);
$Email = mysqli_real_escape_string($conexao,$_POST["email"]);
$empresa = mysqli_real_escape_string($conexao,$_POST["empresa"]);
$NIF = mysqli_real_escape_string($conexao,$_POST["nif"]);
$telefone = mysqli_real_escape_string($conexao,$_POST["tel"]);
$morada = mysqli_real_escape_string($conexao,$_POST["morada"]);
switch(mysqli_real_escape_string($conexao,$_POST["tipoconta"]))
{
    case "0":
        $tipoconta = "Cliente-final";
    break;
    case "1":
        $tipoconta = "Revendedor"; break;
}
$codigopostal = mysqli_real_escape_string($conexao,$_POST["cod"]);
if(isset($_SESSION["Cod_id"]))
{
    $cod_id = $_SESSION["Cod_id"];
}
else{
    $cod_id = $_COOKIE["Cod_id"];
}
$UPDATE = "UPDATE `utilizador_bd` SET `Nome` = '$nome', `Email` = '$Email', `NIF` = '$NIF',
 `Morada` = '$morada', `tipoconta` = '$tipoconta', `Codpostal` = '$codigopostal', `Telefone_pess` = '$telefone', `Nomeempresa` = 
 '$empresa' WHERE `utilizador_bd`.`Cod_id` =  $cod_id";
 $Query = MySQLi_query($conexao,  $UPDATE); 
 echo "<script>window.location.assign('editdetails.php')</script>";
}
?></div>
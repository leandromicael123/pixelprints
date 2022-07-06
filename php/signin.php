<?php include ("navbar/navbar.php"); ?>

<body>
    <div class="blueacc_menu">
        <div class="menu signin">

            <form action="" class='form_flex' method='POST' autocomplete="off">
                <div class="titleacc"><img src="../img/icons/icon-person.png" class='icons-img'>
                    <div class="textacc">Criar conta</div>
                </div>
                <div class="flex_join">
                    <input type="text" autocomplete="off" minlength="3" maxlength="100" placeholder='*NOME COMPLETO'
                        data-aos="fade-up" data-aos-duration="1000" name='nome' class="reg-classe mandatory icnrr"
                        require>
                    <input type="email" autocomplete="off" maxlength="50" placeholder='*EMAIL' name='email'
                        data-aos="fade-up" data-aos-duration="1000" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        title='Email incorreto' class="reg-classe mandatory incrr" require>
                </div>
                <div class="flex_join">
                    <input type="text" autocomplete="off" placeholder='MORADA' data-aos="fade-up"
                        data-aos-duration="1000" name='morada' class="reg-classe">
                    <input type="text" autocomplete="off" placeholder='CÓDIGO POSTAL' data-aos="fade-up"
                        data-aos-duration="1000" name='cod' class="reg-classe">
                </div>
                <div class="flex_join">
                    <input type="tel" autocomplete="off" minlength="9" placeholder='TELEFONE' maxlength="9"
                        data-aos="fade-up" data-aos-duration="1000" name='tel' pattern="[0-9]+"
                        class="reg-classe mandatory incrr">
                    <input type="text" autocomplete="off" placeholder='NIF' pattern="[0-9]+" data-aos="fade-up"
                        data-aos-duration="1000" name='nif' maxlength="9" class="reg-classe">
                </div>
                <div class="flex_join">
                    <input type="text" autocomplete="off" placeholder='Nome de empresa' minlength="2" data-aos="fade-up"
                        data-aos-duration="1000" name='empresa' class="reg-classe mandatory incrr">
                    <select name="tipoconta" class="reg-classe" data-aos="fade-up" data-aos-duration="1000" id="">
                        <option value="0" class='reg-classe-option'>Cliente-final</option>
                        <option value="1" class='reg-classe-option'>Revendedor</option>
                    </select>
                </div>
                <div class="flex_join">
                    <input type="password" autocomplete="new-password" placeholder='*PASSWORD' maxlength="30"
                        data-aos="fade-up" data-aos-duration="1000" name='password' minlength="8"
                        class="reg-classe mandatory incrr" require>
                    <input type="password" autocomplete="new-password" placeholder='*REPETIR PASSWORD'
                        data-aos="fade-up" data-aos-duration="1000" maxlength="30" minlength="8"
                        class="reg-classe mandatory incrr" require>
                </div>
                <div class="btn-enviar btn-envem signin">></div>
                <div class="flex-cooke"> Quer se lembrar da sessão? <input type="checkbox" name="sessao" id=""></div>
                <a href="login.php" class='init_ses'>Já tem sessão iniciada?</a>
            </form>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.17.0/jquery.mask.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="../Jquery/loginsignin.js"></script>
</body>

</html>
<div style=''>

    <?php
if(($_SESSION["session"]== true))
{
    echo "<script>window.location.assign('Index.php')</script>";
} 
if (!empty($_POST))
{
   
    include("emailexist.php");
    include ("databasestart.php");
    switch(mysqli_real_escape_string($conexao,$_POST["tipoconta"]))
    {
        case "0":
            $tipoconta = "Cliente-final";
        break;
        case "1":
            $tipoconta = "Revendedor"; break;
    }
    $nome = trim(mysqli_real_escape_string($conexao,$_POST["nome"]));
    $Email = mysqli_real_escape_string($conexao,$_POST["email"]);
    $empresa = mysqli_real_escape_string($conexao,$_POST["empresa"]);
    $hashed_password = password_hash(mysqli_real_escape_string($conexao,$_POST["password"]), PASSWORD_DEFAULT);
    $NIF = mysqli_real_escape_string($conexao,$_POST["nif"]);
    $telefone = mysqli_real_escape_string($conexao,$_POST["tel"]);
    $morada = mysqli_real_escape_string($conexao,$_POST["morada"]);
    $codigopostal = mysqli_real_escape_string($conexao,$_POST["cod"]);
    $sessao = mysqli_real_escape_string($conexao,$_POST["sessao"]);

    $insert = "INSERT INTO `utilizador_bd` (`Cod_id`, `Nome`, `Email`, `Password`, `NIF`, `Morada`, `Codpostal`, `Telefone_pess`,`Nomeempresa`,`tipoconta`, `Nivel`, `Datadeentrada`) VALUES (NULL, '".$nome."', '".$Email."', '$hashed_password', '$NIF', '$morada', '$codigopostal', '$telefone','$empresa','$tipoconta', 'Utilizador', current_timestamp())";
    echo $insert;
    if(seemeail($Email)==0)
{

    $Query = MySQLi_query($conexao,  $insert);  
    if($Query)
    {
        if($sessao=="on")
        {
            create_session($Email,0);
            get_session($_COOKIE["Cod_id"]);
            return; 
            if($_SESSION["session"]=="true")
            {
                echo $_SESSION["Nome"];
                echo "<script>window.location.assign('index.php')</script>"; 
            }
        }
        create_session($Email,1);
            get_session($_SESSION["Cod_id"]);

                echo $_SESSION["Nome"];
                echo "<script>window.location.assign('index.php')</script>"; 
            
            return;
    }
}
}

?>

    <script src="../Jquery/jquery.js"></script>
    <script src="../Jquery/loginsignin.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
</div>
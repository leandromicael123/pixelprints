<?php include ("navbar/navbar.php"); ?>
<body>
<div class="blueacc_menu login">
    <div class="menu login">
        
        <form action="" class='form_flex login' method='POST' autocomplete="off">
        <div class="titleacc_login"><img src="../img/icons/icon-person.png" class='icons-img'>
        <div class="textacc">Entrar na conta</div></div>
        <div class="flex_join_login">
            <input type="text" maxlength="100" placeholder='*EMAIL' data-aos="fade-up"
     data-aos-duration="1000" name ='nome' class="reg-classe email-login" required>
            <input type="password" placeholder='*PASSWORD' data-aos="fade-up"
     data-aos-duration="1000" name='password' class="reg-classe password-login" required></div>
        <div class="btn-enviar btn-envem login">></div>
       <div class="flex-cooke"> Quer se lembrar da sessão? <input type="checkbox"  name="sessao" id="paiva"></div>
       <a href="resetpassword.php" class="frg_pass">Esqueci-me da palavra-passe</a>
        <input type="submit" class='submit' style='display:none'> <a href="signin.php" class='init_ses' >Não tem conta?</a>
        </form>
   
    </div> 
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>   $(".form_flex.login").on("keypress", function (event) {

            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
              console.log("aaya");
                
            }
        });
    </script> </script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script><script src="../Jquery/loginsignin.js"></script>
</body>
</html>
<div >

<?php
if(($_SESSION["session"]== true))
{
    echo "<script>window.location.assign('Index.php')</script>";
}
if (!empty($_POST))
{

}

?>

<script src="../Jquery/jquery.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</div>


<script>
  $(".btn-enviar.btn-envem.login").off();
</script>
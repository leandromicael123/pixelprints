<?php include ("navbar/navbar.php"); ?>
<body>
<div class="blueacc_menu login">
    <div class="menu login">
        
        <form action="resetpasswordvalid.php" class='form_flex login' method='POST' autocomplete="off">
        <div class="titleacc_login"><img src="../img/icons/icon-person.png" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class='icons-img'>
        <div class="textacc">Recuperação de password</div></div>
        <div class="flex_join_login">
            <input type="text" minlength='2' placeholder='*EMAIL' data-aos="fade-up"
     data-aos-duration="1000" name ='email' class="reg-classe email" required></div>
        <div class="btn-enviar btn-envem password">></div>
        <input type="submit" class='submit' style='display:none'> <a href="signin.php" class='init_ses' >Não tem conta?</a>
        </form>
   
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script><script src="../Jquery/loginsignin.js"></script>
</body>
</html>
<div style='display:none'>

<script src="../Jquery/jquery.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</div>


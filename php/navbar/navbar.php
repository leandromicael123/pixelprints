<?php       error_reporting(0);  session_start();  include ("createsession_cookies.php");if(isset($_COOKIE["Cod_id"])){get_session($_COOKIE["Cod_id"]);}get_session($_SESSION["Cod_id"]);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="keywords" content="Cartões de visita, estampagem, decoração de viaturas, flyers, grafica, brindes, publiccidade, impressão, presentes personalizados, canetas personalizadas">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Leandro Bernardo">
  <meta name="description" content="Somos o seu parceiro de publicidade que transforma qualquer
ideia em realidade através de todo o tipo de impressões, decoração de
lojas, viaturas e brindes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0  user-scalable=no">
    <title>Pixelprints</title>
    <link rel="icon" href="../img/Logo/logo.png">
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/nav.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/color.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/responsive.css"><script src="jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/loginsignin.css">
    <link rel="stylesheet" href="../css/folhadeobra.css">
    
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body>
<div class='overflow_mobile'>
<div class="loader">
</div>
<div class="navbar_black">
  <div class="cross" ><span></span><span></span></div>
   
<div class="link">INICIO</div>
        <div class="link">QUEM SOMOS?</div>
        <div class="link">SERVIÇOS</div>
        <div class="link"><a href="">LOJA</a></div>
        <div class="link">REVENDA</div>
        <div class="link">PORTEFÓLIO</div>
        <div class="link">CONTACTOS</div>

            <?php if($_SESSION["session"]== true)
        {
      
             echo "<div class='link'><img class='icon' src='../img/icons/icon-person.png'>".$_SESSION["Email"]."</div><div class='totalbtn'>
 <a class='link'  href='editdetails.php'>DEFINIÇÕES</a>
     <a href='link editdetails.php' class='link'>      <img src='../img/icons/cart.png' class='carrinho nav_cart' alt=''>CART</a>
       
            <a href='logout.php' class='link'>LOGOUT</a></div>";
           
        }
        else{
        echo "<a href='login.php' class='log_in link'><img class='icon ' src='../img/icons/icon-person.png' alt=''>LOGIN/SIGN UP</a>";}
      ?>
</div>
<div class="bars logo" >
</div>

    <div class="navbar bg_white">
     
        <div class="links"><div class='logo'></div></div>
        <div class="links"><div class="text-link">QUEM SOMOS?</div></div>
        <div class="links"><div class="text-link">SERVIÇOS</div></div>
        <div class="links"><a href="">LOJA</a></div>
        <div class="links"><div class="text-link">REVENDA</div></div>
        <div class="links"><div class="text-link">PORTEFÓLIO</div></div>
        <div class="links"><div class="text-link">CONTACTOS</div></div>
       
        <div class="links img"><div class="text-link "><?php if($_SESSION["session"]== true)
        {
            echo "<div class='text-username'>".$_SESSION["Email"]."</div>";
           
        }
        else{
        echo "LOGIN";}
      echo '<img class="icon" src="../img/icons/icon-person.png" alt=""></div>';
        if($_SESSION["session"]== true)
        {
            echo '<div class="menu-account edit">
            <a class="btn-whitish"><img src="../img/icons/cart.png" class="carrinho" alt="">CARRINHO</a>
            <a href="editdetails.php" class="btn-whitish">DEFINIÇÕES</a>
            <a class="btn-whitish" href="logout.php">LOG OUT</a>
            <a class="btn-whitish"> </a>
            </div></div>
          </div>';
           
        }
        else{
        echo ' <div class="menu-account"><div class="menu-title">Login</div>
       
        <div class="completelogin"> <div class="texts"><div class="text-login">Email</div><div class="text-login">Password</div></div>
     <div class="inputs">
         <input type="email" class="em">
         <input type="password" class="em">
         
     </div>
     
     </div>    <div class="flex-cooke"> Quer se lembrar da sessão? <input type="checkbox" id="check"></div>
     <a href="resetpassword.php" class="frg_pass">Esqueci-me da palavra-passe</a>
      <div class="entrarbtn">Entrar</div>
     <div class="socialmediabtn"><img src="../img/icons/googlesymbol.png" alt="" class="btn_socialmedia"><div class="text_socialmedia">Login com Google</div></div><div class="socialmediabtn"><img src="../img/icons/apple.png" alt="" class="btn_socialmedia">
     <div class="text_socialmedia">Login com Apple</div></div>
      
     <a href="signin.php" class="frg_pass">Novo aqui? Junte-se</a></div></div> </div></div>
     </div>
     </div>';}
     ?>
       

</body>
</html>
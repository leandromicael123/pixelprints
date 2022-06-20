<?php include ("navbar/navbar.php"); ?>
<body>
    <div class="solos">
<div class="titulo-s">Progresso do produto</div>
<div class="titulo-s">Nome do produto</div>
<input type="range" max="100" min="0" disabled ></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

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


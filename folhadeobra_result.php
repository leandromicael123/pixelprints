<?php
include ("databasestart.php");
error_reporting(0);
$codigo = $_GET["cod"];
$usercode = $_GET["usercode"];
$type  = $_GET["type"];
$act_type = $type == "admin"? "utilizador_non_log":($type == "user"?"utilizador_bd":"utilizador_bd");
$Query = isset($type)==TRUE &&$type!=""? $conexao->query( "SELECT * FROM `$act_type` WHERE `Cod_id`='$usercode';"):FALSE;
if($Query==TRUE)
{
if(mysqli_num_rows($Query)>0)
{ ?>

<body>
    <div class="folha_de_obra">
        <div class="subtitulo_obra" style="margin-bottom:2rem">Dados do cliente</div>
        <div class="grid-2" style="margin-bottom:2rem">
            <?php
  while ($row = mysqli_fetch_assoc($Query)) { 
    foreach($row as $key => $value)
    {
      if($key=='Password')continue;
      if($key=='Cod_id'){$full="full-size";}
      else{
        $full="";
      }
      echo ' <div class="grid-col '.$full.'">
      <div class="label-text">'. $key.'</div>
      <div class="label-row">'. $value.'</div>
</div>';
    }
  }
  ?>

        </div>
    </div>
</body>
</body>

</html>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
AOS.init();
</script>
<script src="../Jquery/jquery.js"></script>

<script src="../Jquery/loginsignin.js"></script>

</html>
<script>
</script>
<?php
      return;
}}
else
{
$Query = MySQLi_query($conexao,  "SELECT * FROM `folha de obra` LEFT JOIN `edicao` on `edicao`.`Codfolha` = `folha de obra`.`Codfolha` WHERE `folha de obra`.`Codfolha` = '$codigo'");  
if(mysqli_num_rows($Query)==0)
{ 
  echo "<script>window.location.assign('Index.php')</script>";
}
while ($Result = MySQLi_fetch_array($Query)) { 
  if($Result["Utilizador_assoc"]!=NULL)
  {
    $criado = "utilizador";
    $select= "SELECT * FROM `utilizador_bd` WHERE Cod_id  = '".$Result["Utilizador_assoc"]."'";
   $query = MySQLi_query($conexao, $select);
   while ($Results = MySQLi_fetch_array($query)) { 
    $nome = $Results["Nome"];
    $Email = $Results["Email"];
    $Cod_id  = $Results["Cod_id"];
    $NIF  = $Results["NIF"];
    $telefone = $Results["Telefone_pess"];
   }
  }
  else{
    $criado = "admin";
    $select= "SELECT * FROM `utilizador_non_log` WHERE Cod_id  = '".$Result["user_notlogin"]."'";
    $query = MySQLi_query($conexao, $select);
    while ($Results = MySQLi_fetch_array($query)) { 
     $nome = $Results["Nome"];
     $Email = $Results["Email"];
     $Cod_id  = $Results["Cod_id"];
     $NIF  = $Results["NIF"];
     $telefone = $Results["Telefone_pess"];
     $pessoa_contacto = $Results["Pessoa-contacto"];
    }
    
  }
        echo'<body>
    <div class="folha_de_obra">
        <div class="Titulo_obra">Folha de obra</div>
        <div class="subtitulo_obra">N.º de folha de obra</div>
        <div class="label-row">'.$Result["Codfolha"].'</div>';
        $description = $Result["Pedido_mens"];
        $budgetmontagem = $Result["Budget_montagem"];
        $customontagem = $Result["Custo_Montagem"];
        $pessoamontagem = $Result["Pessoa_Montagem"];
        $local = $Result["Ficheirosloc"];
        $Dataadicionada = $Result["Dataadicionada"];
        $Status = $Result["Status"];
 
      
        }}?>
<div class="subtitulo_obra">Dados do cliente</div>

<div class="grid-2">
    <div class="grid-col full-size">
        <div class="label-text">Criado por</div>
        <div class="label-row"><?php echo $criado?></div>
    </div>
    <div class="grid-col">
        <div class="label-text">Código id</div>
        <div class="label-row"><?php echo $Cod_id?></div>
    </div>
    <div class="grid-col">
        <div class="label-text">Nome</div>
        <div class="label-row"><?php echo $nome?></div>
    </div>
    <div class="grid-col">
        <div class="label-text">Email</div>
        <div class="label-row"><?php echo $Email?></div>
    </div>
    <div class="grid-col">
        <div class="label-text">NIF</div>
        <div class="label-row"><?php echo $NIF?></div>
    </div>
    <div class="grid-col">
        <div class="label-text">Contacto</div>
        <div class="label-row"><?php echo $telefone?></div>
    </div>
    <div class="grid-col">
        <div class="label-text">Pessoa-contacto</div>
        <div class="label-row"><?php echo $pessoa_contacto?></div>
    </div>
</div>
<div class="subtitulo_obra">Descrição</div>
<div class="grid-col">
    <div class="textdescription label-row"><?php echo $description;?></div>
</div>
<div class="subtitulo_obra">Montagem</div>
<div class="flex text-center">
    <div class="grid-col">
        <div class="label-text">Budget Montagem</div>
        <div class="label-row"><?php echo $budgetmontagem;?></div>
    </div>
    <div class="grid-col">
        <div class="label-text">Custo Montagem</div>
        <div class="label-row"><?php echo $customontagem;?></div>
    </div>
    <div class="grid-col">
        <div class="label-text">Pessoa Montagem</div>
        <div class="label-row"><?php echo $pessoamontagem;?></div>
    </div>
</div>
<div class="subtitulo_obra">Localização do ficheiro</div>
<div class="label-row"><?php echo $local;?></div>
<div class="subtitulo_obra">Aprovações necessárias</div>
<div class="flex">
    <?php 
                  $select= "SELECT * FROM `aprov_necessario` WHERE codfolha  = '$codigo'";
                  $query = MySQLi_query($conexao, $select);
                  while ($Results = MySQLi_fetch_array($query)) { 
                    echo "<li>".$Results["nivel_necessario"]."</li>";
                  }
              ?></div>
<div class="subtitulo_obra">Status</div>
<div class="label-row"><?php echo $Status;?></div>
<div class="subtitulo_obra">Data adicionada</div>
<div class="label-row" style="margin-bottom:3rem"><?php echo $Dataadicionada;?></div>
</div>





</div>
</body>

</html>

<script>
AOS.init();
</script>

</html>
<script>
</script>
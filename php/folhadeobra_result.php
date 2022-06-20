<?php include ("navbar/navbar.php"); 
include ("databasestart.php");
$codigo = $_GET["cod"];
$Query = MySQLi_query($conexao,  "SELECT * FROM `folha de obra` WHERE `folha de obra`.`Codfolha` = '$codigo'");  
while ($Result = MySQLi_fetch_array($Query)) { 
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
        if($Results["Utilizador_assoc"])
        }?>
            <div class="subtitulo_obra">Dados do cliente</div>

              <div class="grid-2">
                <div class="grid-col full-size">
                <div class="label-text">Criado por</div>
                <div class="label-row">12</div>
              </div>
              <div class="grid-col">
                <div class="label-text">Código id</div>
                <div class="label-row">12</div>
              </div>
              <div class="grid-col">
                <div class="label-text">Nome</div>
                <div class="label-row">leandro</div>
              </div>
              <div class="grid-col">
                <div class="label-text">Email</div>
                <div class="label-row"></div>
              </div>
              <div class="grid-col">
                <div class="label-text">NIF</div>
                <div class="label-row"></div>
              </div>
              <div class="grid-col">
                <div class="label-text">Contacto</div>
                <div class="label-row"></div>
              </div>
              <div class="grid-col">
                <div class="label-text">Pessoa-contacto</div>
                <div class="label-row"></div>
              </div></div>
              <div class="subtitulo_obra">Descrição</div>
              <div class="grid-col">
              <div class="textdescription label-row"><?php echo $description;?></div></div>
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
              <div class="subtitulo_obra">Verificações</div>
              <div class="subtitulo_obra">Status</div>
              <div class="label-row"><?php echo $Status;?></div>
              <div class="subtitulo_obra">Data adicionada</div>
              <div class="label-row" style="margin-bottom:3rem"><?php echo $Dataadicionada;?></div>
              </div>
        
             
          
   
  
</div>
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
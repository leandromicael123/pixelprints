<?php include ("navbar/navbar.php"); ?>
<body>
    <div class="folha_de_obra">
        <div class="Titulo_obra">Criar folha de obra</div>
        <div class="parts_obra">
            <div class="subtitulo_obra">Dados do cliente</div>
            <div class="radio_flex">
                <div class="flex_radio_ind">
      <label  class="radiolabel">Adicionar dados do cliente</label>
            <input type="radio" name="user" value="0" class="radio_data"></div>          <div class="flex_radio_ind">
       <label  class="radiolabel">Usar dados de clientes/users existentes</label>
       <input type="radio" name="user" value="1" class="radio_data"></div> 
       
       </div><div class="parts_obra">
    <div class="subtitulo_obra" >Descrição</div>
   <textarea name="" cols="30" class='txtobra' placeholder="Escrever aqui"rows="10"></textarea>
    </div>
    <div class="parts_obra">
    <div class="subtitulo_obra" >Montagem</div>
    <div class="flex-mont">
      <div type="text" placeholder="Budget Montagem" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="[0-9]+"></div>
      <input type="text" placeholder="Custo Montagem" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="[0-9]+">
      <input type="text" placeholder="Pessoa Montagem">
   </div> </div>
   <div class="parts_obra"> 
    <div class="subtitulo_obra" >Localização de ficheiros</div>
   <textarea name="" cols="10" class='txtobra' placeholder="Escrever aqui"rows="10"></textarea>
    </div>
    <div class="aprovalref">
     
    </div>
   <div class="flex" ><label for="">Enviar para</label>
   <select name="" id="" class="nivel"></select></div>
    <input type="submit" class='submitobra'></div> 
</div>
</body>
</html>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
  AOS.init();
</script>
<script src="../Jquery/jquery.js"></script>

<script src="../Jquery/folhadeobra.js"></script>
<script src="../Jquery/loginsignin.js"></script>
</html>
<script>
</script>
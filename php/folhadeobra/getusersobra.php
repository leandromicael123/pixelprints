<?php
session_start();

function obrasuser($field,$text){
    include ("../databasestart.php");
    $select1 = "SELECT * FROM `utilizador_bd` WHERE $field LIKE '%$text%' limit 15";
    $Query1 = MySQLi_query($conexao,  $select1);  
    $value = array();
    $value2 =   array();
    $index = 0;    
    if(mysqli_num_rows($Query1)>=1){
        while ($Result = MySQLi_fetch_array($Query1)) { 
            $value[$index][] = "Criado por user";
            $value[$index][] = $Result["Cod_id"];
            $value[$index][] = $Result["Nome"];
            $value[$index][] = $Result["Email"];
            $value[$index][] = $Result["NIF"];          
            $value[$index][] = $Result["Telefone_pess"];   
            $value[$index][] = $Result["Codpostal"];
            $value[$index][] = $Result["Morada"];
            $value[$index][] = $Result["tipoconta"]; 
            $value[$index][] = $Result["Nomeempresa"];
            $value[$index][] = $Result["Nivel"];
            $value[$index][] = $Result["Datadeentrada"];
            $arr = $value[$index];
            $pos = 6;
            $val = "";
        
           $value[$index] = array_merge(array_slice($arr, 0, $pos), array($val), array_slice($arr, $pos));
           $index++;
        }}
      
        $select = "SELECT * FROM `utilizador_non_log` WHERE $field LIKE '%$text%' limit 30";
        
        $Query = MySQLi_query($conexao,  $select);  
        if($Query==false)
        {
            return json_encode($value);
        }
        $index = 0;    
        if(mysqli_num_rows($Query)>=1){
            while ($Result = MySQLi_fetch_array($Query)) { 
                $value2[$index][] = "Inserida por admin";
               $value2[$index][] = $Result["Cod_id"];
               $value2[$index][] = $Result["Nome"];
               $value2[$index][] = $Result["Email"];
               $value2[$index][] = $Result["NIF"];
               $value2[$index][] = $Result["Telefone_pess"];
               $value2[$index][] = $Result["Pessoa-contacto"];   
                $index++;
            }}

            $result = array_merge( $value,$value2 );
        return json_encode($result );
        
    }
function detailedobrasuser($type, $cod )
{
    include ("../databasestart.php");
if($type ==1)
{
    $select = "SELECT * FROM `utilizador_non_log` WHERE Cod_id  = '$cod'";
}
else
{
  $select = "SELECT * FROM `utilizador_bd` WHERE Cod_id  = '$cod'";
}
$Query = MySQLi_query($conexao,  $select); 
while ($Result = MySQLi_fetch_array($Query)) { 
    $data[]=$Result["Cod_id"];
    $data[] = $type===1?"admin":"user"; 
$data[]=$Result["Nome"];
 $data[]=$Result["Email"];
 $data[]=$Result["NIF"];
 $data[]=$Result["Telefone_pess"];
 $data[]=$Result["Pessoa-contacto"];
}
return json_encode($data);
}

function getallfields($table)
{

    include ("../databasestart.php");
    $select = "SHOW COLUMNS FROM `$table`";
    $Query = MySQLi_query($conexao,  $select);  
    $collect = array();
    while ($Result = MySQLi_fetch_array($Query)) { 
        array_push($collect,$Result["Field"]);
    }
    if($table =="folha de obra")
    {
        $select = "SHOW COLUMNS FROM `edicao`";
        $Query = MySQLi_query($conexao,  $select);  
        $description = array();
        while ($Result = MySQLi_fetch_array($Query)) { 
            array_push($description,$Result["Field"]);
        }
//array_splice( $Resultado[$i], 4, 0
      array_splice($description,0,2);
    array_splice($description,5,3);
    array_splice($collect,3,0,$description); }
 
    return json_encode($collect);
}
function userspesquisaespecifica($select,$text,$table)
{
    include ("../databasestart.php");
    $table = $table==0?"utilizador_bd":"utilizador_non_log";
    $select = "SELECT * FROM `$table` WHERE `$select` LIKE '%$text%' LIMIT 30";
$i = 0;
$query = $conexao->query($select);
    while($Result = $query->fetch_array())
{
   
$users[$i][] = $Result["Cod_id"];

$users[$i][] = $Result["Nome"];

$users[$i][] = $Result["Email"];

$users[$i][] = $Result["NIF"];

$users[$i][] = $Result["Telefone_pess"];

$users[$i][] = $Result["Pessoa-contacto"];
$i++;
}
return json_encode($users);
}
function niveluseruser()
{
    
    include ("../databasestart.php");
    $select = "SELECT * FROM `niveis`";
    $Query = MySQLi_query($conexao,  $select);  
    $collect = array();
    $levelstonotadd = array("Utilizador","Faturacao","Arquivado");
    while ($Result = MySQLi_fetch_array($Query)) { 
  if( in_array($Result["Nivel"], $levelstonotadd))
  {
    continue;
  }
        array_push($collect,$Result["Nivel"]);
    }
    return json_encode($collect);
}
 function createuser($tipodedata,$datauser,$mensagem,$montagem,$localizacao,$aprovacao,$status,$comentario)
 {
    include ("../databasestart.php");
    $codid1 = isset($_SESSION["Cod_id"])==TRUE?$_SESSION["Cod_id"]:$_COOKIE["Cod_id"];
    function approval($aprovacao,$folhadeobranum)
    { include ("../databasestart.php");
        $insertappr = "INSERT INTO `aprov_necessario` (`codfolha`, `nivel_necessario`) VALUES ('$folhadeobranum', 'Faturacao')";
        $Query = MySQLi_query($conexao,  $insertappr);  
        foreach($aprovacao as $apprv)
        {
 $insertappr = "INSERT INTO `aprov_necessario` (`codfolha`, `nivel_necessario`) VALUES ('$folhadeobranum', '$apprv')";
$Query = MySQLi_query($conexao,  $insertappr);  
if(!$Query)
{
    return 0;
}
}
    }

    if($tipodedata == 0)
    { 

        $insert_utilizador = "INSERT INTO `utilizador_non_log` (`Cod_id`, `Nome`, `Email`, `NIF`,
         `Telefone_pess`, `Pessoa-contacto`) VALUES (NULL, '".$datauser[0]."', '".$datauser[2]."', '".$datauser[1]."', '".$datauser[3]."', '".$datauser[4]."')";
        $Query = MySQLi_query($conexao, $insert_utilizador);  
        if($Query)
        {
            $utilizador = $conexao->insert_id;
        
            $insert_folha = "INSERT INTO `folha de obra` (`Codfolha`, `user_notlogin`, `Utilizador_assoc`, `Status`, `Dataadicionada`) VALUES (NULL, '$utilizador', NULL, '$status', current_timestamp())";
             $Query = MySQLi_query($conexao,  $insert_folha);  
         
             if($Query)
             {

                $folhadeobranum = $conexao->insert_id;
                $insertuser = "INSERT INTO `edicao` (`Codedicao`, `Codfolha`, `Pedido_mens`,
                `Ficheirosloc`, `Budget_montagem`, `Custo_Montagem`,
                `Pessoa_Montagem`, `Status`, `Coduser`, `Datatime`) VALUES
                 (NULL, '$folhadeobranum', '$mensagem','$localizacao',
                  '$montagem[0]', '$montagem[1]', '$montagem[2]', '$status','$codid1', current_timestamp())";
            $Query = MySQLi_query($conexao,  $insertuser);  
          
                approval($aprovacao,$folhadeobranum);
                email($status,$folhadeobranum,$comentario);
                echo '<script>  var currentURL =
                window.location.protocol +
                "//" +
                window.location.host +
                window.location.pathname +
                `?metodo=criar&result=true&cod='.$folhadeobranum.'`;
              window.history.pushState(
                {
                  path: currentURL,
                },
                "",
                currentURL
              );
              getparameter(GetURLParameter("metodo"));</script>';
             }
          
        }
            return 0;
    }
    else
    {
        
        $getfromcodid = $datauser[1];   

        if($datauser[0]=="Criado por user")
        {
            $insert_folha = "INSERT INTO `folha de obra` ( `user_notlogin`, `Utilizador_assoc`, `Status`, `Dataadicionada`) VALUES (NULL, '$getfromcodid', '$status', current_timestamp())"; 
    }
        else
        {
            $insert_folha = "INSERT INTO `folha de obra` ( `user_notlogin`, `Utilizador_assoc`,  `Status`, `Dataadicionada`) VALUES ( '$getfromcodid', NULL, '$status', current_timestamp())";
        }

        $Query = MySQLi_query($conexao,  $insert_folha); 
        if($Query)
        {
            $folhadeobranum = $conexao->insert_id;
            $insertuser = "INSERT INTO `edicao` (`Codedicao`, `Codfolha`, `Pedido_mens`,
            `Ficheirosloc`, `Budget_montagem`, `Custo_Montagem`,
            `Pessoa_Montagem`, `Status`, `Coduser`, `Datatime`) VALUES
             (NULL, '$folhadeobranum', '$mensagem','$localizacao',
              '$montagem[0]', '$montagem[1]', '$montagem[2]', '$status','$codid1', current_timestamp())";
      $Query = MySQLi_query($conexao,  $insertuser); 
         
            approval($aprovacao,$folhadeobranum);
            email($status,$folhadeobranum,$comentario);
            echo '<script>  var currentURL =
                window.location.protocol +
                "//" +
                window.location.host +
                window.location.pathname +
                `?metodo=criar&result=true&cod='.$folhadeobranum.'`;
              window.history.pushState(
                {
                  path: currentURL,
                },
                "",
                currentURL
              );
              getparameter(GetURLParameter("metodo"));</script>';
        }
    }
 }
 function searchfolha($text,$select,$nivel,$gotic)
 {

    include ("../databasestart.php");
    $status = $_SESSION["Nivel"];
   $fields = $select[0] === "user" ? json_decode(getallfields("utilizador_non_log"))[$select[1]]: json_decode(getallfields("folha de obra"))[$select[1]];
    $nivel = isset($nivel)?( $nivel === "0" ? "SELECT * FROM `utilizador_bd` WHERE `$fields` LIKE
     '%$text%';SELECT * FROM `utilizador_non_log` WHERE `$fields` LIKE '%$text%'" : ($nivel === "2"?"SELECT * FROM `utilizador_bd` WHERE `$fields` LIKE
     '%$text%'":"SELECT * FROM `utilizador_non_log` WHERE `$fields` LIKE '%$text%'")):"";
  $query = $select[0] === "user" ? "SELECT * FROM `folha de obra` WHERE ": "SELECT * FROM `folha de obra` WHERE `$fields` LIKE '%$text%' AND `Status` = '$status'";
  if($select[1]>=3 && $select[0] != "user")
{
    $Edicaoexcpt = "SELECT  Codfolha FROM `edicao` WHERE  `$fields` LIKE '%$text%'"; 
    $query ="SELECT * FROM `folha de obra` WHERE `Status` = '$status' AND `Codfolha` IN ($Edicaoexcpt)";
}
  if($gotic == 1)
{
    $query =  "SELECT * FROM `folha de obra` WHERE Codfolha ='$text' AND `Status` = '$status'";
}   $conexao->multi_query( $select[0] === "user" ? $nivel:$query);
    do {$typevalue=$select[0] === "user"?"utilizador":"admin"; 
        if ($result = $conexao->store_result()) {
            while ($row = $result->fetch_row()) {
              $select[0] === "user"?$actu_result[]=$row:$Resultado[] = $row;
            }
        }

        if ($conexao->more_results()) {
            
        }
    } while ($conexao->next_result());
    
    if($select[0] === "user")
    { 
 foreach ($actu_result as $result)
    {
        $queryact =count($result) === 6 ?  $query."user_notlogin = '$result[0]'": $query."Utilizador_assoc = '$result[0]'";
        $queryact.="AND `Status` = '$status'";
        $query1 =  MySQLi_query($conexao, $queryact);
        while ($row = MySQLi_fetch_row($query1)) { 
            $Resultado[] = $row;
            
        }
         
    } 
}

    for($i=0;$i<=count($Resultado)-1;$i++)
    {
        $Resultado[$i][1] === NULL ? array_splice( $Resultado[$i], 1, 0, "user" ):array_splice( $Resultado[$i], 1, 0, "admin" );
$selectdetails = "SELECT Pedido_mens,Ficheirosloc,Budget_montagem,Custo_Montagem,Pessoa_Montagem FROM `edicao` WHERE Codfolha='".$Resultado[$i][0]."' ORDER BY Codedicao  DESC LIMIT 1";
$query1 = MySQLi_query($conexao,$selectdetails);
if($query1)
{ 
    while($Result = MySQLi_fetch_row($query1))
{
    $description[] = $Result;
}
}

array_splice( $Resultado[$i], 4, 0,$description[$i] );
}
    return json_encode($Resultado);
}           
function nivelfolha($cod)
{
    include ("../databasestart.php");
    $select = "SELECT * FROM `aprov_necessario` WHERE `codfolha`  = '$cod' AND `nivel_necessario`<>'".$_SESSION["Nivel"]."'";
    $Query = MySQLi_query($conexao,  $select); 
    $levelstonotadd = array("Utilizador","Faturacao","Arquivado");
while ($Result = MySQLi_fetch_array($Query)) {
    if ( in_array($Result[1],$levelstonotadd) ) 
{
continue;
}
$Resultado[] =$Result;
}

return  json_encode($Resultado);
}
function Aprovarfolha($codid,$req)
{
    include ("../databasestart.php");
    session_start();
    $status = $_SESSION["Nivel"];
    $sql = "SELECT * FROM `aprovacao` WHERE `Codfolha` = '$codid' AND `Nivel` = '$status'";
    $result = $conexao->query($sql);
    $num = $result->num_rows;
    if ( $num == 0) {
       if($req==1)
       {
        return 0;
       }
    $sql = "INSERT INTO `aprovacao` (`Codfolha`, `Aprovacao_data`, `Nivel`) VALUES ('$codid', current_timestamp(), '$status')";
    if ($conexao->query($sql) === TRUE) {
        $sql = "SELECT * FROM `aprovacao` WHERE `Codfolha` = '$codid'";

        $result = $conexao->query($sql);
        while($row = $result->fetch_row())
        {
            $aprovacoes[] = $row;
        }

        $sql = "SELECT * FROM `aprov_necessario` WHERE `Codfolha` = '$codid'";
        $result = $conexao->query($sql);
        while($row = $result->fetch_row())
        {
          $aprovacoes_necessarios[] = $row;  
        }
        if(count($aprovacoes_necessarios)-1==count($aprovacoes))
        {
            return 2;
        }
        return 1;
      } else {
       return $conexao->error;
      }
    }
    else
    {
        if($req==1)
       {
        return 1;
       }
        $sql = "DELETE FROM `aprovacao` WHERE `Codfolha` = '$codid' AND `Nivel` = '$status'";
        if ($conexao->query($sql) === TRUE) {
            return -1;
          } else {
           return $conexao->error;
          }
}}

function createdata($array)
{

    include ("../databasestart.php");
    $sql ="INSERT INTO `utilizador_non_log` (`Cod_id`, `Nome`, `Email`, `NIF`, `Telefone_pess`, `Pessoa-contacto`) VALUES (NULL, '$array[0]', '$array[2]', '$array[1]', '".str_replace(' ', '', $array[3])."', '".str_replace(' ', '', $array[4])."')" ;
if ($conexao->query($sql) === TRUE) {
    return 1;
  } else {
   return $conexao->error;
  }
}

function updatestatus($codfolha,$status,$editquest,$edit,$comentario)
    {
    
        include ("../databasestart.php");
        include ("../sendemailexample.php");
        $sql ="UPDATE `folha de obra` SET `Status` = '$status' WHERE `folha de obra`.`Codfolha` = '$codfolha'" ;
    
        if ($conexao->query($sql) === TRUE) {
            if($editquest==1)
            {
                $cod_id = isset($_SESSION["Cod_id"])==TRUE?$_SESSION["Cod_id"]:$_COOKIE["Cod_id"];
                $Insert = "INSERT INTO `edicao`  (`Codedicao`, `Codfolha`, `Pedido_mens`, `Ficheirosloc`, `Budget_montagem`, `Custo_Montagem`,  `Pessoa_Montagem`, `Status`, `Coduser`, `Datatime`) VALUES (NULL, '$codfolha', '$edit[0]', '$edit[4]', '$edit[1]', '$edit[2]', '$edit[3]', '$status', '$cod_id', current_timestamp())";
                 $conexao->query($Insert);
            }
            email($status,$codfolha,$comentario);
         return 1;
      } else {
        return $conexao->error;
      }
}
function email($status,$codid,$comentario)
{

include ("../databasestart.php");
$link ="http://localhost/Websitetrb/php/adminmenu.php?metodo=aprovar&codfolha=$codid";
$select ="SELECT * FROM `folha de obra` WHERE `Codfolha` = '$codid'";
$query = $conexao->query($select);
while($Result = $query->fetch_array())
{
    $Result["user_notlogin"] == null?$type="user":$type ="admin";
}
if($type == "user")
{
    $field = "Utilizador_assoc";
    $table = "utilizador_bd";
}
else{
    $field = "user_notlogin";
    $table = "utilizador_non_log";
}
$selectclientname = "SELECT * FROM `folha de obra` LEFT JOIN `$table` ON `folha de obra`.`$field` = `$table`.`Cod_id` WHERE `folha de obra`.`Codfolha` = '$codid'";
$query = $conexao->query($selectclientname);
while ($result = $query->fetch_array())
{
    $nomecliente = $result["Nome"];
}
$select = "SELECT * FROM `utilizador_bd` WHERE Nivel = '$status'";
$query = $conexao->query($select);
$titulo = "Folha de obra(aprovar) - $nomecliente";

while ($result = $query->fetch_array())
{
    
    $conteudo = "<h1>Olá ".$result["Nome"].",<h1> <br>
    <h2> Como parte do $status, tens de aprovar uma folha de obra do cliente $nomecliente . <br><a href='".$link."'>Folha de obra $codid</a>";
   $conexao->query("INSERT INTO `comentarios` (`Codfolha`, `Comentario`, `Coduser`) VALUES ('', 'sadas', '59')");
    $comentario =  trim($comentario)!=""?
   " <br> Comentário de ".$_SESSION["Nome"].": <br> $comentario </h2>":"";
   $conteudo.=$comentario;
     $emailrecipiente =$result["Email"];

 echo  send_email($emailrecipiente,$titulo, $conteudo);
}

}
   ?>
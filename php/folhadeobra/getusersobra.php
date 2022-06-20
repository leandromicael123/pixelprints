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

function getallfields($table)
{

    include ("../databasestart.php");
    $select = "SHOW COLUMNS FROM `$table`";
    $Query = MySQLi_query($conexao,  $select);  
    $collect = array();
    while ($Result = MySQLi_fetch_array($Query)) { 
        array_push($collect,$Result["Field"]);
    }
    return json_encode($collect);
}
function niveluseruser()
{
    
    include ("../databasestart.php");
    $select = "SELECT * FROM `niveis`";
    $Query = MySQLi_query($conexao,  $select);  
    $collect = array();
    while ($Result = MySQLi_fetch_array($Query)) { 
        array_push($collect,$Result["Nivel"]);
    }
    return json_encode($collect);
}
 function createuser($tipodedata,$datauser,$mensagem,$montagem,$localizacao,$aprovacao,$status)
 {
    include ("../databasestart.php");
    $folhadeobranum = uniqid(rand());
    function approval($aprovacao,$folhadeobranum)
    { include ("../databasestart.php");
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
        $codigo = uniqid(rand(),true);
      
        $insert_utilizador = "INSERT INTO `utilizador_non_log` (`Cod_id`, `Nome`, `Email`, `NIF`,
         `Telefone_pess`, `Pessoa-contacto`) VALUES ('".$codigo."', '".$datauser[0]."', '".$datauser[2]."', '".$datauser[1]."', '".$datauser[3]."', '".$datauser[4]."')";
        $Query = MySQLi_query($conexao, $insert_utilizador);  
     
        if($Query)
        {
         
        
            $insert_folha = "INSERT INTO `folha de obra` (`Codfolha`, `user_notlogin`, `Utilizador_assoc`, 
            `Pedido_mens`, `Ficheirosloc`, `Budget_montagem`, `Custo_Montagem`,
             `Pessoa_Montagem`, `Status`, `Dataadicionada`) VALUES ('$folhadeobranum', '$codigo', NULL, '$mensagem'
            ,'$localizacao' , '$montagem[0]', '$montagem[1]', '$montagem[2]', '$status', current_timestamp())";
             $Query = MySQLi_query($conexao,  $insert_folha);  
         
             if($Query)
             {
                approval($aprovacao,$folhadeobranum);
                echo "<script>window.location.assign('folhadeobra_result.php?cod=".$folhadeobranum."')</script>";
             }
          
        }
            return 0;
    }
    else
    {
        
        $getfromcodid = $datauser[1];

        if($datauser[0]=="Criado por user")
        {
     
            $insert_folha = "INSERT INTO `folha de obra` (`Codfolha`, `user_notlogin`, `Utilizador_assoc`, 
        `Pedido_mens`, `Ficheirosloc`, `Budget_montagem`, `Custo_Montagem`,
         `Pessoa_Montagem`, `Status`, `Dataadicionada`) VALUES ('$folhadeobranum', NULL, '$getfromcodid', '$mensagem'
        ,'$localizacao' , '$montagem[0]', '$montagem[1]', '$montagem[2]', '$status', current_timestamp())"; 
    }
        else
        {
            $insert_folha = "INSERT INTO `folha de obra` (`Codfolha`, `user_notlogin`, `Utilizador_assoc`, 
            `Pedido_mens`, `Ficheirosloc`, `Budget_montagem`, `Custo_Montagem`,
             `Pessoa_Montagem`, `Status`, `Dataadicionada`) VALUES ('$folhadeobranum', '$getfromcodid', NULL, '$mensagem'
            ,'$localizacao' , '$montagem[0]', '$montagem[1]', '$montagem[2]', '$status', current_timestamp())";
        }
        $Query = MySQLi_query($conexao,  $insert_folha); 
        if($Query)
        {
            approval($aprovacao,$folhadeobranum);
            echo "<script>window.location.assign('folhadeobra_result.php?cod=".$folhadeobranum."')</script>";
        }
    }
 }
   ?>
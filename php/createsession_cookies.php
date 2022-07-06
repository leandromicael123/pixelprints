<?php
session_start();
function create_session($email, $value){
    include ("databasestart.php");
 $select = "SELECT * FROM `utilizador_bd` WHERE `Email` = '$email' " ;
 $Query = MySQLi_query($conexao,  $select);
 if(mysqli_num_rows($Query)>=1){
     while ($Result = MySQLi_fetch_array($Query)) {  
            $Codid = $Result["Cod_id"];
     }
     if($value == 1)
     {
        $_SESSION["Cod_id"] = $Codid;
        return;
     }
    
     setcookie("Cod_id",$Codid,2147483647,"/");
     $_COOKIE["Cod_id"] = $Codid;
     return;
 }

 return 0;

}
function get_session($Cod_id){
    include ("databasestart.php");
    $select = "SELECT * FROM `utilizador_bd` WHERE `utilizador_bd`.`Cod_id` = '$Cod_id'" ;
 $Query = MySQLi_query($conexao,  $select);
 if(mysqli_num_rows($Query)>=1){
     while ($Result = MySQLi_fetch_array($Query)) {  

            $Nome = $Result["Nome"];
            $Email = $Result["Email"];
            $NIF = $Result["NIF"];
            $Morada = $Result["Morada"];
            $Nomeempresa = $Result["Nomeempresa"];
            $Codpostal = $Result["Codpostal"];
            $Telefone_pess = $Result["Telefone_pess"];
            $Datadeentrada = $Result["Datadeentrada"];
            $tipoconta = $Result["tipoconta"];
            $nivel = $Result["Nivel"];
     }
     $_SESSION["Nivel"] = $nivel;
     $_SESSION["Nome"] = $Nome;
     $_SESSION["Email"] = $Email;
     $_SESSION["session"] = true;
     $_SESSION["NIF"] = $NIF;
     $_SESSION["tipoconta"] = $tipoconta;
     $_SESSION["Morada"] = $Morada;
     $_SESSION["Nomeempresa"] = $Nomeempresa;
     $_SESSION["Codpostal"] = $Codpostal;
     $_SESSION["Telefone_pess"] = $Telefone_pess;
     $_SESSION["Datadeentrada"] = $Datadeentrada;

}
else{
}}
function login($email, $password, $sessao){
    include ("databasestart.php");

    $select = "SELECT * FROM `utilizador_bd` WHERE `utilizador_bd`.`email` = '$email'" ;
 $Query = MySQLi_query($conexao,  $select);
 if(mysqli_num_rows($Query)>=1){
     while ($Result = MySQLi_fetch_array($Query)) {  
        if(password_verify($password, $Result["Password"]))
        {
            if($sessao=="on" || $sessao=="true")
            {
                create_session($email,0);
                get_session($_COOKIE["Cod_id"]);  return 1;}

                    create_session($email,1);
                    get_session($_SESSION["Cod_id"]);
                   return 1;
             
        }

     }
    }
return 0;
}
?>
<?php
include ("../databasestart.php");
include ("getusersobra.php");
$request = $_POST["request"];

switch ($request)
{
    case "column":
        echo getallfields("utilizador_bd");
        break;
        case "search":
            $text =   mysqli_real_escape_string($conexao,$_POST["text"]);
$select =  mysqli_real_escape_string($conexao,$_POST["select"]);
echo obrasuser($select,$text);
       break;
       case "nivel":
echo niveluseruser();
   break;
   case "create":
    echo createuser($_POST["tipodeuser"],$_POST["userdata"],$_POST["description"],$_POST["mont"],$_POST["loc"],$_POST["approv"],$_POST["status"]);
    break;
       
}
?>
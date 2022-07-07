<?php
   error_reporting(0);
include ("../databasestart.php");
include ("getusersobra.php");
include ("../sendmailexample.php");

$request = $_POST["request"];
if(isset($request)==false)
{
    exit;
}
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
    echo createuser($_POST["tipodeuser"],$_POST["userdata"],$_POST["description"],$_POST["mont"],$_POST["loc"],$_POST["approv"],$_POST["status"],$_POST["comentario"]);
    break;
    case "getfolhanivel":
  $text = $_POST["text"];
  $select = $_POST["select"];
  $intr = $_POST["intr"];
  echo searchfolha($text,$select,$intr,$_POST["gotic"]);
        break;
        case "folhaobraabs":
            $codid = $_POST["codid"];
            $field = $_POST["field"]==="user"?0:1;
            echo detailedobrasuser($field,$codid);
                  break;
                          case "getnivelfolha":
                            $codid = $_POST["codid"];
                            echo nivelfolha($codid);
                                  break;
                                  case "approvfolha":
                                   echo Aprovarfolha( $_POST["codid"],$_POST["req"]);
                                    break;
                                    case "updatestatus":
                                    echo updatestatus($_POST["codid"],$_POST["nivel"],$_POST["edit_quest"],$_POST["edit"],$_POST["comentario"]);
                                    break;
                                    case "criar dados":
                                      echo createdata($_POST["dados"]);
                                        break;
                                        case "getuserespifico":
                                          echo userspesquisaespecifica($_POST["select"],$_POST["text"],$_POST["tb"]);
                                          break;
}
?>
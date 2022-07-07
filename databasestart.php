<?php $conexao=mysqli_connect('localhost','root');
if(!$conexao)
{
echo 'Ligação ao servidor impossivel';exit;
}
mysqli_select_db($conexao, 'database_pixelprints');
?>
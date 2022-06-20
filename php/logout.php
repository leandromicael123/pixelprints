<?php
session_start();
session_destroy();

setcookie('Cod_id', null, -1, '/');
echo "<script>window.location.assign('Index.php')</script>";
?> 
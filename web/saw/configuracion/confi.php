<?php 
session_start();
$_SESSION['dia']=(isset($_REQUEST['lstDias']))?  $_REQUEST['lstDias'] : 0;
$_SESSION['inicio']=(isset($_REQUEST['lstHinicio']))?  $_REQUEST['lstHinicio'] : 0;;
$_SESSION['aula']=$_REQUEST['aula'];
header('Location: ../administracion.php');
?>
     
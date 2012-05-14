<?php 
session_start();
$_SESSION['dia']=(isset($_POST['lstDias']))?  $_POST['lstDias'] : 0;
$_SESSION['inicio']=(isset($_POST['lstHinicio']))?  $_POST['lstHinicio'] : 0;;
$_SESSION['aula']=$_GET['aula'];
header('Location: ../administracion.php');
?>
     
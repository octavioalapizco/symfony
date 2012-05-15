<!--setinterval!-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?
require_once('conectar.php');
session_start();
$link=conector();

$hora = date ("h:i"); 


 $dia = date("w");

 if($dia<6)
 {
	 if($hora=="9:30"){
		 $carga=20;
	 }else if($hora=="5:15"){
		 $carga=45;			
	 }else{
		 $carga=5;
 }}
 else{
 	$carga=100;}
//LUNES
if($dia==1){ 
 //AULA 1
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=1 order by Hora_Inicio";
 $res1=mysql_query($sql,$link);
 $reg1=mysql_fetch_object($res1);
 
 if(isset($_SESSION["band11"]) && $_SESSION["band11"]==0){
 	if($hora==$reg1->Hora_Inicio){
		$_SESSION["band11"]=1;
		}
 }else{
	if(is_object($reg1) && $hora==$reg1->Hora_Final){
		$_SESSION["band11"]=0;
		}
	}
	
//AULA 2	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res2=mysql_query($sql,$link);
 $reg2=mysql_fetch_object($res2);
 
 if(isset($_SESSION["band21"]) && $_SESSION["band21"]==0){
 	if($hora==$reg2->Hora_Inicio){
		$_SESSION["band21"]=1;
		}
 }else{
	if($hora==$reg2->Hora_Final){
		$_SESSION["band21"]=0;
		}
	} 	

//AULA 3	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res3=mysql_query($sql,$link);
 $reg3=mysql_fetch_object($res3);
 
 if(isset($_SESSION["band31"]) && $_SESSION["band31"]==0){
 	if($hora==$reg3->Hora_Inicio){
		$_SESSION["band31"]=1;
		}
 }else{
	if($hora==$reg3->Hora_Final){
		$_SESSION["band31"]=0;
		}
	}
	
//AULA 4	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=4 order by Hora_Inicio";
 $res4=mysql_query($sql,$link);
 $reg4=mysql_fetch_object($res4);
 
 if(isset($_SESSION["band41"]) && $_SESSION["band41"]==0){
 	if($hora==$reg4->Hora_Inicio){
		$_SESSION["band41"]=1;
		}
 }else{
	if(is_object($reg4) && $hora==$reg4->Hora_Final){
		$_SESSION["band41"]=0;
		}
	}		
} 
if($dia==2){ 
 //AULA 1
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=1 order by Hora_Inicio";
 $res1=mysql_query($sql,$link);
 $reg1=mysql_fetch_object($res1);
 
 if($_SESSION["band11"]==0){
 	if($hora==$reg1->Hora_Inicio){
		$_SESSION["band11"]=1;
		}
 }else{
	if($hora==$reg1->Hora_Final){
		$_SESSION["band11"]=0;
		}
	}
	
//AULA 2	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res2=mysql_query($sql,$link);
 $reg2=mysql_fetch_object($res2);
 
 if($_SESSION["band21"]==0){
 	if($hora==$reg2->Hora_Inicio){
		$_SESSION["band21"]=1;
		}
 }else{
	if($hora==$reg2->Hora_Final){
		$_SESSION["band21"]=0;
		}
	} 	

//AULA 3	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res3=mysql_query($sql,$link);
 $reg3=mysql_fetch_object($res3);
 
 if($_SESSION["band31"]==0){
 	if($hora==$reg3->Hora_Inicio){
		$_SESSION["band31"]=1;
		}
 }else{
	if($hora==$reg3->Hora_Final){
		$_SESSION["band31"]=0;
		}
	}
	
//AULA 4	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=4 order by Hora_Inicio";
 $res4=mysql_query($sql,$link);
 $reg4=mysql_fetch_object($res4);
 
 if($_SESSION["band41"]==0){
 	if($hora==$reg4->Hora_Inicio){
		$_SESSION["band41"]=1;
		}
 }else{
	if($hora==$reg4->Hora_Final){
		$_SESSION["band41"]=0;
		}
	}		
} 
if($dia==3){ 
 //AULA 1
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=1 order by Hora_Inicio";
 $res1=mysql_query($sql,$link);
 $reg1=mysql_fetch_object($res1);
 
 if($_SESSION["band11"]==0){
 	if($hora==$reg1->Hora_Inicio){
		$_SESSION["band11"]=1;
		}
 }else{
	if($hora==$reg1->Hora_Final){
		$_SESSION["band11"]=0;
		}
	}
	
//AULA 2	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res2=mysql_query($sql,$link);
 $reg2=mysql_fetch_object($res2);
 
 if($_SESSION["band21"]==0){
 	if($hora==$reg2->Hora_Inicio){
		$_SESSION["band21"]=1;
		}
 }else{
	if($hora==$reg2->Hora_Final){
		$_SESSION["band21"]=0;
		}
	} 	

//AULA 3	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res3=mysql_query($sql,$link);
 $reg3=mysql_fetch_object($res3);
 
 if($_SESSION["band31"]==0){
 	if($hora==$reg3->Hora_Inicio){
		$_SESSION["band31"]=1;
		}
 }else{
	if($hora==$reg3->Hora_Final){
		$_SESSION["band31"]=0;
		}
	}
	
//AULA 4	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=4 order by Hora_Inicio";
 $res4=mysql_query($sql,$link);
 $reg4=mysql_fetch_object($res4);
 
 if($_SESSION["band41"]==0){
 	if($hora==$reg4->Hora_Inicio){
		$_SESSION["band41"]=1;
		}
 }else{
	if($hora==$reg4->Hora_Final){
		$_SESSION["band41"]=0;
		}
	}		
} 
if($dia==4){ 
 //AULA 1
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=1 order by Hora_Inicio";
 $res1=mysql_query($sql,$link);
 $reg1=mysql_fetch_object($res1);
 
 if($_SESSION["band11"]==0){
 	if($hora==$reg1->Hora_Inicio){
		$_SESSION["band11"]=1;
		}
 }else{
	if($hora==$reg1->Hora_Final){
		$_SESSION["band11"]=0;
		}
	}
	
//AULA 2	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res2=mysql_query($sql,$link);
 $reg2=mysql_fetch_object($res2);
 
 if($_SESSION["band21"]==0){
 	if($hora==$reg2->Hora_Inicio){
		$_SESSION["band21"]=1;
		}
 }else{
	if($hora==$reg2->Hora_Final){
		$_SESSION["band21"]=0;
		}
	} 	

//AULA 3	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res3=mysql_query($sql,$link);
 $reg3=mysql_fetch_object($res3);
 
 if($_SESSION["band31"]==0){
 	if($hora==$reg3->Hora_Inicio){
		$_SESSION["band31"]=1;
		}
 }else{
	if($hora==$reg3->Hora_Final){
		$_SESSION["band31"]=0;
		}
	}
	
//AULA 4	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=4 order by Hora_Inicio";
 $res4=mysql_query($sql,$link);
 $reg4=mysql_fetch_object($res4);
 
 if($_SESSION["band41"]==0){
 	if($hora==$reg4->Hora_Inicio){
		$_SESSION["band41"]=1;
		}
 }else{
	if($hora==$reg4->Hora_Final){
		$_SESSION["band41"]=0;
		}
	}		
} 
if($dia==5){ 
 //AULA 1
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=1 order by Hora_Inicio";
 $res1=mysql_query($sql,$link);
 $reg1=mysql_fetch_object($res1);
 
 if(isset($_SESSION["band11"]) && $_SESSION["band11"]==0){
 	if($hora==$reg1->Hora_Inicio){
		$_SESSION["band11"]=1;
		}
 }else{
	if($hora==$reg1->Hora_Final){
		$_SESSION["band11"]=0;
		}
	}
	
//AULA 2	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=2 order by Hora_Inicio";
 $res2=mysql_query($sql,$link);
 $reg2=mysql_fetch_object($res2);
 
 if(isset($_SESSION["band21"]) && $_SESSION["band21"]==0){
 	if($hora==$reg2->Hora_Inicio){
		$_SESSION["band21"]=1;
		}
 }else{
	if( $hora==$reg2->Hora_Final){
		$_SESSION["band21"]=0;
		}
	} 	

//AULA 3	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=3 order by Hora_Inicio";
 $res3=mysql_query($sql,$link);
 $reg3=mysql_fetch_object($res3);
 
 if(isset($_SESSION["band31"]) && $_SESSION["band31"]==0){
 	if($hora==$reg3->Hora_Inicio){
		$_SESSION["band31"]=1;
		}
 }else{
	if(is_object($reg3) && $hora==$reg3->Hora_Final){
		$_SESSION["band31"]=0;
		}
	}
	
//AULA 4	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=4 order by Hora_Inicio";
 $res4=mysql_query($sql,$link);
 $reg4=mysql_fetch_object($res4);
 
 if(isset($_SESSION["band41"]) && $_SESSION["band41"]==0){
 	if($hora==$reg4->Hora_Inicio){
		$_SESSION["band41"]=1;
		}
 }else{
	if(is_object($reg4) && $hora==$reg4->Hora_Final){
		$_SESSION["band41"]=0;
		}
	}		
} 
if($dia==6){ 
 //AULA 1
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=1 order by Hora_Inicio";
 $res1=mysql_query($sql,$link);
 $reg1=mysql_fetch_object($res1);
 
 if( isset($_SESSION["band11"]) && $_SESSION["band11"]==0){
 	if($hora==$reg1->Hora_Inicio){
		$_SESSION["band11"]=1;
		}
 }else{
	if($hora==$reg1->Hora_Final){
		$_SESSION["band11"]=0;
		}
	}
	
//AULA 2	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res2=mysql_query($sql,$link);
 $reg2=mysql_fetch_object($res2);
 
 if( isset($_SESSION["band21"]) && $_SESSION["band21"]==0){
 	if($hora==$reg2->Hora_Inicio){
		$_SESSION["band21"]=1;
		}
 }else{
	if( is_object($reg2) && $hora==$reg2->Hora_Final){
		$_SESSION["band21"]=0;
		}
	} 	

//AULA 3	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=1 and horarios.aula=$dia order by Hora_Inicio";
 $res3=mysql_query($sql,$link);
 $reg3=mysql_fetch_object($res3);
 
 if(isset($_SESSION["band31"]) && $_SESSION["band31"]==0){
 	if($hora==$reg3->Hora_Inicio){
		$_SESSION["band31"]=1;
		}
 }else{
	if(is_object($reg3) && $hora==$reg3->Hora_Final){
		$_SESSION["band31"]=0;
		}
	}
	
//AULA 4	
 $sql="select H.hora as Hora_Inicio,H2.hora as Hora_Final from dias inner join horarios on dias.id=horarios.id_dia	inner join horas as H on horarios.id_horainicio=H.id inner join horas as H2 on horarios.id_horafinal=H2.id where dias.id=$dia and horarios.aula=4 order by Hora_Inicio";
 $res4=mysql_query($sql,$link);
 $reg4=mysql_fetch_object($res4);
 
 if(isset($_SESSION["band41"]) && $_SESSION["band41"]==0){
 	if($hora==$reg4->Hora_Inicio){
		$_SESSION["band41"]=1;
		}
 }else{
	if(is_object($reg4) && $hora==$reg4->Hora_Final){
		$_SESSION["band41"]=0;
		}
	}		
} 
 	 
?>
<meta http-equiv="refresh" content="<? echo $carga; ?>">
<html>
<head>




<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo4 {
	color: #6600CC;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo9 {color: #6600CC}
-->
</style>

<script type="text/javascript">
configurarAula=function(aula){
	console.log(this);
	//alert("Configurar Aula: "+aula);
	top.location='configuracion/confi.php?aula='+aula;
	//window.open();
}

</script>
<style type="text/css">
table, th, td
{
border: none;
}
</style>

</head>

<body>

<? 
		
date_default_timezone_set("America/Mazatlan");
	
if(isset($_POST['btnEncendido1'])){
		$_SESSION["band11"]=1;
			if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('1234.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('123.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('124.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('134.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('1.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('12.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('13.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('14.exe');


	}
	if(isset($_POST['btnApagado1'])){
		$_SESSION["band11"]=0;
		if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('234.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('23.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('24.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('34.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('0.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('2.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('3.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('4.exe');
	}
	if(isset($_POST['btnEncendido2'])){
		$_SESSION["band21"]=1;
			if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('1234.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('123.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('124.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('234.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('24.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('12.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('23.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('2.exe');


		}
	if(isset($_POST['btnApagado2'])){
		$_SESSION["band21"]=0;
		if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('134.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('13.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('14.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('34.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('4.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('1.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('3.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('0.exe');
	}	
	if(isset($_POST['btnEncendido3'])){
		$_SESSION["band31"]=1;
			if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('1234.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('123.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('234.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('134.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('3.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('23.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('13.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('34.exe');

	}
	if(isset($_POST['btnApagado3'])){
		$_SESSION["band31"]=0;
		if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('124.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('12.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('24.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('14.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('0.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('2.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('1.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('4.exe');
	}	
	if(isset($_POST['btnEncendido4'])){
		$_SESSION["band41"]=1;
			if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('1234.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('124.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('234.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('134.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('4.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('24.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==1 )
		exec('14.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==1 )
		exec('34.exe');

	}
	if(isset($_POST['btnApagado4'])){
		$_SESSION["band41"]=0;
		if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('123.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('12.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('23.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('13.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('0.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==1 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('2.exe');
			else if($_SESSION["band11"]==1 && $_SESSION["band21"]==0 && $_SESSION["band31"]==0 && $_SESSION["band41"]==0 )
		exec('1.exe');
			else if($_SESSION["band11"]==0 && $_SESSION["band21"]==0 && $_SESSION["band31"]==1 && $_SESSION["band41"]==0 )
		exec('3.exe');
	}	
	

	
?>
<form name="form1" method="post" action="">
  <table width="806" border="0">
    <tr>
      <td width="500" height="300"><table width="297" border="1" align="center" bordercolor="#999999">
        <tr>
          <th colspan="2" class="Estilo4" scope="col">Aula #1</th>
        </tr>
        <tr>
          <td width="137" ><img src="images/1336800852_bulb_256.png" width="137" > </td>
          <td width="144"><p class="Estilo4">
              Hora Inicio
            </p>
              <p>
			  
                <input name="txthoraini1" type="text" id="txthoraini12" value="<? if($hora==$reg1->Hora_Inicio) echo $reg1->Hora_Inicio ?>">
				
                <span class="Estilo4">Hora Final </span> </p>
              <p>
                <input name="txthorafin1" type="text" id="txthorafin12" value="<? if($hora==$reg1->Hora_Final) echo $reg1->Hora_Final ?>">
            </p></td>
        </tr>
        <tr>
          <td><input name="BtnEncendido1" type="submit" id="BtnEncendido1" value="On">
            <input name="BtnApagado1" type="submit" id="BtnApagado1" value="Off"></td>
          <td><input name="BConfig1" type="button" id="BConfig1" value="Configuracion" onClick= configurarAula(1)></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table></td>
      <td width="500" ><table width="297" border="1" align="center">
        <tr>
          <th colspan="2" scope="col"><span class="Estilo4">Aula #2</span></th>
        </tr>
        <tr>
          <td width="137" ><img src="images/1336800852_bulb_256.png" width="137"> </td>
          <td width="144"><p class="Estilo4">Hora Inicio </p>
              <p>
                <input name="txthoraini2" type="text" id="txthoraini22" value="<? if(is_object($reg2) && $hora==$reg2->Hora_Inicio) echo $reg2->Hora_Inicio ?>">
                <span class="Estilo4">Hora Final </span></p>
              <p>
                <input name="txthorafin2" type="text" id="txthorafin22" value="<? if(is_object($reg2) && $hora==$reg2->Hora_Final) echo $reg2->Hora_Final ?>">
            </p></td>
        </tr>
        <tr>
          <td><input name="BtnEncendido2" type="submit" id="BtnEncendido2" value="On">
            <input name="BtnApagado2" type="submit" id="BtnApagado2" value="Off"></td>
          <td><input name="BConfig2" type="button" id="BConfig2" value="Configuracion" onClick= configurarAula(2)></td>
        </tr>
        <tr>
          <td height="26" colspan="2">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td width="500" ><table width="297" border="1" align="center">
        <tr>
          <th colspan="2" scope="col"><span class="Estilo4">Aula #3</span></th>
        </tr>
        <tr>
          <td width="137" ><img src="images/1336800852_bulb_256.png" width="137" 	> </td>
          <td width="144"><p class="Estilo4">Hora Inicio </p>
              <p>
                <input name="txthoraini3" type="text" id="txthoraini32" value="<? if(is_object($reg3) && $hora==$reg3->Hora_Inicio) echo $reg3->Hora_Inicio ?>">
                <span class="Estilo4">Hora Final </span></p>
              <p>
                <input name="txthorafin3" type="text" id="txthorafin32" value="<? if(is_object($reg3) && $hora==$reg3->Hora_Final) echo $reg3->Hora_Final ?>"s>
            </p></td>
        </tr>
        <tr>
          <td><input name="BtnEncendido3" type="submit" id="BtnEncendido3" value="On">
            <input name="BtnApagado3" type="submit" id="BtnApagado3" value="Off"></td>
          <td><input name="BConfig3" type="button" id="BConfig3" value="Configuracion" onClick= configurarAula(3)></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table></td>
      <td width="500" height="300"><table width="297" border="1" align="center">
        <tr>
          <th colspan="2" scope="col"><span class="Estilo4">Aula #4</span></th>
        </tr>
        <tr>
          <td width="137" ><img src="images/1336800852_bulb_256.png" width="137" > </td>
          <td width="144"><p class="Estilo4">Hora Inicio </p>
              <p>
                <input name="txthoraini4" type="text" id="txthoraini42" value="<? if(is_object($reg4) && $hora==$reg4->Hora_Inicio) echo $reg4->Hora_Inicio?>">
                <span class="Estilo4">Hora Final </span></p>
              <p>
                <input name="txthorafin4" type="text" id="txthorafin4" value="<? if(is_object($reg4) &&  $hora==$reg4->Hora_Final) echo $reg4->Hora_Final?>">
            </p>
		 </td>
        </tr>
        <tr>
          <td><input name="BtnEncendido4" type="submit" id="BtnEncendido4" value="On">
            <input name="BtnApagado4" type="submit" id="BtnApagado4" value="Off"></td>
          <td><input name="BConfig4" type="button" id="BConfig4" value="Configuracion" onClick= configurarAula(4)></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>

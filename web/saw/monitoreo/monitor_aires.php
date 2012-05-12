<?php 
require_once('conectar.php');
session_start();
$link=conector();

$hora = date ("h:i"); 

echo $hora;
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

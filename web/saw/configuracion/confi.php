<? session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<style type="text/css">
table, th, td
{
border: none;
}
</style>
</head>

<body>
<script>
function sumar(dia)
	{	
		var n1=document.getElementById(dia);
		if(n1.value<6)
		{
			document.form1.lstHinicio.value=1;
			document.form1.lstHfinal.value=2;
		}else{
			document.form1.lstHinicio.value=18;
			document.form1.lstHfinal.value=19;
		}	
	}
			
</script>

<?
	
	require_once('conectar.php');
	$link=conector();
	$band=0;
	if(isset ($_POST['btnGuardar']))
	{
		$sql= "insert into horarios set aula=$_GET[aula],id_dia=$_POST[lstDias],id_horainicio=$_POST[lstHinicio],id_horafinal=$_POST[lstHfinal];";
		mysql_query($sql,$link);
	}
	
		if(isset($_SESSION['dia']) && isset($_POST['lstDias']) && $_SESSION['dia']!=$_POST['lstDias'])
	{
			if($_POST['lstDias']<6)
				$_POST['lstHinicio']=1;
			else
				$_POST['lstHinicio']=18;		
	}
	
		if(isset($_SESSION['inicio']) && $_SESSION['inicio']!=$_POST['lstHinicio'])
	{
		if($_POST['lstDias']<6) {
			$sql='select * from horas where status=1 and id>'.$_POST['lstHinicio'].';';
			$res3=mysql_query($sql,$link); }
		else {
			$sql='select * from horas where status=0 and id>'.$_POST['lstHinicio'].';';
			$res3=mysql_query($sql,$link); }
			$band=1;	
	}		
			
	
?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" height="100" border="0">
    <tr>
      <th width="34%" height="100" scope="col">
      <table width="200" border="1">
        <tr>
          <td><div align="center">AULA <? echo $_GET['aula'] ?></div></td>
        </tr>
        <tr>
          <td><label>
            <select name="lstDias" size="1" onchange="document.form1.submit();">
              <?
			$sql="select * from dias";
			$res=mysql_query($sql,$link);

			while($reg=mysql_fetch_object($res)){
			 ?>
              <option value="<?=$reg->id ?>" <? if(isset($_POST['lstDias']) && $_POST['lstDias']==$reg->id) echo "selected";?> >
                <?=$reg->dia ?>
                </option>
              <? 
			}
		?>
              </select>
            </label></td>
        </tr>
        <tr>
          <td>Hora Inicio</td>
        </tr>
        <tr>
          <td><label>
            <select name="lstHinicio" size="1" id="lstHinicio" onchange="document.form1.submit();">
              <?
			  
				if($_POST['lstDias']<6)
				{
				$sql="select * from horas where status=1";
				$res=mysql_query($sql,$link);
				}
				
				if($_POST['lstDias']==6)
				{
				$sql="select * from horas where status=0";
				$res=mysql_query($sql,$link);
				}
	
			  
			while($reg=mysql_fetch_object($res)){
		?>
              <option value="<?=$reg->id ?>" <? if(isset($_POST['lstHinicio']) && $_POST['lstHinicio']==$reg->id) echo "selected";?> >
              <?=$reg->hora ?>
              </option>
              <? 
			}
		?>
            </select>
          </label></td>
        </tr>
        <tr>
          <td>Hora Final</td>
        </tr>
        <tr>
          <td><label>
            <select name="lstHfinal" id="lstHfinal">
             <?
			 if($band==0){
				 if($_POST['lstDias']==6) 
				 {
					$sql="select * from horas where status=0 and id>18";
					$res3=mysql_query($sql,$link); 
				 }else{
				 	$sql="select * from horas where status=1 and id>1";
					$res3=mysql_query($sql,$link);
				 }
				
			 }
			while($reg=mysql_fetch_object($res3)){
			?>
              <option value="<?=$reg->id ?>" <? if($band==0 && $reg->id==2) ;?> >
              <?=$reg->hora ?>
              </option>
              <? 
			}
		?>
            </select>
          </label></td>
        </tr>
        <tr>
          <td><input type="submit" name="btnGuardar" value="Guardar" /></td>
        </tr>
      </table>
      <? 
	  
	  	$_SESSION['dia']=(isset($_POST['lstDias']))?  $_POST['lstDias'] : 0;
		$_SESSION['inicio']=(isset($_POST['lstHinicio']))?  $_POST['lstHinicio'] : 0;;
		$_SESSION['aula']=$_GET['aula'];
	  ?>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></th>
      <th width="19%" scope="col">&nbsp;</th>
      <td width="344" scope="col"><iframe width="100%" frameborder="0" height="350" src="confdia.php"></iframe></td></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
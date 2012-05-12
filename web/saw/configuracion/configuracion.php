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
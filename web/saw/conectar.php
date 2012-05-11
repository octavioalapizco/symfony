<?
	function conector(){
		//$link=mysql_connect("201.155.192.116","ccanedo","1029384756");
		$link=mysql_connect("localhost","root","");
		mysql_select_db("saw");
		return $link;
	}
?>
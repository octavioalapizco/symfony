<?php session_start(); ?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Xayona Website Template</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/ie7.css" type="text/css" />
		<![endif]-->
	</head>
	<body>
		<div class="page">
			<div class="header">		
				<div class="logo">
				<div class="text1">S</div><div class="text2">AW</div>
				</div>
				<ul>
					<li					><a href="index.html">Home</a></li>
					<li 				><a href="nosotros.html">Nosotros</a></li>
					<li					><a href="monitoreo.html">Monitoreo</a></li>		
					<li	class="selected"><a href="administracion.html">Administraci&oacute;n</a></li>
				</ul>
			</div>
			<div class="body">
				<div id="featured">
					<div style="display:inline-block;">
						<h3 style="width:auto;display:inline-block;padding:0;">Aula 2</h3>
						<h3 style="width:auto;display:inline-block;padding:0;">Dia: <?php echo $_SESSION['dia'];?></h3>
					</div>
					<?php include 'configuracion/confi.php'; ?>
				</div>
				
			</div>
			<div class="footer">
				<ul>
					<li ><a href="index.html">Home</a></li>
					<li><a href="about.html">Nosotros</a></li>
					<li><a href="monitoreo.html">Monitoreo</a></li>
					<li class="selected"><a href="administracion.html">Administraci&oacute;n</a></li>
				</ul>
				<p>&#169; Copyright &#169; 2011. Company name all rights reserved</p>
				<div class="connect">
					<a href="http://facebook.com/freewebsitetemplates" id="facebook">facebook</a>
					<a href="http://twitter.com/fwtemplates" id="twitter">twitter</a>
					<a href="http://www.youtube.com/fwtemplates" id="vimeo">vimeo</a>
				</div>
			</div>
		</div>
	</body>
</html>  
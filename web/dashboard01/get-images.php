<?php
$respuesta=array('images');

$iconos=array(
	
	array(
		'icon'=>'imagenes/128/protect_blue.png',
		'name'=>'Seguridad'		
	),
	array(
		'icon'=>'imagenes/128/favorites.png',
		'name'=>'Preferencias'		
	),
	array(
		'icon'=>'imagenes/128/camera_blue.png',
		'name'=>'Galeria'		
	),
	array(
		'icon'=>'imagenes/128/news.png',
		'name'=>'Noticia'		
	),
	array(
		'icon'=>'imagenes/128/camera_blue.png',
		'name'=>'Galeria'		
	),
	array(
		'icon'=>'imagenes/128/camera_blue.png',
		'name'=>'Galeria'		
	)
	
);
for($i=0; $i<27; $i++){
	
	

	$respuesta['images'][]=array(		
		'icon'		=>(isset( $iconos[$i] ))? $iconos[$i]['icon'] : 'imagenes/128/invoice.png',		
		'name'		=>(isset( $iconos[$i] ))? $iconos[$i]['name'] :'Menu',
		'shortName'	=>(isset( $iconos[$i] ))? $iconos[$i]['name'] :'Menu',
		
	);

}

echo json_encode($respuesta);



?>
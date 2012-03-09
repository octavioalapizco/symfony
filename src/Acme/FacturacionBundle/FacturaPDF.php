<?php
namespace  Acme\FacturacionBundle;

use fpdf;

class FacturaPDF extends fpdf\FPDF{
//class FacturaPDF  {
	function hola(){
		
		echo "holamundo";
	}
	function FacturaPDF($orientation='P', $unit='mm', $size='A4'){
		exit;
		return parent::__construct($orientation, $unit, $size);
	}
}
?>
<?php
namespace Acme\BlogBundle;
use fpdf;
class FacturaPdf extends fpdf\FPDF{
	function generarPdf($filename='factura.pdf'){
		$this->AddPage();
		$this->SetFont('Arial','B',16);
		$this->imprimeEmisor();
		$this->imprimeReceptor();
		$this->imprimeDatosDeLaFactura();
		$this->imprimeConceptos();
		$this->imprimeLeyendas();
		$this->imprimeTotales();
		
		$this->Output($filename);
	}
	function imprimeEmisor(){
		$this->Cell(40,10,'DATOS DEL EMISOR',0,1);		
	}
	
	function imprimeReceptor(){
		$this->Cell(40,10,'DATOS DEL EMISOR',0,1);		
	}
	
	function imprimeDatosDeLaFactura(){
		$this->Cell(40,10,'DATOS DEL EMISOR',0,1);		
	}
	
	function imprimeConceptos(){
		$this->Cell(40,10,'DATOS DEL EMISOR',0,1);		
	}
	
	function imprimeLeyendas(){
		$this->Cell(40,10,'DATOS DEL EMISOR',0,1);		
	}
	
	function imprimeTotales(){
		$this->Cell(40,10,'DATOS DEL EMISOR',0,1);		
	}
}
?>
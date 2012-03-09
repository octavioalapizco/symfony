<?php
namespace Acme\FacturacionBundle;
use fpdf;
class FacturaPdf extends fpdf\FPDF{
	function generarPdf($facturaObj,$filename='factura.pdf'){
		$this->facturaObj=$facturaObj;
		$this->AddPage();
		$this->SetFont('Arial','B',16);
		//------------------------------------------------
		$this->imprimeEmisor();
		$this->imprimeReceptor();
		$this->imprimeDatosDeLaFactura();
		$this->imprimeConceptos();
		$this->imprimeLeyendas();
		$this->imprimeTotales();
		//------------------------------------------------
		$this->Output($filename);
	}
	
	function imprimeEmisor(){
		$emisor=$this->facturaObj->Emisor;	
		
		$this->SetFont('Arial','B',8);		
		$this->Cell(40,3,'DATOS DEL EMISOR',0,1);
		$this->SetFont('Arial','',7);		
		$this->Cell(40,2.5,$emisor['nombre'],0,1);
		$this->Cell(40,2.5,$emisor['rfc'],0,1);
		//--------- DOMICILIO --------- //
		$domicilio=$emisor->DomicilioFiscal;
		if ( !empty($domicilio['calle']) )			$this->Cell(40,2.5,$domicilio['calle'],0,1);
		if ( !empty($domicilio['noExterior']) )		$this->Cell(40,2.5,$domicilio['noExterior'],0,1);
		if ( !empty($domicilio['noInterior']) )		$this->Cell(40,2.5,$domicilio['noInterior'],0,1);
		if ( !empty($domicilio['colonia']) )		$this->Cell(40,2.5,$domicilio['colonia'],0,1);
		if ( !empty($domicilio['localidad']) )		$this->Cell(40,2.5,$domicilio['localidad'],0,1);
		if ( !empty($domicilio['municipio']) )		$this->Cell(40,2.5,$domicilio['municipio'],0,1);
		if ( !empty($domicilio['estado']) )			$this->Cell(40,2.5,$domicilio['estado'],0,1);
		if ( !empty($domicilio['pais']) )			$this->Cell(40,2.5,$domicilio['pais'],0,1);
		if ( !empty($domicilio['codigoPostal']) )	$this->Cell(40,2.5,$domicilio['codigoPostal'],0,1);		
	}
	
	function imprimeReceptor(){
		$Receptor=$this->facturaObj->Receptor;			
		$this->SetFont('Arial','B',8);		
		$this->Cell(40,3,'DATOS DEL RECEPTOR',0,1);				
		$this->SetFont('Arial','',7);		
		$this->Cell(40,2.5,$Receptor['nombre'],0,1);
		$this->Cell(40,2.5,$Receptor['rfc'],0,1);
		//--------- DOMICILIO --------- //
		$domicilio=$Receptor->Domicilio;
		if ( !empty($domicilio['calle']) )			$this->Cell(40,2.5,$domicilio['calle'],0,1);
		if ( !empty($domicilio['noExterior']) )		$this->Cell(40,2.5,$domicilio['noExterior'],0,1);
		if ( !empty($domicilio['noInterior']) )		$this->Cell(40,2.5,$domicilio['noInterior'],0,1);
		if ( !empty($domicilio['colonia']) )		$this->Cell(40,2.5,$domicilio['colonia'],0,1);
		if ( !empty($domicilio['localidad']) )		$this->Cell(40,2.5,$domicilio['localidad'],0,1);
		if ( !empty($domicilio['municipio']) )		$this->Cell(40,2.5,$domicilio['municipio'],0,1);
		if ( !empty($domicilio['estado']) )			$this->Cell(40,2.5,$domicilio['estado'],0,1);
		if ( !empty($domicilio['pais']) )			$this->Cell(40,2.5,$domicilio['pais'],0,1);
		if ( !empty($domicilio['codigoPostal']) )	$this->Cell(40,2.5,$domicilio['codigoPostal'],0,1);	
	}
	
	function imprimeDatosDeLaFactura(){
		$this->Cell(40,10,'DATOS DE LA FACTURA',0,1);		
	}
	
	function imprimeConceptos(){
		$this->Cell(40,10,'CONCEPTOS',0,1);		
	}
	
	function imprimeLeyendas(){
		$this->Cell(40,10,'LEYENDAS',0,1);		
	}
	
	function imprimeTotales(){
		$this->Cell(40,10,'TOTALES',0,1);		
	}
	function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link=''){
		$txt=utf8_decode($txt);
		return parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
	}
}
?>
<?php
namespace Acme\FacturacionBundle\Resources\views_pdf;
use fpdf;
class FacturaPdf extends fpdf\FPDF{
	var  $formato=false;
	var $fijarX=false;
	
	function generarPdf($facturaObj,$filename='factura.pdf'){
		$this->facturaObj=$facturaObj;
		$this->yFooter=170;
		$this->SetFont('Arial','B',16);
		$this->SetAutoPageBreak(true,75);
		$this->AddPage();
		//$this->setY(50);
		$this->imprimeConceptos();
		//------------------------------------------------		
		//------------------------------------------------
		$this->Output($filename);
	}
	
	function header(){
		$yLogo=$this->getY();
		$this->imprimeLogo();
		$this->addY(18.3);
		$this->setFont('Arial','B',10);
		$this->addX(2);
		$this->cell(10,4,'www.facturacion.expresso.com',0,1);
		$this->setY($yLogo-6);
		//$this->imprimeDatosDeLaFactura();		
		$y=$this->getY()+6;
		$this->setY($yLogo);
		$this->fijarX(30);		
		$this->imprimeEmisor();
		$this->liberarX();
		$this->setY($yLogo);
		$this->imprimeReceptor();
		$this->addY(5);//$y=this->getY(); $this->setY($y+5);
		$this->setX(167);
		$this->Cell(40,3,'Efectos fiscales al pago',0,1);
		$this->imprimeEncabezados();		
	}
	function footer(){
		$this->setY($this->yFooter);
		//-------------------------------------------------------------------------------------------------------------
		$this->SetFillColor(139,0,0);
		$this->setTextColor(255,255,255);$this->SetFont('Courier','B',8);		
		$this->rect($this->getX(),$this->getY()+3.3,190,.6,'F');
		$this->Cell(50,4,'SELLO DIGITAL',0,0,'L',true);
		$this->setFont('Arial','',6);$this->setTextColor(0,0,0);		
		$this->formato=false;
		$this->Cell(10,3,'Este documento es una representación impresa de un CFD',0,0,'L');	$this->Cell(40,4,'',0,1);
		$this->addY(.5);		
		$this->setTextColor(0,0,0);$this->SetFont('Courier','',7);		$this->SetFillColor(255,255,255);
		$this->MultiCell(190,2,$this->facturaObj['sello'],0,1,'L',false);		
		//-------------------------------------------------------------------------------------------------------------
		$this->addY(2);
		$this->SetFillColor(139,0,0);
		$this->setTextColor(255,255,255);$this->SetFont('Courier','B',8);		
		$this->rect($this->getX(),$this->getY()+3.3,190,.6,'F');
		$this->Cell(50,4,'CERTIFICADO DIGITAL',0,1,'L',true);
		$this->addY(.5);		
		$this->setTextColor(0,0,0);$this->SetFont('Courier','',6);		$this->SetFillColor(255,255,255);
		$elMensaje=preg_replace("/\s+/"," ",$this->facturaObj['certificado']);
		//$elMensaje=str_replace('\n','--',$this->facturaObj['certificado']);
		//echo $elMensaje;exit;
		$this->MultiCell(190,2,$elMensaje,0,1,'L',false);
		//-------------------------------------------------------------------------------------------------------------
		$this->addY(2);
		$this->SetFillColor(139,0,0);
		$this->setTextColor(255,255,255);$this->SetFont('Courier','B',8);		
		$this->rect($this->getX(),$this->getY()+3.3,190,.6,'F');
		$this->Cell(50,4,'CADENA ORIGINAL',0,1,'L',true);
		$this->addY(.5);		
		$this->setTextColor(0,0,0);$this->SetFont('Courier','',7);		$this->SetFillColor(255,255,255);
		$this->MultiCell(190,2,'00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000',0,1,'L',false);
		//-------------------------------------------------------------------------------------------------------------
		$this->SetFillColor(139,0,0);
		$this->addY(12);
		$this->rect($this->getX(),$this->getY(),190,.2,'F');		
		$this->Cell(40,1,'',0,1);
		
		$y=$this->getY()+2;		
		$this->setY($y);
		$this->imprimeAdicional();
		$this->setY($y);
		$this->imprimeTotales();
		
		$y=$this->getY();
		
		$alto=1.3;
		$this->cell(0,3,'',0,1);
		$this->SetFont('Arial','',7);				
		//--------------------------------------------------------------------
		$this->setY(265);$this->SetFillColor(205,92,92);
		$this->rect($this->getX(),$this->getY(),190,.1,'F');		
		$this->Cell(20,4,'Pagina 1 de 1',0,0);
		$this->setx(117);
		 $this->Cell(40,3,'www.facturacionagil.com',0,1);
	}
	
	function imprimeAdicional(){
		$this->formato=false;
		$y=$this->getY();
		//---------------------------------------------------------------------------------------
		$this->setFont('Arial','',5); $this->cell(20,3,'Versión del CFD:',0,0);
		$this->setFont('Arial','',7); $this->cell(10,3,$this->facturaObj['version'],0,1);
		//---------------------------------------------------------------------------------------
		$this->setFont('Arial','',5); $this->cell(20,3,'N0. Certificado:',0,0);
		$this->setFont('Arial','',7); $this->cell(10,3,$this->facturaObj['noCertificado'],0,1);
		//---------------------------------------------------------------------------------------
		$this->setFont('Arial','',5); $this->cell(20,3,'Año de aprobación:',0,0);
		$this->setFont('Arial','',7); $this->cell(10,3,$this->facturaObj['anoAprobacion'],0,1);
		//---------------------------------------------------------------------------------------
		$this->setFont('Arial','',5); $this->cell(20,3,'Número de aprobación:',0,0);
		$this->setFont('Arial','',7); $this->cell(10,3,$this->facturaObj['noAprobacion'],0,1);
		//---------------------------------------------------------------------------------------
		$this->setY($y);
		$x2=60;
		$this->setX($x2);		
		$this->setFont('Arial','',5); $this->cell(20,3,'Tipo de comprobante:',0,0);
		$this->setFont('Arial','',7); $this->cell(10,3,$this->facturaObj['tipoDeComprobante'],0,1);
		//---------------------------------------------------------------------------------------
		$this->setX($x2);
		$this->setFont('Arial','',5); $this->cell(20,3,'Lugar de expedicion:',0,0);
		$this->setFont('Arial','',7); $this->cell(10,3,utf8_decode($this->facturaObj['LugarExpedicion']),0,1);
		//---------------------------------------------------------------------------------------
		$this->setX($x2);
		$this->setFont('Arial','',5); $this->cell(20,3,'Metodo de Pago:',0,0);
		$this->setFont('Arial','',7); $this->cell(10,3,$this->facturaObj['metodoDePago'],0,1);		
		//---------------------------------------------------------------------------------------
		$this->setX($x2);
		$this->setFont('Arial','',5); $this->cell(20,3,'Metodo de Pago:',0,0);
		$this->setFont('Arial','',7); $this->cell(10,3,$this->facturaObj['metodoDePago'],0,1);
		//---------------------------------------------------------------------------------------
		
		
		
	}
	function imprimeLogo(){		
		$this->SetFont('Arial','B',25);		
		//$this->Cell(40,0,'tU LOGO',0,1);
		$this->Image('bravo.png',12,11,15);
	}
	function imprimeEmisor(){
		$emisor=$this->facturaObj->Emisor;	
		$y1=$this->gety(); $this->setY($y1+2.5);
		$this->SetFont('Arial','B',8);		
		$this->Cell(40,3,'Datos del emisor',0,1);
		$altura=2;$this->formato=true;
		
		$this->SetFont('Courier','',5);						
		$this->Cell(40,$altura,$emisor['nombre'],0,1);
		$this->Cell(18,$altura,$emisor['rfc'],0,1);
		//--------- DOMICILIO --------- //
		$domicilio=$emisor->DomicilioFiscal;
		$dom=$domicilio['calle']. ' '.$domicilio['noExterior'];
		$dom.=!empty($domicilio['noInterior'])? ' INT '.$domicilio['noInterior'] : '';
		$dom.=' '.$domicilio['colonia'];		
		$this->Cell(40,$altura,$dom,0,.1);
		//--------- 
		$loc=$domicilio['localidad'].' '.$domicilio['municipio'].', '.$domicilio['estado'].', '.$domicilio['pais'].', '.$domicilio['codigoPostal'];
		 $this->Cell(40,$altura,$loc,0,1);		
	}
	
	function imprimeReceptor(){
		$Receptor=$this->facturaObj->Receptor;			
		$x1=110;
		$x=$x1+2;
		$y1=$this->gety();
		
		$this->setY($y1+2.5);
		$alto=3;		
		
		$this->SetFont('Arial','B',8);	 $this->formato=false;
		$this->setX($x); $this->Cell(40,$alto,'Datos del receptor',0,1);				
		$this->formato=true;
		$this->SetFont('Courier','',6);		
		$this->setX($x); $this->Cell(40,$alto,$Receptor['nombre'],0,1);
		$this->setX($x); $this->Cell(40,$alto,$Receptor['rfc'],0,1);
		//--------- DOMICILIO --------- //
		$domicilio=$Receptor->Domicilio;			
		$dom=$domicilio['calle'].' '.$domicilio['noExterior'];!
		$dom.=( isset($domicilio['noInterior']) )? ' INT '.$domicilio['noInterior'] : '';
		$dom.=' '.$domicilio['colonia'];
		$dom=trim($dom);
		if( !empty($dom) ){ 
			$this->setX($x); $this->Cell(40,$alto,$dom,0,1);
		}
		$loc=$domicilio['localidad'];
		if ( !empty($domicilio['municipio']) ){		
			$loc.=( empty($domicilio['localidad']) )? $domicilio['municipio'] : ', '.$domicilio['municipio'];
		}
		$loc.=', '.$domicilio['estado'].', '.$domicilio['pais'].'. '.$domicilio['codigoPostal']; 
		$this->setX($x); $this->Cell(40,$alto,$loc,0,1);	
		//--------------------BARRA IZQUIERDA-------------------------------//
		$y2=$this->getY();				
		$this->SetFillColor(139,0,0);
		$this->rect($x1+.5,$y1,1,$y2-$y1+2.5,'F');
		$this->SetFillColor(205,92,92);
		$this->rect($x1+1.5,$y1,.2,$y2-$y1+2.5,'F');
		//--------------------BARRA DERECHA-------------------------------//
		
		
		//$this->Cell($ancho,5,$this->facturaObj[''],1,1,'R');	
		
		$fecha=$this->facturaObj['fecha'];
		$ancho=25;		
		$this->setFont('Arial','B',6);
		$this->setY($y2+3);		
		$this->setX($x-$ancho-3);
		$this->setFont('Arial','B',15);
		$serfol=$this->facturaObj['serie'].' '.$this->facturaObj['folio'];
		$this->Cell($ancho,5,$serfol,0,1,'R');	
		$this->setY($y2);
		//--------------------BARRA DERECHA-------------------------------//		
		$x2=$x1+87;
		$y2=$this->getY();		
		$this->SetFillColor(205,92,92);
		$this->rect($x2+.5,$y1,.5,$y2-$y1+2.5,'F');
		$this->SetFillColor(139,0,0);
		$this->rect($x2+1,$y1,.8,$y2-$y1+2.5,'F');	
		//-----------------------------------------------------------------
		$fecha=$this->facturaObj['fecha'];
		$ancho=25;
		$x2=$x2-$ancho;
		$this->setFont('Arial','B',6);
		$this->setX($x); $this->setY($y1);
		//$this->Cell($ancho,3,$fecha,1,1);	
		$this->setX($x2);
		$this->Cell($ancho,3,$fecha,0,1);	
		$this->setY($y2);
	}
	
	
	function imprimeDatosDeLaFactura(){
		$factura=$this->facturaObj;			
		$y=$this->getY(); $this->setY($y-1);
		$x=125;
		$this->SetFont('Courier','',7);		
		$this->formato=false;
		$this->setX($x); $this->Cell(30,3,'No Factura',0,0,'C');		
		$serfol=$factura['serie'].' '.$factura['folio'];
		$this->Cell(30,3,$serfol,0,1,'C');			
		$y=$this->getY(); $this->setY($y+0.5);
		$this->setX($x); $this->Cell(30,3,'Fecha de Factura',0,0,'C');		
		$fecha=$factura['fecha'];
		$this->Cell(30,3,$fecha,0,1,'C');		 
		$this->SetLineWidth(.3);
		$this->SetDrawColor(255,182,193);
		
		$this->line($x,$y,$x+60,$y);
	}
	
	function imprimeEncabezados(){
		$x1=$this->getx();
		$y1=$this->gety();
		$this->SetFillColor(139,0,0);
		//$this->rect($x1,$y1,190,4,'F');
		$this->setY($y1);
		$this->SetTextColor(255,255,255);
		$this->SetFont('Courier','B',8);		
		$this->SetDrawColor(255,255,255);
		$this->Cell(20,4,'CODIGO',1,0,'L',true);
		$this->Cell(69,4,'DESCRIPCION',1,0,'L',true);		
		$this->Cell(20,4,'CANTIDAD',1,0,'R',true);
		$this->Cell(15,4,'UM',1,0,'L',true);
		$this->Cell(30,4,'P. UNITARIO',1,0,'R',true);
		$this->Cell(35,4,'IMPORTE',1,1,'R',true);
	}
	
	function imprimeConceptos(){
		
		
		$this->SetTextColor(0,0,0);
		$this->SetFillColor(255,255,255);
		$this->SetFont('Courier','',7);
		$conceptos=$this->facturaObj->Conceptos->Concepto;
		$border=0;
		foreach ($conceptos as $concepto){
			//echo "<pre>"; print_r($concepto); echo "</pre>";exit;	
			$this->Cell(20,4,$concepto[''],				$border,0,'L',true);
			$this->Cell(69,4,$concepto['descripcion'],	$border,0,'L',true);		
			$this->Cell(20,4,$concepto['cantidad'],		$border,0,'R',true);
			$this->Cell(15,4,$concepto['unidad'],		$border,0,'L',true);
			$this->Cell(30,4,$concepto['valorUnitario'],$border,0,'R',true);
			$this->Cell(35,4,$concepto['importe'],		$border,1,'R',true);
		}
	}
	
	function imprimeLeyendas(){
		$this->Cell(40,10,'LEYENDAS',0,1);		
	}
	
	function imprimeTotales(){
		$factura=$this->facturaObj;
		$x=150;
		$y1=$this->getY();
		$this->addY(12);
		$this->formato=false;
		$border=0;
		$this->rect($x,$y1,20,26.5,'F');
		$this->setTextColor(255,255,255);	$this->setX($x);$this->Cell(20,5,'Subtotal',$border,0);	
		$this->setTextColor(0,0,0); $this->Cell(30,4,$factura['subTotal'],$border,1,'R');
		$this->setTextColor(255,255,255);	$this->setX($x);$this->Cell(20,5,'Impuestos',$border,0);	
		$this->setTextColor(0,0,0); $this->Cell(30,4,'0.000000',0,1,'R');
		$this->SetFont('Courier','B',9);	
		$this->setTextColor(255,255,255);	$this->setX($x);$this->Cell(20,5,'Total',$border,0);
		$this->setTextColor(0,0,0); $this->Cell(30,5,$factura['total'],$border,1,'R');
		$y2=$this->getY();
		
		//$this->liberarX();
	}
	//======================================================================================
	function fijarX($x){
		$this->x1Fija=$x;
		$this->fijarX=true;		
	}
	function liberarX(){
		$this->fijarX=false;
	}
	function addX($cantidad){
		$x=$this->getX()+$cantidad;
		$this->setX($x);		
	}
	function addY($cantidad){
		$y=$this->getY()+$cantidad;
		$this->setY($y);		
	}
	function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link=''){
		if ($this->fijarX){
			$this->setX($this->x1Fija);
		}
		//
		if ($this->formato){
			$txt=utf8_decode($txt);
			$txt=strtoupper($txt);
		}
		
		return parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
	}
}
?>
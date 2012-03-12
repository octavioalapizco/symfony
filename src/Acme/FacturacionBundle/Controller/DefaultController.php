<?php

namespace Acme\FacturacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\FacturacionBundle as FB;
class DefaultController extends Controller
{
    
    public function indexAction()
    {
		//============================================================================
		$xmlstr= file_get_contents('../src/Acme/FacturacionBundle/example.xml') ;		
		$facturaObj = new \SimpleXMLElement($xmlstr);		
		//echo "<pre>";print_r($facturaObj);echo "</pre>";exit;
		//============================================================================
		$pdf = new FB\FacturaPDF('P','mm','letter');
		$pdfName='factura.pdf';				
		$pdf->generarPdf($facturaObj,$pdfName);
		echo '<html><body style="margin: 0; padding: 0;"><object data="'.$pdfName.'" type="application/pdf" width="100%"  height="100%">
			</object></body></html>';
		exit;
        //return $this->render('AcmeFacturacionBundle:Default:index.html.twig', array('name' => $name));
    }
}

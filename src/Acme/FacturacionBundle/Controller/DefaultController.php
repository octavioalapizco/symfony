<?php

namespace Acme\FacturacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\FacturacionBundle\Entity\Factura;
use Symfony\Component\HttpFoundation\Request;
//use Acme\FacturacionBundle as FB;
class DefaultController extends Controller
{
	
	function libxml_display_error($error) { 
		
		switch ($error->level) { 
			case LIBXML_ERR_WARNING: 
				$tipo='WARNING';
			break; 
			case LIBXML_ERR_ERROR: 
				$tipo='ERROR';
			break; 
			case LIBXML_ERR_FATAL: 
				$tipo='FATAL';
			break; 
		} 
		
		$error_Atribs=array(
			'tipo'	 =>$tipo,
			'code'	 =>$error->code,
			'message'=>$error->message,
			'line'	 =>$error->line,
			'column'	 =>$error->column
		);
				
		if ($error->file) { 
			$error_Atribs['file']=$error->file;		
		} 
		
		return $error_Atribs; 
	} 
	
	function validarCertificado(){
		/*
		
		1.-Obtiene el certificado 
			a) ubicado dentro del xml.
			b) desde un archivo. 
		2.-Con la cadena original y el certificado se genera el sello
		3.-Se compara el sello del xml y el generado por el sistema, 
			a).-si son iguales entonces el xml es válido, 
			b).-si son diferentes entonces el sello es inválido. 
					
		*/
		return true;
	}
	
	function libxml_display_errors() { 
		$errors = libxml_get_errors(); 
		$errores=array();
		foreach ($errors as $error) { 
			$errores[]=$this->libxml_display_error($error); 
		} 
		libxml_clear_errors(); 
		return $errores;
	}
	
	public function validarEstructura() {
		$xml_realpath=$_FILES['comprobante']['tmp_name'];
		libxml_use_internal_errors(true);
		$domXml=new \DOMDocument();
		$domXml->load($xml_realpath);
		$dtd_realpath='../src/Acme/FacturacionBundle/Resources/dtds/cfdv2.xsd';
		$valido=@$domXml->schemaValidate($dtd_realpath);
		if ($valido){
			return true;
		}else{
			return false;
		}				
	}
	
	public function validarAction(Request $request){
		//==================================================
		//
		//==================================================
		if ( empty($_FILES['comprobante']['name']) ) {			
			return $this->render('AcmeFacturacionBundle:bussiness_template:validar.html.twig' );
		}
		//==================================================	
		//
		//==================================================	
		$respuesta=$this->validarEstructura();
		//$selloValido= $this->validarSello();
		//$vigente=$this->validarVigencia();
		//$foliosSat=$this->verificarFolios();
		
		if ($respuesta===false){
			$errores=$this->libxml_display_errors();			
			
			return $this->render('AcmeFacturacionBundle:bussiness_template:validar.html.twig', 
				array(
					'errores' => $errores,			
					'error' => "El comprobante contiene errores en su estructura!"	
				)
			);
		}else{			
			$xsl='cfd/cadenaoriginal_2_0.xslt.xml';
			$cadena="";
			$cadena=$this->transform($_FILES['comprobante']['tmp_name'],$xsl);
			
			return $this->render('AcmeFacturacionBundle:bussiness_template:validar.html.twig',array(					
					'notice' => "El comprobante es valido!",
					'cadena' => $cadena,	
					'valido' => true
				));
		}		
	}
	
	function transform($xmlPath, $xslPath) {
		
		//Abrir xslt
		$xmlstr= file_get_contents($xslPath) ;		
		$xsl = new \SimpleXMLElement($xmlstr);
		
		//Abrir xml
		$xmlFile=file_get_contents($xmlPath) ;		
		$xml = new \SimpleXMLElement($xmlFile);
		
		//transformar
		$xslt = new \XSLTProcessor();
		$xslt->importStylesheet($xsl);
		//$transformacion="TEST";
		$transformacion=$xslt->transformToXml($xml);
		
		return $transformacion;
	}
	public function verpdfAction($factura_id)
    {
		//==============        Trae los datos de la bdd           =======================
		//factura_id
		$facturas = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT f FROM AcmeFacturacionBundle:Factura f WHERE f.id=:factura_id')
			->setParameter('factura_id', $factura_id)
            ->getResult();	
		
		if (empty($facturas)){
			echo "El archivo no existe, redirigir a la pagina de error"; exit;
		}
		
		$factura=$facturas[0];
		//print_r($factura);
		$tipo_cd=$factura->getTipoComprobante();
		
		//============================================================================		
		$fecha=$factura->getFechaEmision();
		$año=$fecha->format('y');
		$mes=$fecha->format('m');
		$dia=$fecha->format('d');
		$ruta="../web/comprobantes/$tipo_cd/".$factura->getRfcE().'/'.$año.'/'.$mes.'/';
		//rfc_emisor_serie_folio_aammdd.xml
		$filename=$factura->getRfcE().'_'.$factura->getSerie().'_'.$factura->getFolio()."_$año$mes$dia";
		//============================================================================
		$xmlstr= file_get_contents($ruta.$filename.'.xml') ;		
		$facturaObj = new \SimpleXMLElement($xmlstr);		
		//echo "<pre>";print_r($facturaObj);echo "</pre>";exit;
		//============================================================================
		$clasName='Acme\FacturacionBundle\Resources\views_pdf\FacturaPdf';
		
		$pdf = new $clasName('P','mm','letter');
		$pdfName='tmp/'.$filename.'.pdf';	
		$pdf->generarPdf($facturaObj,$pdfName);
		echo '<html><body style="margin: 0; padding: 0;"><object data="/'.$pdfName.'" type="application/pdf" width="100%"  height="100%">
			</object></body></html>';
		exit;
        //return $this->render('AcmeFacturacionBundle:Default:pdf.html.twig', array('ruta' => $ruta));
    }
	
	public function indexAction()
    {
		
        return $this->render('AcmeFacturacionBundle:Bussiness_template:home.html.twig');
    }
	
    /*public function indexAction()
    {
		//============================================================================
		$xmlstr= file_get_contents('../src/Acme/FacturacionBundle/example.xml') ;		
		$facturaObj = new \SimpleXMLElement($xmlstr);		
		//echo "<pre>";print_r($facturaObj);echo "</pre>";exit;
		//============================================================================
		$clasName='Acme\FacturacionBundle\FacturaPdfOtra';
		
		$pdf = new $clasName('P','mm','letter');
		$pdfName='factura.pdf';				
		$pdf->generarPdf($facturaObj,$pdfName);
		echo '<html><body style="margin: 0; padding: 0;"><object data="'.$pdfName.'" type="application/pdf" width="100%"  height="100%">
			</object></body></html>';
		exit;
        //return $this->render('AcmeFacturacionBundle:Default:index.html.twig', array('name' => $name));
    }*/
	
	public function templateAction(){
		return $this->render('AcmeFacturacionBundle:templates:template.html.twig');
	}
	public function getTemplatesJsonAction(){
		$arrImages=array(
			array(
				"idTema"=>1,
				"name"=>"zack_dress.jpg",
				"size"=>2645,
				"lastmod"=>1307598194000,
				"url"=>"/bundles/acmefacturacion/templates/images/zack_dress.jpg"
			),
			array(	
				"idTema"=>2,
				"name"=>"zack_dress.jpg",
				"size"=>2645,
				"lastmod"=>1307598194000,
				"url"=>"/bundles/acmefacturacion/templates/images/zack_dress.jpg"
			),
			array(
				"idTema"=>3,
				"name"=>"zack_dress.jpg",
				"size"=>2645,
				"lastmod"=>1307598194000,
				"url"=>"/bundles/acmefacturacion/templates/images/zack_dress.jpg"
			),array(
				"idTema"=>4,
				"name"=>"zack_dress.jpg",
				"size"=>2645,
				"lastmod"=>1307598194000,
				"url"=>"/bundles/acmefacturacion/templates/images/zack_dress.jpg"
			)
			
		);
		echo json_encode(array('images'=>$arrImages));
		//'{"images":[,{"name":"dance_fever.jpg","size":2067,"lastmod":1307598194000,"url":"images\/thumbs\/dance_fever.jpg"},{"name":"zack_hat.jpg","size":2323,"lastmod":1307598194000,"url":"images\/thumbs\/zack_hat.jpg"},{"name":"sara_pink.jpg","size":2154,"lastmod":1307598194000,"url":"images\/thumbs\/sara_pink.jpg"},{"name":"gangster_zack.jpg","size":2115,"lastmod":1307598194000,"url":"images\/thumbs\/gangster_zack.jpg"},{"name":"zacks_grill.jpg","size":2825,"lastmod":1307598194000,"url":"images\/thumbs\/zacks_grill.jpg"},{"name":"kids_hug.jpg","size":2477,"lastmod":1307598194000,"url":"images\/thumbs\/kids_hug.jpg"},{"name":"zack.jpg","size":2901,"lastmod":1307598194000,"url":"images\/thumbs\/zack.jpg"},{"name":"sara_smile.jpg","size":2410,"lastmod":1307598194000,"url":"images\/thumbs\/sara_smile.jpg"},{"name":"up_to_something.jpg","size":2120,"lastmod":1307598194000,"url":"images\/thumbs\/up_to_something.jpg"},{"name":"kids_hug2.jpg","size":2476,"lastmod":1307598194000,"url":"images\/thumbs\/kids_hug2.jpg"},{"name":"zack_sink.jpg","size":2303,"lastmod":1307598194000,"url":"images\/thumbs\/zack_sink.jpg"},{"name":"sara_pumpkin.jpg","size":2588,"lastmod":1307598194000,"url":"images\/thumbs\/sara_pumpkin.jpg"}]}';
		exit;
	}
	
}

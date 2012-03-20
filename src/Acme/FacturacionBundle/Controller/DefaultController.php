<?php

namespace Acme\FacturacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\FacturacionBundle\Entity\Factura;

//use Acme\FacturacionBundle as FB;
class DefaultController extends Controller
{
	public function importarAction(){
		
		 if (!empty($_FILES['comprobante']['name'])) {
			$respuesta= $this->moveUploadedCert();
			if ($respuesta===false){
				echo "<br/>Importacion ha fallado<br/>";
			}else{				
				echo "<br/>¡Archivo importado ".$respuesta."!<br/>";
				return $this->render('AcmeFacturacionBundle:Default:importar.html.twig');
			}
			exit;

		}else{			
			return $this->render('AcmeFacturacionBundle:Default:importar.html.twig');
		}
		
	}
	
	private function moveUploadedCert($ruta_temp="../tmp/importaciones/"){
      
		//============================================================================
		$CertfileInfo = $_FILES['comprobante'];
		$xmlstr= file_get_contents($CertfileInfo['tmp_name']) ;		
		$facturaObj = new \SimpleXMLElement($xmlstr);		
		//echo "<pre>";print_r($facturaObj);echo "</pre>";exit;
		//================ Guardar en BDD  ===========================================
		$facturaE=new Factura();
		$facturaE->setRfcE($facturaObj->Emisor['rfc']);
		$facturaE->setRfcR($facturaObj->Receptor['rfc']);
		$fecha=\DateTime::createFromFormat ( 'Y-m-d H:i:s',str_replace('T',' ',$facturaObj['fecha']) );
		
		$facturaE->setFechaEmision( $fecha );
		$facturaE->setSerie($facturaObj['serie']);
		$facturaE->setFolio($facturaObj['folio']);
		$facturaE->setTotalAntesDimpuestos($facturaObj['subTotal']);
		$facturaE->setTotal($facturaObj['total']);
		switch($facturaObj['version']){
			case "2.2":
			case "2.0":
				$tipo_cd="CFD";
			break;
			case "3.2":
			case "3.0":
				$tipo_cd="CFDI";
			break;		
		}
		$facturaE->setTipoComprobante($tipo_cd);
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($facturaE);
		$em->flush();				
		//============================================================================		
		$ruta="comprobantes/$tipo_cd/".$facturaObj->Emisor['rfc'].'/'.$fecha->format('y').'/'.$fecha->format('m').'/';
		
		@mkdir ( $ruta , $mode = 0777 , $recursive = true );
		//==============================================
		$CertfileInfo = $_FILES['comprobante'];
		$tempPathFileCer = $ruta . $CertfileInfo['name'];
		$cerTempName = $CertfileInfo['tmp_name'];
		
		
		if (!move_uploaded_file($cerTempName, $tempPathFileCer)) {                
			 throw new \Exception('Error al subir el certificado:'.$CertfileInfo['name']);
		}
		return  $CertfileInfo['name'];        
    }
	
	private function leerXml(){
	
	}
	
	public function verpdfAction($factura_id)
    {
		//====================Trae los datos de la bdd ===============================
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
		$filename=$factura->getRfcE().'_'.$factura->getSerie().'_'.$factura->getFolio()."_$año$mes$dia.xml";
		//============================================================================
		$xmlstr= file_get_contents($ruta.$filename) ;		
		$facturaObj = new \SimpleXMLElement($xmlstr);		
		//echo "<pre>";print_r($facturaObj);echo "</pre>";exit;
		//============================================================================
		$clasName='Acme\FacturacionBundle\FacturaPdf';
		
		$pdf = new $clasName('P','mm','letter');
		$pdfName=$filename;	
		$pdf->generarPdf($facturaObj,$pdfName);
		echo '<html><body style="margin: 0; padding: 0;"><object data="../../../'.$pdfName.'" type="application/pdf" width="100%"  height="100%">
			</object></body></html>';
		exit;
        //return $this->render('AcmeFacturacionBundle:Default:index.html.twig', array('name' => $name));
    }
	
    public function indexAction()
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
    }
	
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

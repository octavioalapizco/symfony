<?php
namespace Acme\FacturacionBundle\Controller;


use Acme\FacturacionBundle\Entity\Factura;
use Sonata\AdminBundle\Controller\CRUDController as Controller;

class FacturaAdminController extends Controller
{
	/**
     * return the Response object associated to the edit action
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @param  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
	
	function libxml_display_error($error) { 
		$return = "<br/>\n"; 
		switch ($error->level) { 
			case LIBXML_ERR_WARNING: 
			$return .= "<b>Warning $error->code</b>: "; 
			break; 
			case LIBXML_ERR_ERROR: 
			$return .= "<b>Error $error->code</b>: "; 
			break; 
			case LIBXML_ERR_FATAL: 
			$return .= "<b>Fatal Error $error->code</b>: "; 
			break; 
		} 
		$return .= trim($error->message); 
		if ($error->file) { 
			$return .= " in <b>$error->file</b>"; 
		} 
		$return .= " on line <b>$error->line</b>\n"; 

		return $return; 
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
	
    public function importarAction($id = null)
    {
		 if (!empty($_FILES['comprobante']['name'])) {
			$respuesta= $this->moveUploadedCert();

			if ($respuesta===false){
				//echo "<br/>Importacion ha fallado<br/>";
				//$this->get('session')->setFlash('sonata_flash_error', 'flash_edit_error');
				return $this->render('AcmeFacturacionBundle:Default:importar_errores.html.twig',
					array( 
						'errores'=>$this->libxml_display_errors() ,
						'action' => 'importar'
					)
				);
			}else{				
				 $this->get('session')->setFlash('sonata_flash_success', 'flash_edit_success');		
					
				$object=array();
				$this->admin->setSubject($object);
				return $this->render('AcmeFacturacionBundle:Default:importar.html.twig');
			}
			

		}else{			
			 // set the theme for the current Admin Form
			$form = $this->admin->getForm();
			$view = $form->createView();	
			
			$this->get('twig')->getExtension('form')->setTheme($view, $this->admin->getFormTheme());
			return $this->render('AcmeFacturacionBundle:Default:importar.html.twig',array(
				'action' => 'importar',
				'form'   => $form,
				'object' => array(),
			));
		}
	
    }
	
	public function validate($xml_realpath) {
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
	
	private function moveUploadedCert($ruta_temp="../tmp/importaciones/"){
      
		//============================================================================
		$CertfileInfo = $_FILES['comprobante'];
		$xmlstr= file_get_contents($CertfileInfo['tmp_name']) ;		
		$facturaObj = new \SimpleXMLElement($xmlstr);		
		//echo "<pre>";print_r($facturaObj);echo "</pre>";exit;
		//================ VALIDAR CONTRA EL DTD  ===========================================
				
		//$resp=$this->validate($_FILES['comprobante']['tmp_name']);
		$resp=true;
		
		if ($resp===false) return false;
		
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
			  throw new NotFoundHttpException(sprintf('No pude morver el archivo'));
		}

		return  array(
			'fullpath'	=>$ruta . $CertfileInfo['name'],
			'name'		=>$CertfileInfo['name']
		);
    }
   
}
?>

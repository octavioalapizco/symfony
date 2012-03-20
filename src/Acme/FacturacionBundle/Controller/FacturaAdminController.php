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
    public function importarAction($id = null)
    {
		 if (!empty($_FILES['comprobante']['name'])) {
			$respuesta= $this->moveUploadedCert();
			if ($respuesta===false){
				//echo "<br/>Importacion ha fallado<br/>";
				$this->get('session')->setFlash('sonata_flash_error', 'flash_edit_error');
			}else{				
				 $this->get('session')->setFlash('sonata_flash_success', 'flash_edit_success');				
				$object=array();
				$this->admin->setSubject($object);
				return $this->render('AcmeFacturacionBundle:Default:importar.html.twig',array(
            'action' => 'edit',
            'form'   => array(),
            'object' => $object,
        ));
			}
			exit;

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
	
	
	//===========================================================================
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            throw new AccessDeniedException();
        }

        $this->admin->setSubject($object);

        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->get('request')->getMethod() == 'POST') {
            $form->bindRequest($this->get('request'));

            if ($form->isValid()) {
                $this->admin->update($object);
                $this->get('session')->setFlash('sonata_flash_success', 'flash_edit_success');

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                        'result'    => 'ok',
                        'objectId'  => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                // redirect to edit mode
                return $this->redirectTo($object);
            }

            $this->get('session')->setFlash('sonata_flash_error', 'flash_edit_error');
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getEditTemplate(), array(
            'action' => 'edit',
            'form'   => $view,
            'object' => $object,
        ));
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
   
}
?>

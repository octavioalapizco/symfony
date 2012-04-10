<?php
namespace Acme\FacturacionBundle\Clases;

class Validador{
	function validarXML($xml_path,$validationParams){
		$validationResults=array();
		
		$valResult=$this->validarEstructura($xml_path);
		$validationResults['xml']=$valResult();
		
		return array(
			'isValid'=>false,
			'validationResults'=>$validationResults
		);
	}
	
	public function validarEstructura($xml_realpath) {		
		libxml_use_internal_errors(true);
		$domXml=new \DOMDocument();
		$domXml->load($xml_realpath);
		// obtiene la ruta del esquema a partir de la version del cfd 
		$shemaPath=$this->getShemaPath($domXml);		
		$valido=@$domXml->schemaValidate($shemaPath);
		
		$respuesta=array('success'=>$valido);
		if (!$valido){
			$respuesta['errores']=$this->getErroresDeEstructura();
		}
		return $respuesta;
	}
	
	private function getShemaPath($domXml){
		return '../src/Acme/FacturacionBundle/Resources/dtds/cfdv2.xsd';
	}
	
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
	function libxml_display_errors() { 
		$errors = libxml_get_errors(); 
		$errores=array();
		foreach ($errors as $error) { 
			$errores[]=$this->libxml_display_error($error); 
		} 
		libxml_clear_errors(); 
		return $errores;
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
	function validarArchivo(){
		$esquemaValido=$this->validarEsquema();
		
		$lista_de_errores_del_esquema=array();
		if (!$esquemaValido){
			$lista_de_errores_del_esquema=$this->getListaDeErroresDelEsquema();
		}
		
		$selloValido=$this->validarSelloDigital();
		$cadena=$this->getCadenaOriginal();
		
	}
	
	
	private  function validarSello(){
		return false;
	}
	
	private function generaCadenaOriginal(){
		$this->cadenaOriginal='';
		
	}
	
	private function getCadenaOriginal(){
		if ( !isset($this->cadenaOriginal) ){
			$this->cadenaOriginal=$this->generaCadenaOriginal();
		}
		return $this->cadenaOriginal;
	}
	
	
}
?>
<?php
namespace Acme\FacturacionBundle\Clases;

class Validador{
	function validarXML($xml_path,$validationParams=array())
	{
		$validationResults=array();
		
		$valResult=$this->validarEstructura($xml_path);
		$validationResults['success']	=  ($valResult['success']===false)? false:true;
		$validationResults['validaciones']['xml']		=	$valResult;
		
		return $validationResults;
	}
	
	public function validarEstructura($xml_realpath) 
	{		
		libxml_use_internal_errors(true);
		$domXml=new \DOMDocument();
		$domXml->load($xml_realpath);
		// obtiene la ruta del esquema a partir de la version del cfd 
		
		$shemaPath=$this->getShemaPath($domXml);		
		$valido=@$domXml->schemaValidate($shemaPath);
		
		$respuesta=array('success'=>$valido);
		if (!$valido)
		{
			$respuesta['errores']=$this->getErroresDeEstructura();
		}
		return $respuesta;
	}
	
	private function getShemaPath($domXml){
		$root 	 = $domXml->getElementsByTagName('Comprobante')->item(0);
		$version = $root->getAttribute('version');
		switch($version){
			case '2.0'
				$ruta= '../src/Acme/FacturacionBundle/Resources/dtds/cfdv2.xsd';
			break;
			case '2.2'
				$ruta= '../src/Acme/FacturacionBundle/Resources/dtds/cfdv22.xsd';
			break;
			case '3.0'
				$ruta= '../src/Acme/FacturacionBundle/Resources/dtds/cfdv22.xsd';
			case '3.3'
				$ruta= '../src/Acme/FacturacionBundle/Resources/dtds/cfdv22.xsd';
			break;
		}
		/*foreach ($body  as $book) {
			echo $book->nodeValue, PHP_EOL;
		}*/
		echo $root->getAttribute('version'); exit;
		//echo "VERSION=".$body->version;
		return '../src/Acme/FacturacionBundle/Resources/dtds/cfdv2.xsd';
	}
	
	
	function getErroresDeEstructura() { 
		$errors = libxml_get_errors(); 
		$errores=array();
		foreach ($errors as $error) 
		{ 
			$errores[]=$this->libxml_display_error($error); 
		} 
		libxml_clear_errors(); 
		return $errores;
	}
	
	function libxml_display_error($error) { 
		
		switch ($error->level) 
		{ 
			case LIBXML_ERR_WARNING	: $tipo='WARNING'; break; 
			case LIBXML_ERR_ERROR	: $tipo='ERROR';   break; 
			case LIBXML_ERR_FATAL	: $tipo='FATAL';   break; 
		} 
		
		$error_Atribs=array
		(
			'tipo'	 =>$tipo,
			'code'	 =>$error->code,
			'message'=>$error->message,
			'line'	 =>$error->line,
			'column' =>$error->column
		);
				
		if ($error->file) 
		{ 
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
		if ( !isset($this->cadenaOriginal) )
		{
			$this->cadenaOriginal=$this->generaCadenaOriginal();
		}
		return $this->cadenaOriginal;
	}
	
	
}
?>
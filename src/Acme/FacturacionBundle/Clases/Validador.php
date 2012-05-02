<?php
namespace Acme\FacturacionBundle\Clases;

class Validador{
	function validarXML($xml_path,$validationParams=array()){
		$validationResults=array();
		
		$valResult=$this->validarEstructura( $xml_path );
		$validationResults['success']	=  ($valResult['success']===false)? false:true;
		$validationResults['validaciones']['xml']		=	$valResult;
		//-------------------------------------------------------------------------------------
		$validationResults['validaciones']['cadena_original']	= $this->generaCadenaOriginal( $xml_path, $this->dtdCadenaOriginal );
		$validationResults['validaciones']['certificado']       = $this->certificado; 
		$validationResults['validaciones']['sello']       = $this->generarSello($this->certificado,$validationResults['validaciones']['cadena_original']); 
		//-------------------------------------------------------------------------------------
		$validationResults['success']	=  false;
		return $validationResults;
	}
	function generarSello($certificado, $cadena_original){
		$certificado='-----BEGIN CERTIFICATE-----\n'.$certificado.'\n-----END CERTIFICATE-----';
		echo "<pre>".$certificado.'</pre>';
		$pkeyid = openssl_get_privatekey($certificado);
		print_r($pkeyid);
		// computar la firma
		openssl_sign($cadena_original, $signature, $pkeyid);

		// liberar la clave de la memoria
		openssl_free_key($pkeyid);
		return $signature;
	}
	public function validarEstructura($xml_realpath) {		
		libxml_use_internal_errors(true);
		$domXml=new \DOMDocument();
		$domXml->load($xml_realpath);
		// obtiene la ruta del esquema a partir de la version del cfd 
		
		$shemaPath=$this->getShemaPath($domXml);		
		$valido=@$domXml->schemaValidate($shemaPath);
		
		$respuesta=array('success'=>$valido);
		//-------------------------------------------------------------------		
		$respuesta['version']=$this->version;		
		//-------------------------------------------------------------------
		if (!$valido)
		{
			$respuesta['errores']=$this->getErroresDeEstructura();
		}
		return $respuesta;
	}
	
	private function getVersion(){
		return $this->version;
	}
	
	private function getShemaPath($domXml){
		$root 	 = $domXml->getElementsByTagName('Comprobante')->item(0);
		$version = $root->getAttribute('version');
		$this->version=$version;
		//----------------------------
		//¿Que pasa si no incluyeron el certificado en el xml? Entonces deben incluir otro archivo con el certificado, la contraseña y lo que sea necesario para generar el certificado en base 64.
		$this->certificado=$root->getAttribute('certificado');
		
		switch($version){
			case '2.0':
				$ruta= '../src/Acme/FacturacionBundle/Resources/dtds/cfdv2.xsd';
				$this->dtdCadenaOriginal='../src/Acme/FacturacionBundle/Resources/dtds/cadenaoriginal_2_0.xslt.xml';
			break;
			case '2.2':
				$ruta= '../src/Acme/FacturacionBundle/Resources/dtds/cfdv22.xsd';
				$this->dtdCadenaOriginal='../src/Acme/FacturacionBundle/Resources/dtds/cadenaoriginal_2_2.xslt.xml';
			break;
			case '3.0':
				$ruta= '../src/Acme/FacturacionBundle/Resources/dtds/cfdv3.xsd.xml';	
			break;
			case '3.3':
				$ruta= '../src/Acme/FacturacionBundle/Resources/dtds/cfdv32.xsd.xml';
			break;
		}		
		return $ruta;
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


	function generaCadenaOriginal($xmlPath, $xslPath) {
		
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
		$cadenaOriginal=$xslt->transformToXml($xml);
		if ($cadenaOriginal===false){
			// trigger_error('XSL transformation failed.', E_USER_ERROR);
			$cadenaOriginal='ERROR OBTENIENDO LA CADENA';
		}
		return $cadenaOriginal;
	}
	
	
}
?>
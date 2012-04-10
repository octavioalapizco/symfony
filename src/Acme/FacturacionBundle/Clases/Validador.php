<?php
class Validador{
	function validarXML($xml_path,$validationParams){
		$validationResults=array();
		$this->xmlObject=new
		$valResult=$this->validarEstructura($xml_path);
		
		
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
		if ($valido){
			return true;
		}else{
			return false;
		}				
	}
	
	private function get_Lista_De_Errores_De_Estructura(){
	}
	
	private function getShemaPath($domXml){
		return '../src/Acme/FacturacionBundle/Resources/dtds/cfdv2.xsd';
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
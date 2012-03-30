<?php
class ValidarFacturaXml{
	function validarArchivo(){
		$esquemaValido=$this->validarEsquema();
		
		$lista_de_errores_del_esquema=array();
		if (!$esquemaValido){
			$lista_de_errores_del_esquema=$this->getListaDeErroresDelEsquema();
		}
		
		$selloValido=$this->validarSelloDigital();
		$cadena=$this->getCadenaOriginal();
		
	}
	
	private function validarEsquema(){
		return false;
	}
	
	private  function validarSelloDigital(){
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
	
	private function getListaDeErroresDelEsquema(){
	}
}
?>
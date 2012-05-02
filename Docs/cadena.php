<?php	
	echo "genrar cadena original";
	$cadena=generaCadenaOriginal('xml/AAA010101AAA_A_102_120403.xml','xml/cadenaoriginal_2_0.xslt.xml');
	echo '<br>'.$cadena.'<br/><br/>';
	/*$cadena='||2.0|A|102|2012-04-03T18:43:00|1234|1234|ingreso|PAGO EN UNA SOLA EXHIBICIÓN|240.000000|240.000000|AAA010101AAA|C & A ASDF|DOMICILIO
CONOCIDO|1999|123456|CENTRO|DFAS|Mazatlán|Sinaloa|México|82000|BIAC810830TH2|BIAC SOCIAL|Culiacán|Sinaloa|México|01234|1.00|PZA.|ADAPTADOR P/TEL.
ASTRA 673LI|240.000000|240.000000||';*/
	echo '<br>'.$cadena.'<br/><br/>';
	$xmlstr=file_get_contents('xml/AAA010101AAA_A_102_120403.xml');
	//echo $xmlstr;
	$factura = new SimpleXMLElement($xmlstr);
	//echo print_r($factura);
	$version=$factura['version'];
	echo "Version:<br/>".$version."<br><br/>";
	$cert=$factura['certificado'];
	$sello=$factura['sello'];
	echo "Sello:<br/> $sello";
	//$domXml=new DOMDocument();
	//$domXml->load('xml/AAA010101AAA_A_102_120403.xml');
	//$root 	 = $domXml->getElementsByTagName('Comprobante')->item(0);
	//$version = $root->getAttribute('version');				
	//$cert = $root->getAttribute('certificado');	
	$certificado="-----BEGIN CERTIFICATE-----";
	$certificado.=chr(10).$cert;
	$certificado.=chr(10)."-----END CERTIFICATE-----";
	/*echo "<pre>";
	echo $certificado;
	echo "</pre>";*/	
	/*$certificado='-----BEGIN CERTIFICATE-----*/
	$certificado=<<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICXgIBAAKBgQDD0ltQNthUNUfzq0t1GpIyapjzOn1W5fGM5G/pQyMluCzP9YlV
AgBjGgzwYp9Z0J9gadg3y2ZrYDwvv8b72goyRnhnv3bkjVRKlus6LDc00K7Jl23U
YzNGlXn5+i0HxxuWonc2GYKFGsN4rFWKVy3Fnpv8Z2D7dNqsVyT5HapEqwIDAQAB
AoGAeYXvEx2mLMQQDgDsyBSgS9dpafCPXkE/IR+W79yxUDQ24yvOeUnPsbC1/OxH
VfapIa0t+JoqylIjp8JNG3jZv/kXhCIg/aI6rZcfRZdvAgAOMMdRmpY/UOiOMWre
xjWWJ9EQPz+zIZwh5MCos8yCPnJukMtGKKdlUiFYWopI+gECQQDuaQF/eGegQ1uX
Z3FzR563b67FUvmIlEcX2D2O4kjBpOVUZndHNntWhZsIEcK730MBy9AEBVyECewK
PJZyzZcBAkEA0kT1B0FnxoLLWQqC7oxDmonvC9J+tGokkmpQWzPHAbW6hMHUlOLo
LYzfu/XaHgDpuSz7qgG0pYjQuYIr05VnqwJBAMNKmMOGKbyJ8JkRT0mTPVwdzBgv
Y+CRNbs+kw5cJiUZohGE7egTpOy2/MubYNzsgcMS5Q6mJaazSfsIrmTULAECQQC/
wpOT4lo5995rfeKamuCsd07CgV18O7DOtpZCFp5POOS5Xev5PFZx9B+20yfwZPTC
I/v/tz6AGJ4CEGzXsVGxAkEAtonciHAJQfAd+R6JpyyAtYxH0U38Mn83q6nK7d7a
AhSMRTX70s61F2owSDkg/aWR3jmI5CbhUcYPdsbMpH830A==
-----END RSA PRIVATE KEY-----
EOD;
	echo "<pre>";echo $certificado;echo "</pre>";
	//$sello = $root->getAttribute('sello');		
	$pkey=openssl_pkey_get_public ( $certificado );	
	$ok= openssl_verify( $cadena, $sello, $pkey );
	//echo ($esvalido==true) ? 'VALIDO' : 'INVALIDO';
	if ($ok == 1) {
		echo "good";
	} elseif ($ok == 0) {
		echo "bad";
	} else {
		echo "ugly, error checking signature";
	}
	function generaCadenaOriginal($xmlPath, $xslPath) {
		$xmlstr= file_get_contents($xslPath);		

		$xsl = new \SimpleXMLElement($xmlstr);

		//Abrir xml
		$xmlFile=file_get_contents($xmlPath);		
		$xml = new \SimpleXMLElement($xmlFile);

		//transformar
		$xslt = new \XSLTProcessor();
		@$xslt->importStylesheet($xsl);
		//$transformacion="TEST";
		$cadenaOriginal=$xslt->transformToXml($xml);
		if ($cadenaOriginal===false){
			// trigger_error('XSL transformation failed.', E_USER_ERROR);
			$cadenaOriginal='ERROR OBTENIENDO LA CADENA';
		}
		
		
		return $cadenaOriginal;
	}
?>

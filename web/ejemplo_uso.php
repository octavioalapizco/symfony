<HTML><BODY><PRE>
<?PHP
/**************************************************************************\
* Ejemplo de funcionamiento de TimbreFiscal
*    Este ejemplo realiza de manera muy basica 5 funciones:
*    1) Crea un CFDi de factura de un par de conceptos
*    2) Lo firma
*    3) Valida contra esquema y verifica la firma
*    4) Timbra con TimbreFiscal, esto implica:
*        4.1) Ensobreta
*        4.2) Envía a TimbreFiscal
*        4.3) Recibe un timbre (o procesa un error)
*    5) Integra el timbre en el CFDi
*
* Lo normal y correcto sería pasar entre paso y paso un objeto DOM, sin
* embargo para efectos de modularidad, todo el proceso del CFDi se hace
* partiendo de un xml en modo texto, en la variable $cfdi
* 
* Este es un ejemplo didáctico. No implica responsabilidad alguna por
* parte de TimbreFiscal, no pretende ser codigo funcional, no contempla
* soporte de ningun tipo ni se recomienda su instalacion "tal cual"
\**************************************************************************/

##########################################################
# PASO1. Crea un CFDi de factura con un par de conceptos
#
# Regresa un texto en la variable $cfdi
##########################################################
echo "PASO 1.- Crea un CFDi de factura con un par de conceptos\n";
# Partimos de un CFDi a medias, conservando declaracion de esquemas
$cfdi = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:ecb="http://www.sat.gob.mx/ecb" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:implocal="http://www.sat.gob.mx/implocal" xmlns:bfa2="http://www.buzonfiscal.com/ns/addenda/bf/2" xmlns:terceros="http://www.sat.gob.mx/terceros" xmlns:detallista="http://www.sat.gob.mx/detallista" xmlns:psgecfd="http://www.sat.gob.mx/psgecfd" xmlns:ecc="http://www.sat.gob.mx/ecc" xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" tipoDeComprobante="ingreso" total="" subTotal="" certificado="" noCertificado="" sello="" formaDePago="Pago en una sola exhibición" fecha="" version="3.0" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv3.xsd http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/sitio_internet/TimbreFiscalDigital/TimbreFiscalDigital.xsd http://www.sat.gob.mx/detallista http://www.sat.gob.mx/sitio_internet/cfd/detallista/detallista.xsd http://www.sat.gob.mx/implocal http://www.sat.gob.mx/sitio_internet/cfd/implocal/implocal.xsd http://www.buzonfiscal.com/ns/addenda/bf/2 http://www.buzonfiscal.com/schema/xsd/Addenda_BF_v2.2.xsd ">
  <cfdi:Emisor nombre="Empresa Demo" rfc="AAA010101AAA">
    <cfdi:DomicilioFiscal codigoPostal="53400" pais="México" estado="Nuevo Leon" municipio="Monterrey" colonia="Obispado" noExterior="1640" calle="Padre Mier"/>
  </cfdi:Emisor>
  <cfdi:Receptor nombre="" rfc="">
    <cfdi:Domicilio codigoPostal="" pais="" estado="" municipio="" noExterior="" calle=""/>
  </cfdi:Receptor>
  <cfdi:Conceptos>
  </cfdi:Conceptos>
  <cfdi:Impuestos totalImpuestosTrasladados="">
    <cfdi:Traslados>
      <cfdi:Traslado importe="" tasa="16.00" impuesto="IVA"/>
    </cfdi:Traslados>
  </cfdi:Impuestos>
  <cfdi:Complemento> 
  </cfdi:Complemento>
</cfdi:Comprobante>
XML;

# El emisor no cambia. Si cambiara el codigo sería semejante al de receptor
$receptor = array ("nombre" => "Juan Perez Galvan",
		"rfc" => "GAPJ700202XX0",
		"Domicilio" => array (
			"codigoPostal" => "53499",
			"pais" => "México",
			"estado" => "Nuevo Leon",
			"municipio" => "Monterrey",
			"colonia" => "Obispado",
			"noExterior" => "1660",
			"calle" => "Venustiano Carroza"
			)
		);

# 10 posibles conceptos
$concepto[0] = array( "unidad" => "kilo", "valorUnitario" =>  "80.00", "descripcion" => "Arrachera marinada");
$concepto[1] = array( "unidad" => "kilo", "valorUnitario" => "100.00", "descripcion" => "Camaron cocido");
$concepto[2] = array( "unidad" => "lata", "valorUnitario" =>  "50.00", "descripcion" => "Anchoas");
$concepto[3] = array( "unidad" => "bolsa", "valorUnitario" =>  "30.00", "descripcion" => "Tamal de elote");
$concepto[4] = array( "unidad" => "kilo", "valorUnitario" =>  "200.00", "descripcion" => "Pavo doble pechuga");
$concepto[5] = array( "unidad" => "kilo", "valorUnitario" =>  "120.00", "descripcion" => "Pescado al ajo");
$concepto[6] = array( "unidad" => "lata", "valorUnitario" =>  "75.00", "descripcion" => "Camaron junior natural");
$concepto[7] = array( "unidad" => "kilo", "valorUnitario" =>  "180.00", "descripcion" => "Pechuga ahumada al mezquite");
$concepto[8] = array( "unidad" => "bolsa", "valorUnitario" =>  "94.00", "descripcion" => "Croquetas empanizadas");
$concepto[9] = array( "unidad" => "kilo", "valorUnitario" =>  "60.00", "descripcion" => "Salchicha coctelera");
#faltaria cantidad, importe y en su caso impuestos, para efectos de prueba se asume que solo hay iva fijo a 16%.

# Convierte a objeto DOM $xml
$xml = new DOMDocument();
$xml->loadXML($cfdi);

# Modifica codigos semifijos
$xmlreceptor = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Receptor')->item(0);
$xmlreceptor->setAttribute('nombre', $receptor['nombre']);
$xmlreceptor->setAttribute('rfc', $receptor['rfc']);
$xmlreceptordomicilio = $xmlreceptor->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Domicilio')->item(0);
foreach($receptor["Domicilio"] as $key => $value) {
	$xmlreceptordomicilio->setAttribute($key, $value);
}
unset($xmlreceptor);
unset($xmlreceptordomicilio);

# Agrega n conceptos, en este caso 5
$n=5;
$xmlconceptos = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Conceptos')->item(0);
for($i=0; $i<$n; $i++) {
	$xmlconcepto = $xml->createElementNS('http://www.sat.gob.mx/cfd/3', 'Concepto');
	$conc = $concepto[mt_rand(0,9)]; # Concepto aleatorio
	$cant = mt_rand(1, 10); # Cantidad aleatoria de 1 a 10
	$importe = $cant * intval($conc['valorUnitario']);
	foreach($conc as $key => $value) {
		$xmlconcepto->setAttribute($key, $value);
	}
	$xmlconcepto->setAttribute('cantidad', $cant);
	$xmlconcepto->setAttribute('importe', $importe);
	$xmlconceptos->appendChild($xmlconcepto);
	unset($xmlconcepto);
	unset($conc);
	unset($cant);
	unset($importe);
}
unset($xmlconceptos);

# Calcula totales
$c = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
$total = 0;
foreach ($c->getElementsByTagName('Conceptos')->item(0)->getElementsByTagName('Concepto') as $concepto) {
	$total += $concepto->getAttribute('importe');
}
$iva = $total * 0.16;
$c->setAttribute('subTotal', $total);
$c->setAttribute('total', $total + $iva);
$c->setAttribute('fecha', date('c')); # Fecha en formato ISO8601 (Solo funciona con PHP 5)
$c->getElementsByTagName('Impuestos')->item(0)->setAttribute('totalImpuestosTrasladados', $iva);
$c->getElementsByTagName('Impuestos')->item(0)->getElementsByTagName('Traslados')->item(0)->getElementsByTagName('Traslado')->item(0)->setAttribute('importe', $iva);
unset($c);
unset($total);
unset($iva);

# Reconvierte a texto
$cfdi = $xml->saveXML();
unset($xml);
echo htmlspecialchars($cfdi);


###############################################################
# PASO2. Firma el comprobante que esta en $cfdi en modo texto
#
# Regresa el comprobante firmado en la misma variable $cfdi
###############################################################
echo "\n\nPASO2. Firma el comprobante que esta en \$cfdi en modo texto\n";
# Convierte a modelo DOM
$xml = new DOMDocument();
$xml->loadXML($cfdi) or die("\n\n\nXML no valido");

# Extrae cadena original
$xslt = new XSLTProcessor();
$XSL = new DOMDocument();
$XSL->load( 'cadenaoriginal_3_0.xslt', LIBXML_NOCDATA);
error_reporting(0); # Se deshabilitan los errores pues el xssl de la cadena esta en version 2 y eso genera algunos warnings
$xslt->importStylesheet( $XSL );
error_reporting(E_ALL); # Se habilitan de nuevo los errores (se asume que originalmente estaban habilitados)
$c = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
$cadena = $xslt->transformToXML( $c );
unset($xslt, $XSL);
echo "Cadena original = [$cadena]\n";

# A continuacion se incluye el certificado de prueba del SAT que se usará para firma, con propositos didácticos.
$cert = <<<TEXT
-----BEGIN CERTIFICATE-----
MIIE/jCCA+agAwIBAgIUMzAwMDEwMDAwMDAxMDAwMDA4MDkwDQYJKoZIhvcNAQEF
BQAwggFvMRgwFgYDVQQDDA9BLkMuIGRlIHBydWViYXMxLzAtBgNVBAoMJlNlcnZp
Y2lvIGRlIEFkbWluaXN0cmFjacOzbiBUcmlidXRhcmlhMTgwNgYDVQQLDC9BZG1p
bmlzdHJhY2nDs24gZGUgU2VndXJpZGFkIGRlIGxhIEluZm9ybWFjacOzbjEpMCcG
CSqGSIb3DQEJARYaYXNpc25ldEBwcnVlYmFzLnNhdC5nb2IubXgxJjAkBgNVBAkM
HUF2LiBIaWRhbGdvIDc3LCBDb2wuIEd1ZXJyZXJvMQ4wDAYDVQQRDAUwNjMwMDEL
MAkGA1UEBhMCTVgxGTAXBgNVBAgMEERpc3RyaXRvIEZlZGVyYWwxEjAQBgNVBAcM
CUNveW9hY8OhbjEVMBMGA1UELRMMU0FUOTcwNzAxTk4zMTIwMAYJKoZIhvcNAQkC
DCNSZXNwb25zYWJsZTogSMOpY3RvciBPcm5lbGFzIEFyY2lnYTAeFw0xMDA3MzAx
NjU4NDhaFw0xMjA3MjkxNjU4NDhaMIGXMRIwEAYDVQQDDAlNYXRyaXogU0ExEjAQ
BgNVBCkMCU1hdHJpeiBTQTESMBAGA1UECgwJTWF0cml6IFNBMSUwIwYDVQQtExxB
QUEwMTAxMDFBQUEgLyBBQUFBMDEwMTAxQUFBMR4wHAYDVQQFExUgLyBBQUFBMDEw
MTAxSERGUlhYMDExEjAQBgNVBAsMCVVuaWRhZCAxMDCBnzANBgkqhkiG9w0BAQEF
AAOBjQAwgYkCgYEAsKL9mh8flpnQXVmtOvDnSYgtfRMTPe/4JQMivUYEr6sEAUIQ
u8tR0xlR0OcDP9LZBfTddUwK2zjiTCQiQhAkgsn8EQsZGI9cisqrePtRXfH/GwLl
7l2IHMsAdI4Xvy6GRbszobt2IRuIZLj0MGv5/NcSmQTWv1QkSXMKaSUQ3BsCAwEA
AaOB6jCB5zAMBgNVHRMBAf8EAjAAMAsGA1UdDwQEAwIGwDAdBgNVHQ4EFgQUTwXU
S0hPz51Nk4KyPhJLgP9qMYYwLgYDVR0fBCcwJTAjoCGgH4YdaHR0cDovL3BraS5z
YXQuZ29iLm14L3NhdC5jcmwwMwYIKwYBBQUHAQEEJzAlMCMGCCsGAQUFBzABhhdo
dHRwOi8vb2NzcC5zYXQuZ29iLm14LzAfBgNVHSMEGDAWgBTrWX0EIppTjZ5xGqBY
lin1OeCgxTAQBgNVHSAECTAHMAUGAyoDBDATBgNVHSUEDDAKBggrBgEFBQcDAjAN
BgkqhkiG9w0BAQUFAAOCAQEAtIP05qlz0J4dITRpQ0mEz47svkoRNHqTlQOXgXGe
EfpF9ZowHIjvOw6nL1srLJWHh+c/RhN03gJ1tevw9In5vxMPITlmTeUGrWNqVef5
U5hDkA/bg0clEEiVAuyO+r9cYq8l8EZ9Ip6fl9YMmGD80gC/nFDdbhQ04RaelyUh
9Gv6pRAOtDevhyjqNupuOoR/Zzt7qMIb5/F7xflPDV6YvO7CS/1E9KGnixIJmdH/
JqHm4FdIkeal1zJlN6MBYXgIewnuxkfObS8ZS7GhX9YYCctk+FnHvHDRgx3kmtZW
hh0AvEsaZMiZ3IoI1s8xLDPgmY8vJwlbe4IY+qFisczBKA==
-----END CERTIFICATE-----

-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQCwov2aHx+WmdBdWa068OdJiC19ExM97/glAyK9RgSvqwQBQhC7
y1HTGVHQ5wM/0tkF9N11TArbOOJMJCJCECSCyfwRCxkYj1yKyqt4+1Fd8f8bAuXu
XYgcywB0jhe/LoZFuzOhu3YhG4hkuPQwa/n81xKZBNa/VCRJcwppJRDcGwIDAQAB
AoGAANEQGRlRvRGC/BuBCIe6mgVuKGjhKuUkIY+tJnDfbqx8vUC/8Q5Ul4RDc5LN
2gqwhC2IpJUwa6kMqstz+Rg4AvzSBLdH2EpJ6cEoslUaraz9k2XzLcmgUd+bjNVA
KmwHN7+k7YdAVQfzMx/NOyn2XxhxWjUeo7IJ8uRhoZ+bSUECQQDgCPQlr63Mk4Ud
TCUmpb9IWMq/p6vbBSORspIF7Ro6upsTkRqrx/pcixKhpnjKDkzttKM6WThhXBz4
cXFPAqjhAkEAydbHT2S117xP91dO7gH74TMUrTYIYKAfThGGm5mZzhSD6B6UbZSQ
9o6T/agmJh18h9OxzSeBTlR7nnw86mi4ewJBAMbn7CwRf9MkHolWc52OhvfqrYff
i/tW4q+WxYKxcho2VzzWFcHyONw1NYOD07ZBYBejy1Agqqf2KlqCDcHCcMECQQCB
fS5fLBBReLmgyD2WCmXK45eHTFvxiair0CiYmOGIybaaa0v0RVT/KReeq4rV9yLW
jSTLpmWZmC+6zJ/UDx0TAkBBBG3TPmpp0RlcoufSGlm/L0CloBbRdVg+I8Xrdp+o
D3AuB7zN9iy6VK2rZZCFj/XbLsl+KM/DcTytFo0braAA
-----END RSA PRIVATE KEY-----
TEXT;


# Extrae el número de certificado
# Para su correcto funcionamiento esta seccion requiere el plugin o modulo GMPlib
$cert509 = openssl_x509_read($cert) or die("\nNo se puede leer el certificado\n");
$data = openssl_x509_parse($cert509);
# En $data hay mucha informacion relevante del certificado. Si se desea explorar se puede usar la funcion print_r. Las codificaciones son... interesantes, sobre todo ésta y las fechas
$serial1 = $data['serialNumber'];
$serial2 = gmp_strval($serial1, 16);
$serial3 = explode("\n", chunk_split($serial2, 2, "\n"));
$serial = "";
foreach ($serial3 as $serialt) {
	if (2 == strlen($serialt))
		$serial .= chr('0x' . $serialt);
}
$noCertificado = $serial;
unset($serial1, $serial2, $serial3, $serial, $serialt, $data, $cert509);
echo "Numero de certificado = [$noCertificado]\n";

# Extrae valores relevantes
# Extrae el certificado, sin enters para anexarlo al cfdi
preg_match('/-----BEGIN CERTIFICATE-----(.+)-----END CERTIFICATE-----/msi', $cert, $matches) or die("No certificado\n");
$algo = $matches[1];
$algo = preg_replace('/\n/', '', $algo);
$certificado = preg_replace('/\r/', '', $algo);
echo "Certificado = [$certificado]\n";

# Extrae la llave privada, en formato openssl
$key = openssl_pkey_get_private($cert) or die("No llave privada\n");

# Firma la cadena original con la llave privada y codifica en base64 el resultado
$crypttext = "";
openssl_sign($cadena, $crypttext, $key);
$sello = base64_encode($crypttext);
echo "sello = [$sello]\n";

# Incorpora los tres elementos al cfdi
$c->setAttribute('certificado', $certificado);
$c->setAttribute('sello', $sello);
$c->setAttribute('noCertificado', $noCertificado);

# regresa el resultado
$cfdi = $xml->saveXML();
unset($c, $xml, $cert, $certificado, $sello, $noCertificado, $cadena, $crypttext, $key);
echo htmlspecialchars($cfdi);


###############################################################
# PASO3. Verifica el CFDI en la variable $cfdi
#
# Se interrumpe si hay error
###############################################################
echo "\n\nPASO3. Verifica el CFDI en la variable \$cfdi\n";
# Valida UTF8
mb_check_encoding($cfdi, "UTF-8") or die("El string no esta en UTF8\n");

# Convierte a modelo DOM
$xml = new DOMDocument();
$xml->loadXML($cfdi) or die("\n\n\nXML no valido");

# Valida contra esquema
$xml->schemaValidate('cfdv3.xsd') or die("\n\n\nNo es un CFDi valido");

# Verifica la firma
$Comprobante = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
# Extrae cadena original
$xslt = new XSLTProcessor();
$XSL = new DOMDocument();
$XSL->load( 'cadenaoriginal_3_0.xslt', LIBXML_NOCDATA);
error_reporting(0);
$xslt->importStylesheet( $XSL );
error_reporting(E_ALL);
$cadena = $xslt->transformToXML( $Comprobante );
unset($xslt, $XSL);

# Extrae el certificado y lo pone en formato que las funciones puedan leer
$cert2 = $Comprobante->getAttribute("certificado");
$cert  = "-----BEGIN CERTIFICATE-----\n";
$cert .= chunk_split($cert2, 64, "\n");
$cert .= "-----END CERTIFICATE-----\n";
if (!($pkey = openssl_pkey_get_public($cert))) {
	echo "\n\n\nNo es posible extraer llave publica\n";
	die;
}
# Extrae sello
$crypttext = base64_decode($Comprobante->getAttribute("sello"));
if (openssl_verify($cadena, $crypttext, $pkey)) {
	echo  "El firmado es correcto\n";
} else {
	die("\nError en el firmado!!!\n");
}	
unset($xml, $Comprobante, $cert2, $cert, $pkey, $crypttext, $cadena);


###############################################################
# PASO4. Timbra el CFDI en la variable $cfdi con TimbreFiscal
#
#        4.1) Ensobreta
#        4.2) Envía a TimbreFiscal
#        4.3) Recibe un timbre (o procesa un error)
# Regresa el $cfdi intacto y $timbre
###############################################################
echo "\n\nPASO4. Timbra el CFDI en la variable \$cfdi con TimbreFiscal\n";
# Convierte a modelo DOM
$xml = new DOMDocument();
$xml->loadXML($cfdi) or die("\n\n\nXML no valido");
# Valida CFDi contra esquema
$xml->schemaValidate('cfdv3.xsd') or die("\n\n\nCFDi no valido");

# Sobre con el request
$envtext = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tim="http://www.buzonfiscal.com/ns/xsd/bf/TimbradoCFD" xmlns:req="http://www.buzonfiscal.com/ns/xsd/bf/RequestTimbraCFDI" xmlns:cfdi="http://www.sat.gob.mx/cfd/3">
	<soapenv:Header/>
	<soapenv:Body>
		<tim:RequestTimbradoCFD xmlns:tim="http://www.buzonfiscal.com/ns/xsd/bf/TimbradoCFD" xmlns:req="http://www.buzonfiscal.com/ns/xsd/bf/RequestTimbraCFDI" xmlns:cfdi="http://www.sat.gob.mx/cfd/3">
			<req:InfoBasica RfcEmisor="" RfcReceptor=""/>
		</tim:RequestTimbradoCFD>
	</soapenv:Body>
</soapenv:Envelope>
XML;
$env = new DOMDocument();
$env->loadXML($envtext) or die("\n\n\nError interno en el sobre");

# Ensobreta
$c = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
$c = $env->importNode($c, true);
$t = $env->getElementsByTagNameNS('http://www.buzonfiscal.com/ns/xsd/bf/TimbradoCFD', 'RequestTimbradoCFD')->item(0);
$t->appendChild($c);

# Listo! ensobretado. Normaliza infoBasica
$t->getElementsByTagName('InfoBasica')->item(0)->setAttribute('RfcEmisor',   $c->getElementsByTagName('Emisor'  )->item(0)->getAttribute('rfc'));
$t->getElementsByTagName('InfoBasica')->item(0)->setAttribute('RfcReceptor', $c->getElementsByTagName('Receptor')->item(0)->getAttribute('rfc'));
unset($xml, $envtext, $c, $t);
echo htmlspecialchars($env->saveXML());

# Paso 4.2 Envía a TimbreFiscal y 4.3 recibe un timbre o procesa un error
$process = curl_init('https://demotf.buzonfiscal.com/timbrado');
curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: text/xml', 'charset=utf-8'));
curl_setopt($process, CURLOPT_POSTFIELDS, $env->saveXML());
curl_setopt($process, CURLOPT_SSLCERT, '/var/www/timbre/democert.pem');
curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
curl_setopt($process, CURLOPT_POST, true);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
$timbre = curl_exec($process);
curl_close($process);
if (!$timbre) {
	echo curl_error($process);
	die("Error en comunicacion\n");
}
echo "Timbre = [", htmlspecialchars($timbre), "]\n";

###############################################################
# PASO5. Integra el timbre recibido en $timbre en el $cfdi
#
# Regresa el $cfdi ya integrado con el timbre
###############################################################
echo "\n\nPASO5. Integra el timbre recibido en \$timbre en el \$cfdi\n";
# Convierte a modelo DOM
$xml = new DOMDocument();
$xml->loadXML($cfdi) or die("\n\n\nXML no valido");
$xml->schemaValidate('cfdv3.xsd') or die("\n\n\nCFDi no valido");
# Valida que realmente haya regresado un timbre
$sobretimbre = new DOMDocument();
$sobretimbre->loadXML($timbre) or die("\n\n\nXML de respuesta no valido\n");
# Extrae el timbre (si existe)
$xmltimbre = new DOMDocument('1.0', 'UTF-8');
# Extrae el nodo
$paso = $sobretimbre->getElementsByTagNameNS('http://www.sat.gob.mx/TimbreFiscalDigital', 'TimbreFiscalDigital')->item(0);
$paso = $xmltimbre->importNode($paso, true);
$xmltimbre->appendChild($paso);
unset($paso);
# Valida
$xmltimbre->schemaValidate('TimbreFiscalDigital.xsd') or die("\n\n\nError de validacion\n$return");
# Incorpora el timbre en el nodo complemento. Si no existe dicho nodo, lo crea
$complemento = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Complemento')->item(0);
if (!$complemento) {
	$complemento = $xml->createElementNS('http://www.sat.gob.mx/cfd/3', 'Complemento');
	$xml->appendChild($complemento);
}
$t = $xmltimbre->getElementsByTagNameNS('http://www.sat.gob.mx/TimbreFiscalDigital', 'TimbreFiscalDigital')->item(0);
$t = $xml->importNode($t, true);
$complemento->appendChild($t);
$cfdi = $xml->saveXML();
unset($timbre, $xml, $sobretimbre, $xmltimbre, $paso, $complemento, $t);

echo htmlspecialchars($cfdi);

?>
</PRE></BODY><HTML>


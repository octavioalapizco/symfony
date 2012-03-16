Aprendiendo Symfony By Carechimba
========================

Desarrollando un bundle de Facturación usando SCRUM.
El proyecto sera entregado en 4 partes (4 Sprints)

1) Las facturas impresas
--------------------------------

En este sprint se van a entregar facturas imprimibles con todos los elementos necesaros para hacerlas deducibles en hacienda.
Las facturas en PDF se administrarán como templates, los usuarios podrán tener templates personalizados, compartirlos o privatizarlos.
El objetivo de este sprint también es el de conocer a profundidad los elementos de las facturas CFD, CFDI y factura de papel.

Importacion de XMLS y presentacion en PDF, WEB y mobil.

### De los XMLs y la base de datos

Sabemos que las facturas digitales son un formato ``XML``, en este sprint no generamos xmls ni informacion en ``base de datos``.
En este sprint SI leeremos ``XMLS`` para generar los imprimibles y posiblemente tambien leeremos de la base de datos para generar imprimibles.

### Templates de facturas

En este sprint debemos generar la estructura para los templates.

Lorem Impsum:

    lorem ipsum noseque
    mas lorem ipsum
    y mas blablabla

2) Generacion de informacion
---------------

	Obtetivo: 
	
	Almacenamiento de información en la base de datos.
	Generacion de XMLs.

### a) Lorem impsum

blablabla



A default bundle, ``AcmeDemoBundle``, shows you Symfony2 in action. After
playing with it, you can remove it by following these steps:

* delete the ``src/Acme`` directory;
* remove the routing entries referencing AcmeBundle in ``app/config/routing_dev.yml``;
* remove the AcmeBundle from the registered bundles in ``app/AppKernel.php``;


What's inside?
---------------
The Symfony Standard Edition comes pre-configured with the following bundles:
	
* **FrameworkBundle** - The core Symfony framework bundle
* **SensioFrameworkExtraBundle** - Adds several enhancements, including template
  and routing annotation capability ([documentation](http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html))
* **DoctrineBundle** - Adds support for the Doctrine ORM
  ([documentation](http://symfony.com/doc/current/book/doctrine.html))
* **TwigBundle** - Adds support for the Twig templating engine
  ([documentation](http://symfony.com/doc/current/book/templating.html))
* **SecurityBundle** - Adds security by integrating Symfony's security component
  ([documentation](http://symfony.com/doc/current/book/security.html))
* **SwiftmailerBundle** - Adds support for Swiftmailer, a library for sending emails
  ([documentation](http://symfony.com/doc/2.0/cookbook/email.html))
* **MonologBundle** - Adds support for Monolog, a logging library
  ([documentation](http://symfony.com/doc/2.0/cookbook/logging/monolog.html))
* **AsseticBundle** - Adds support for Assetic, an asset processing library
  ([documentation](http://symfony.com/doc/2.0/cookbook/assetic/asset_management.html))
* **JMSSecurityExtraBundle** - Allows security to be added via annotations
  ([documentation](http://symfony.com/doc/current/bundles/JMSSecurityExtraBundle/index.html))
* **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
  the web debug toolbar
* **SensioDistributionBundle** (in dev/test env) - Adds functionality for configuring
  and working with Symfony distributions
* **SensioGeneratorBundle** (in dev/test env) - Adds code generation capabilities
  ([documentation](http://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html))
* **AcmeDemoBundle** (in dev/test env) - A demo bundle with some example code

Enjoy!

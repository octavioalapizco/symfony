<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
			// ...
			new Sonata\AdminBundle\SonataAdminBundle(),
			new Sonata\BlockBundle\SonataBlockBundle(),
			new Sonata\CacheBundle\SonataCacheBundle(),
			new Sonata\jQueryBundle\SonatajQueryBundle(),
			new Knp\Bundle\MenuBundle\KnpMenuBundle(),
			//new Sonata\BluePrintBundle\SonataBluePrintBundle(),
			// ...
			new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
			//new SimpleThings\EntityAudit\SimpleThingsEntityAuditBundle(),
			// ...
			new FOS\UserBundle\FOSUserBundle(),			
			// ...
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Acme\BlogBundle\AcmeBlogBundle(),
			new Acme\SecurityBundle\AcmeSecurityBundle(),
			new Acme\UserBundle\AcmeUserBundle(),
          //  new Acme\HealthyBundle\AcmeHealthyBundle(),

            new Acme\FacturacionBundle\AcmeFacturacionBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}

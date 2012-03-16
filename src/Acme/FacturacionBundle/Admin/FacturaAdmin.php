<?php
namespace  Acme\FacturacionBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class FacturaAdmin extends Admin
{



	protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('rfc_e')
			->add('rfc_r')
			->add('fecha_emision')
			->add('serie')			
			->add('folio')			
			->add('total_antes_dimpuestos')
			->add('i_traladados')			
			->add('i_retenidos')			
			->add('total')			
        ;
		
    }
	 protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('rfc_e')
			->add('rfc_r')
			->add('fecha_emision')
			->add('serie')			
			->add('folio')			
			->add('total_antes_dimpuestos')
			->add('i_traladados')			
			->add('i_retenidos')			
			->add('total')
			->add('_action', 'actions', array( 'actions' => 
				array(   
					 'verpdf' => array('template' =>'AcmeFacturacionBundle:Admin:action_unpublish.html.twig'))));
        ;
    }

	public function verpdfAction(){
		
	}
   /* protected function configureRoutes(RouteCollection $collection) {
		$collection->add('verpdf',
		$this->getRouterIdParameter().'/verpdf'); 
	}*/
	

}
?>
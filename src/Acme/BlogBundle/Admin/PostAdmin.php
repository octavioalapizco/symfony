<?php
namespace  Acme\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class PostAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('title')
			->add('content')
			->add('fk_blog_id')
			->add('created_at')			
        ;
    }
	 protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('title')
            ->add('content')
			->add('fk_blog_id')
			->add('created_at')	
        ;
    }

    protected $maxPerPage = 5;
	protected $form = array(
        'id',
		'title',
		'content',
		'fk_blog_id',
		'created_at'        
    );
}
?>
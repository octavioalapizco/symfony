<?php
namespace  Acme\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class BlogAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('blog_id')
            ->add('blog_name')			
        ;
    }
	 protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('blog_id')
            ->add('blog_name')            
        ;
    }
}
?>
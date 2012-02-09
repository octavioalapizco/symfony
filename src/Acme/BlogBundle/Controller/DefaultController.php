<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\BlogBundle\Entity\Blog;

class DefaultController extends Controller
{
	/*
	Muestra la pagina principal
	
	*/
	public function homeAction(){
		$blogs = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT p FROM AcmeBlogBundle:Blog p ')
            ->getResult();
		
		return $this->render('AcmeBlogBundle:Default:home.html.twig',array('blogs'=>$blogs) );
	}
	
    function admin_Action(){
		return $this->render( 'AcmeBlogBundle:Default:default.html.twig', array('mensaje'=>"Blog Main Panel") );
	}
	
	function admin_post_Action(){
		return new Response("post admin");
	}
	
	function admin_blog_Action(){
		return new Response("blog admin");
	}
	
    
	
	
	
	
	
	
	
	
	
	public function blog_save_Action(){
		return new Response("Save en construccion");
	}
	
	
}
?>
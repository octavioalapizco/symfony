<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BlogController extends Controller
{
    public function homeAction()
    {
        return $this->render('AcmeBlogBundle:Default:index.html.twig', array('name' => " - HOME - "));
    }
	
    public function indexAction($blog)
    {
        return $this->render('AcmeBlogBundle:Default:index.html.twig', array('name' => "INDEX: ".$blog));
    }
	
	public function postAction($blog,$post)
    {
	
        return $this->render('AcmeBlogBundle:Default:index.html.twig', array('name' => "POST: ".$blog."/".$post));
    }
}

<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    
    public function indexAction($blog='blog Name')
    {				
		$blogs = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT b FROM AcmeBlogBundle:Blog b WHERE b.blog_name=:blog')
			->setParameter('blog', $blog)
            ->getResult();			
			
		if (empty($blogs[0])){
			return $this->render('AcmeBlogBundle:Default:index.html.twig',
				array(
					'posts'=>array(),
					'blog'=>array(),
				) 
			);
		}
		$blogId=$blogs[0]->getBlogId();
		
		$posts = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT p FROM AcmeBlogBundle:Post p WHERE p.fk_blog_id=:blog_id')
			->setParameter('blog_id', $blogId)
            ->getResult();			
		
		
		
		return $this->render('AcmeBlogBundle:Default:index.html.twig',
			array(
				'posts'=>$posts,
				'blog'=>$blogs[0],
			) 
		);
        
    }
	
	public function postAction($blog,$post){			
		$blogs = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT b FROM AcmeBlogBundle:Blog b WHERE b.blog_name=:blog')
			->setParameter('blog', $blog)
            ->getResult();			
			
		$blogId=$blogs[0]->getBlogId();
	
		$post=$this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT p FROM AcmeBlogBundle:Post p WHERE p.fk_blog_id=:blog_id')
			->setParameter('blog_id', $blogId)
            ->getResult();
		
		return $this->render('AcmeBlogBundle:Default:post.html.twig', array(
			'blog' => $blog,
			'post'=>$post[0]
		));
	}
	
	public function homeAction(){
		$blogs = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT p FROM AcmeBlogBundle:Blog p ')
            ->getResult();
		
		return $this->render('AcmeBlogBundle:Default:home.html.twig',array('blogs'=>$blogs) );
	}
}

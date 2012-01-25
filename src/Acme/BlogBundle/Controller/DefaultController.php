<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\BlogBundle\Entity\Blog;

class DefaultController extends Controller
{
    function admin_Action(){
		return $this->render( 'AcmeBlogBundle:Default:default.html.twig', array('mensaje'=>"Blog Main Panel") );
	}
	
	function admin_post_Action(){
		return new Response("post admin");
	}
	
	function admin_blog_Action(){
		return new Response("blog admin");
	}
	
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
	
	public function task_Action(Request $request){
		$task = new Blog();
        $task->setBlogName('Write a blog');
        

        $form = $this->createFormBuilder($task)
            ->add('blog_name', 'text')            
            ->getForm();
	
		 if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);

			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($task);
				$em->flush();
				
				return $this->render('AcmeBlogBundle:Default:default.html.twig',array('mensaje'=>'Blog guardado:'.$task->getBlogName()) );
			}
		}
		
		return $this->render('AcmeBlogBundle:Default:task.html.twig', array(
            'form' => $form->createView(),
			'mensaje'=>'asd'
        ));
	}
	
	public function blog_save_Action(){
		return new Response("Save en construccion");
	}
	
	
}
?>
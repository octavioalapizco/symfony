<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\UserBundle\Entity\User;
use Acme\BlogBundle\Entity\Blog;

class BlogController extends Controller
{
	public function index_Action($blog='blog Name')
    {				
	//==========================================================================
		/*$factory = $this->get('security.encoder_factory');
$user = new User();

$encoder = $factory->getEncoder($user);
$password = $encoder->encodePassword('ryanpass', $user->getSalt());
$user->setUsername('ryan');
$user->setEmail('ryan@email.com');
$user->setPassword($password);
$em = $this->getDoctrine()->getEntityManager();
    $em->persist($user);
    $em->flush();*/
	//==========================================================================
		$blog=$this->getBlogFromParam($blog);		
		$blogId=$blog->getBlogId();
		
		$posts = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT p FROM AcmeBlogBundle:Post p WHERE p.fk_blog_id=:blog_id')
			->setParameter('blog_id', $blogId)
            ->getResult();			
		
		return $this->render('AcmeBlogBundle:Blog:index.html.twig',
			array(
				'posts'=>$posts,
				'blog'=>$blog,
			) 
		);        
    }
	 public function new_blog_Action(Request $request){
		$blog = new Blog();
        $blog->setBlogName('Write a blog');
        
        $form = $this->createFormBuilder($blog)
            ->add('blog_name', 'text')            
            ->getForm();
	
		 if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);

			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($blog);
				$em->flush();
				
				$posts=$blog->getPosts();
				
				return $this->render('AcmeBlogBundle:Blog:index.html.twig',
					array(
						'blog'=>$blog,
						'post'=>$posts
					) 
				);
			}
		}
		
		return $this->render('AcmeBlogBundle:Default:task.html.twig', array(
            'form' => $form->createView(),
			'mensaje'=>'asd'
        ));
	}

	private function getBlogFromParam($param){
		/*	Paso 1: Se analiza la variable $param.
		
			si es un entero suponemos que es el id del blog. 
			si es una cadena suponemos que es el nombre del blog,por lo que obtendremos el blog a partir de su nombre. 
			Se obtiene el id del blog	
		*/					
		//							P 1
		
		if (is_numeric($param) ){
			$blog_id=$param;			
			$blogs= $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT b FROM AcmeBlogBundle:Blog b WHERE b.blog_id=:blog_id')
			->setParameter('blog_id', $blog_id)
            ->getResult();			
			
		}else if ( is_string($param) && !empty($param) ){
			$blog_name=$param;			
			$blogs= $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT b FROM AcmeBlogBundle:Blog b WHERE b.blog_name=:blog')
			->setParameter('blog', $blog_name)
            ->getResult();						
		}
		$blog=$blogs[0];
		return $blog;
		
	}
	public function edit_blog_Action(Request $request,$blog){
		$blog=$this->getBlogFromParam($blog);
		
		//----------------------------------------------------------------------------------        
        $form = $this->createFormBuilder($blog)
            ->add('blog_id', 'text')            
			->add('blog_name', 'text')			
            ->getForm();
		
		//----------------------------------------------------------------------------------
		return $this->render('AcmeBlogBundle:Default:blog_form.html.twig', array(
            'form' => $form->createView(),
			'mensaje'=>'asd'
        ));
	}
	
	public function save_Action(Request $request){
		$task = new Blog();
        $task->setBlogName('Write a blog');
        

        $form = $this->createFormBuilder($task)
            ->add('blog_name', 'text')
			->add('blog_id', 'text')            
            ->getForm();
	
		 if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);

			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				$em = $this->getDoctrine()->getEntityManager();
				$id=$task->getBlogId();
				if (!empty($id)){
					$task=$em->merge($task);
				}
				$em->persist($task);
				$em->flush();
				
				return $this->render('AcmeBlogBundle:Default:default.html.twig',array('mensaje'=>'Blog guardado:'.$task->getBlogName()) );
			}
		}
		
		return $this->render('AcmeBlogBundle:Default:blog_form.html.twig', array(
            'form' => $form->createView(),
			'mensaje'=>'asd'
        ));
	}
	
	public function delete_Action(Request $request,$blog){
		$blog=$this->getBlogFromParam($blog);
		$id=$blog->getBlogId();
		$em = $this->getDoctrine()->getEntityManager();
		if (!empty($id)){
			$blog=$em->merge($blog);
		}
		$em->remove($blog);
		$em->flush();
				
		return $this->render('AcmeBlogBundle:Default:default.html.twig',array('mensaje'=>'Blog Eliminado:'.$blog->getBlogName()) );
	
	}
   
}

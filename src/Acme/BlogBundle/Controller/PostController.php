<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Acme\BlogBundle\Entity\Post;

class PostController extends Controller
{
	public function postAction($blog,$post){			
		$blogs = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT b FROM AcmeBlogBundle:Blog b WHERE b.blog_name=:blog')
			->setParameter('blog', $blog)
            ->getResult();			
			//print_r($blogs);
		$blogId=$blogs[0]->getBlogId();
	
		$posts=$this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT p FROM AcmeBlogBundle:Post p WHERE p.fk_blog_id=:blog_id AND p.title=:title')
			->setParameter('blog_id', $blogId)
			->setParameter('title', $post)
            ->getResult();
		//print_r($post);
		$postObj=$posts[0];
		$contenido=$postObj->getContent();
		$contenido=$contenido; 
		$postObj->setContent($contenido);
		return $this->render('AcmeBlogBundle:Default:post.html.twig', array(
			'blog' => $blog,
			'blog_id'=>$blogId,
			'post'=>$postObj
		));
	}
	

	
	private function crearForm($post){
		//----------------------------------------------------------------------------------        
        $form = $this->createFormBuilder($post)
            ->add('id', 'text')            
			->add('title', 'text')
			->add('content', 'textarea', array('required'=>false))
			->add('fk_blog_id', 'text')
            ->getForm();
		//----------------------------------------------------------------------------------
		return $form;
	}
    public function new_post_Action(Request $request,$blog=''){
		
		$post = new Post();						
		//----------------------------------------------------------------------------------        
		if ($request->getMethod() == 'GET') {
			//Obtener el id del blog padre, y agregarlo al post (fk_blog_id)
			$blog=$this->getBlogFromParam($blog);
			$blog_id=$blog->getBlogId();
			$blog_name=$blog->getBlogName();
			$post->setFkBlogId($blog_id);   /*<--------- Relaciona Post y Blog  			*/ 						
		}
		//----------------------------------------------------------------------------------        
		$form=$this->crearForm($post);
		//----------------------------------------------------------------------------------        
		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);

			if ($form->isValid()) {
				// perform some acti	on, such as saving the task to the database
				$em = $this->getDoctrine()->getEntityManager();
				$id=$post->getId();
				if (!empty($id)){
					$post=$em->merge($post);
				}else{
					$post->setCreatedAt(date_create());
				}
				$em->persist($post);
				$blog=$this->getBlogFromParam( $post->getFkBlogId() );
				$blog_name=$blog->getBlogName();
				$blog_id=$blog->getBlogId();
				$em->flush();
				return $this->render('AcmeBlogBundle:Default:post.html.twig', array(
					'blog' => $blog_name,
					'blog_id'=>$blog_id,
					'post'=>$post
				));
				
			}
		}
		//----------------------------------------------------------------------------------
		return $this->render('AcmeBlogBundle:Default:post_form.html.twig', array(
            'form' => $form->createView(),			
        ));
	}
	public function edit_post_Action(Request $request,$blog,$title){				
		$post = new Post();		
		//----------------------------------------------------------------------------------        
		if ($request->getMethod() == 'GET') {
			//Obtener el id del blog padre, y agregarlo al post (fk_blog_id)
			$blog=$this->getBlogFromParam($blog);
			$blog_id=$blog->getBlogId();
			//$blog_name=$blog->getBlogName();			
		}		
	
		$posts= $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT p FROM AcmeBlogBundle:Post p WHERE p.title=:title AND p.fk_blog_id=:fk_blog_id')
			->setParameter('title', $title)
			->setParameter('fk_blog_id', $blog_id)
            ->getResult();			
		
		$post=$posts[0];
		//----------------------------------------------------------------------------------        
        $form = $this->crearForm($post);            		
		//----------------------------------------------------------------------------------
		return $this->render('AcmeBlogBundle:Default:post_form.html.twig', array(
            'form' => $form->createView(),
			'mensaje'=>'asd'
        ));
	}
	
	public function delete_Action(Request $request,$post_id){
		$post=$this->getPostFromParam($post_id);
		$id=$post->getId();
		$em = $this->getDoctrine()->getEntityManager();
		if (!empty($id)){
			$post=$em->merge($post);
		}
		$em->remove($post);
		$em->flush();
				
		return $this->render('AcmeBlogBundle:Default:default.html.twig',array('mensaje'=>'Post Eliminado:'.$post->getTitle()) );
	
	}
	private function getPostFromParam($param){
		/*	Se analiza la variable $param:		
			si es un entero suponemos que es el id del blog. 
			si es una cadena suponemos que es el nombre del blog,por lo que obtendremos el blog a partir de su nombre. 			
		*/							
		
		if (is_numeric($param) ){
			$post_id=$param;			
			$posts= $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT b FROM AcmeBlogBundle:Post b WHERE b.id=:id')
			->setParameter('id', $post_id)
            ->getResult();			
			
		}else if ( is_string($param) && !empty($param) ){
			$post_title=$param;			
			$posts= $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT b FROM AcmeBlogBundle:Post b WHERE b.title=:title')
			->setParameter('title', $post_title)
            ->getResult();						
		}
		$post=$posts[0];
		return $post;
		
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
}

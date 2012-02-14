<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\UserBundle\Entity\User;


class UserController extends Controller
{
	public function index_Action($blog='blog Name')
    {				
	
	
    }
	 public function new_user_Action(Request $request){
		//==========================================================================
		
		$user = new User();
        $form = $this->createFormBuilder($user)
            ->add('username', 'text')            
			->add('password', 'password')
			->add('email', 'email')
            ->getForm();
	
		 if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);

			if ($form->isValid()) {
				$factory = $this->get('security.encoder_factory');
				$encoder = $factory->getEncoder($user);
				$password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
				$user->setPassword($password);
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($user);
				$em->flush();
								
				return $this->render('AcmeBlogBundle:Default:default.html.twig',array('mensaje'=>'Usuario creado:'.$user->getUsername()) );
			}
		}
		
		return $this->render('AcmeUserBundle::user.html.twig', array(
            'form' => $form->createView()
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

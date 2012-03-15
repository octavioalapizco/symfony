<?php
namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_categoria")
 */
class Categoria
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nombre;        

    
	
	/**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="categoria")
     */
    protected $posts;
    
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add posts
     *
     * @param Acme\BlogBundle\Entity\Post $posts
     */
    public function addPost(\Acme\BlogBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
    }
	public function setId($id)
    {
         $this->id=$id;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
	
	function __toString(){
		return $this->nombre;
	}
}
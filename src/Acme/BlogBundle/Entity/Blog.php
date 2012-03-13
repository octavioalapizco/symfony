<?php
namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog")
 */
class Blog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $blog_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $blog_name;        

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="fk_blog_id")
     */
    protected $posts;
	
	
    /**
     * Get blog_id
     *
     * @return integer 
     */
    public function getBlogId()
    {
        return $this->blog_id;
    }
	public function setBlogId($blog_id)
    {
         $this->blog_id=$blog_id;
    }

    /**
     * Set blog_name
     *
     * @param string $blogName
     */
    public function setBlogName($blogName)
    {
        $this->blog_name = $blogName;
    }

    /**
     * Get blog_name
     *
     * @return string 
     */
    public function getBlogName()
    {
        return $this->blog_name;
    }
	
	
	

	public function __toString(){
		return $this->blog_name;
	}
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
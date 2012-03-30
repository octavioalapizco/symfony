<?php

namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\BlogBundle\Entity\Blog
 *
 * @ORM\Table(name="blog")
 * @ORM\Entity
 */
class Blog
{
    /**
     * @var integer $blogId
     *
     * @ORM\Column(name="blog_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $blogId;

    /**
     * @var string $blogName
     *
     * @ORM\Column(name="blog_name", type="string", length=255, nullable=false)
     */
    private $blogName;


}
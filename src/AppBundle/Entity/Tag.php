<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Tag
 *
 * @category Entity
 * @package AppBundle\Entity
 * @author Wils Iglesias <wiglesias83@gmail.com>
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagRepository")
 * @UniqueEntity("title")
 */
class Tag extends AbstractBase
{
    use TitleTrait;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    private $posts;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * Tag constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param ArrayCollection $posts
     *
     * @return Tag
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * Add post
     *
     * @param Post $post
     *
     * @return $this
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param Post $post
     *
     * @return $this
     */
    public function removePost(Post $post)
    {
        $this->posts->removeElement($post);

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle() ? $this->getTitle() : '---';
    }
}
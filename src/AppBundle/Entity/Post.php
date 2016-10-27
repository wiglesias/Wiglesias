<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Post
 *
 * @category Entity
 * @package AppBundle\Entity
 * @author Wils Iglesias <wiglesias83@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 *
 */
class Post extends AbstractBase
{

}
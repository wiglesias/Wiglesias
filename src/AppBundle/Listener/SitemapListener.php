<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Presta\SitemapBundle\Service\SitemapListenerInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class SitemapListener
 *
 * @category Listener
 * @package  AppBundle\Listener
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class SitemapListener implements SitemapListenerInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ArrayCollection
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
     * SitemapListener constructor
     *
     * @param RouterInterface $router
     * @param EntityManager $em
     */
    public function __construct(RouterInterface $router, EntityManager $em)
    {
        $this->router = $router;
        $this->em = $em;
        $this->posts = $this->em->getRepository('AppBundle:Post')->getAllEnabledSortedByPublishedDateWithJoin();
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function populateSitemap(SitemapPopulateEvent $event)
    {
        $section = $event->getSection();
        if (is_null($section) || $section == 'default') {
            // Homepage
            $url = $this->makeUrl('front_homepage');
            $event
                ->getUrlContainer()
                ->addUrl($this->makeUrlConcrete($url), 'default');
            $url = $this->makeUrl('front_about');
            $event
                ->getUrlContainer()
                ->addUrl($this->makeUrlConcrete($url), 'default');
            $url = $this->makeUrl('front_portafolio');
            $event
                ->getUrlContainer()
                ->addUrl($this->makeUrlConcrete($url), 'default');
            $url = $this->makeUrl('front_blog');
            $event
                ->getUrlContainer()
                ->addUrl($this->makeUrlConcrete($url), 'default');
            $url = $this->makeUrl('front_contact');
            $event
                ->getUrlContainer()
                ->addUrl($this->makeUrlConcrete($url), 'default');
            $url = $this->makeUrl('front_credits');
            $event
                ->getUrlContainer()
                ->addUrl($this->makeUrlConcrete($url), 'default');
            /** @var Post $post */
            foreach ($this->posts as $post) {
                $url = $this->router->generate(
                    'front_blog_detail',
                    array(
                        'year' => $post->getPublishedAt()->format('Y'),
                        'month' => $post->getPublishedAt()->format('m'),
                        'day' => $post->getPublishedAt()->format('d'),
                        'slug' => $post->getSlug(),
                    ),
                    UrlGeneratorInterface::ABSOLUTE_URL
                );
                $event
                    ->getUrlContainer()
                    ->addUrl($this->makeUrlConcrete($url, 0.8, $post->getUpdatedAt()), 'default');
            }
        }
    }

    /**
     * @param string $routeName
     *
     * @return string
     */
    private function makeUrl($routeName)
    {
        return $this->router->generate(
            $routeName, array(), UrlGeneratorInterface::ABSOLUTE_URL
        );
    }

    /**
     * @param string         $url
     * @param int            $priority
     * @param \DateTime|null $date
     *
     * @return UrlConcrete
     */
    private function makeUrlConcrete($url, $priority = 1, $date = null)
    {
        return new UrlConcrete(
            $url,
            $date === null ? new \DateTime() : $date,
            UrlConcrete::CHANGEFREQ_WEEKLY,
            $priority
        );
    }
}

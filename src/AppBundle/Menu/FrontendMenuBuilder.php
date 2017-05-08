<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/**
 * Class FrontendMenuBuilder
 *
 * @category Menu
 * @package  AppBundle\Menu
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class FrontendMenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var AuthorizationChecker
     */
    private $ac;

    /**
     * @var TokenStorageInterface
     */
    private $ts;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * @param FactoryInterface     $factory
     * @param AuthorizationChecker $ac
     * @param TokenStorageInterface $ts
     */
    public function __construct(FactoryInterface $factory, AuthorizationChecker $ac, TokenStorageInterface $ts)
    {
        $this->factory = $factory;
        $this->ac = $ac;
        $this->ts      = $ts;
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return ItemInterface
     */
    public function createTopMenu(RequestStack $requestStack)
    {
        $route = $requestStack->getCurrentRequest()->get('_route');
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        if ($this->ts->getToken() && $this->ac->isGranted('ROLE_CMS')) {
            $menu->addChild(
                'admin',
                array(
                    'label' => 'frontend.menu.cms',
                    'route' => 'sonata_admin_dashboard',
                )
            );
        }
        $menu->addChild(
            'front_about',
            array(
                'label' => 'frontend.menu.about',
                'route'   => 'front_about',
                'current' => $route == 'front_about',
            )
        );
//        $menu->addChild(
//            'front_portafolio',
//            array(
//                'label' => 'frontend.menu.portafolio',
//                'route'   => 'front_portafolio',
//                'current' => $route == 'front_portafolio',
//            )
//        );
        $menu->addChild(
            'front_blog',
            array(
                'label' => 'frontend.menu.blog',
                'route' => 'front_blog',
                'current' => $route == 'front_blog' || $route == 'front_blog_detail' || $route == 'front_blog_tag_detail',
            )
        );
        $menu->addChild(
            'front_contact',
            array(
                'label' => 'frontend.menu.contact',
                'route'   => 'front_contact',
            )
        );

        return $menu;
    }
}

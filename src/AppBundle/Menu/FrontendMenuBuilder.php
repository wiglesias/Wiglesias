<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;
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
     *
     *
     * Methods
     *
     *
     */

    /**
     * @param FactoryInterface     $factory
     * @param AuthorizationChecker $ac
     */
    public function __construct(FactoryInterface $factory, AuthorizationChecker $ac)
    {
        $this->factory = $factory;
        $this->ac = $ac;
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
        if ($this->ac->isGranted('ROLE_CMS')) {
            $menu->addChild(
                'admin',
                array(
                    'label' => 'frontend.menu.cms',
                    'route' => 'sonata_admin_dashboard',
                )
            );
        }
        $menu->addChild(
            'front_portafolio',
            array(
                'label'   => '<i class="fa fa-folder" aria-hidden="true"></i> Portafolio',
                'route'   => 'front_portafolio',
                'current' => $route == 'front_portafolio',
                'extras' => array('safe_label' => true),
            )
        );
        $menu->addChild(
            'front_blog',
            array(
                'label' => '<i class="fa fa-comment" aria-hidden="true"></i> Blog',
                'route' => 'front_blog',
                'current' => $route == 'front_blog' || $route == 'front_blog_detail',
                'extras'  => array('safe_label' => true),
            )
        );
        $menu->addChild(
            'front_contact',
            array(
                'label'   => '<i class="fa fa-info" aria-hidden="true"></i> Contacto',
                'route'   => 'front_contact',
                'extras' => array('safe_label' => true),
            )
        );

        return $menu;
    }
}

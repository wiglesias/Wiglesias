<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Class CustomerAdmin.
 *
 * @category Admin
 *
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class CustomerAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Customer';
    protected $baseRoutePattern = 'billing/customer';
    protected $datagridValues = array(
        '_sort_by' => 'username',
        '_sort_order' => 'asc',
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('backend.admin.general', $this->getFormMdSuccessBoxArray(4))
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.customer.name',
                    'required' => false,
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label' => 'backend.admin.customer.surname',
                    'required' => false,
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label' => 'backend.admin.customer.company',
                    'required' => false,
                )
            )
            ->add(
                'website',
                null,
                array(
                    'label' => 'backend.admin.customer.website',
                    'required' => false,
                )
            )
            ->end()
            ->with('backend.admin.contact.contact', $this->getFormMdSuccessBoxArray(4))
            ->add(
                'address',
                null,
                array(
                    'label' => 'backend.admin.customer.address',
                    'required' => true,
                )
            )
            ->add(
                'city',
                EntityType::class,
                array(
                    'label' => 'backend.admin.customer.city',
                    'required' => true,
                    'class' => 'AppBundle:City',
                    'query_builder' => $this->getConfigurationPool()->getContainer()->get('app.city_repository')->getEnabledSortedByNameQB(),
                )
            )
            ->add(
                'mobile',
                null,
                array(
                    'label' => 'backend.admin.customer.mobile',
                    'required' => false,
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'backend.admin.customer.phone',
                    'required' => false,
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'backend.admin.customer.email',
                    'required' => true,
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(3))
            ->add(
                'identityCard',
                null,
                array(
                    'label' => 'backend.admin.customer.identityCard',
                    'required' => true,
                )
            )
            ->add(
                'enabled',
                CheckboxType::class,
                array(
                    'label' => 'backend.admin.enabled',
                    'required' => false,
                )
            )
            ->end()
        ;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.customer.name',
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label' => 'backend.admin.customer.surname',
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label' => 'backend.admin.customer.company',
                )
            )
            ->add(
                'identityCard',
                null,
                array(
                    'label' => 'backend.admin.customer.identityCard',
                )
            )
            ->add(
                'city',
                null,
                array(
                    'label' => 'backend.admin.customer.city',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'backend.admin.customer.email',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'backend.admin.enabled',
                )
            )
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.customer.name',
                    'editable' => true,
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label' => 'backend.admin.customer.surname',
                    'editable' => true,
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label' => 'backend.admin.customer.company',
                    'editable' => true,
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'backend.admin.customer.email',
                    'editable' => true,
                )
            )
            ->add(
                'identityCard',
                null,
                array(
                    'label' => 'backend.admin.customer.identityCard',
                    'editable' => true,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'backend.admin.enabled',
                    'editable' => true,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'show' => array('template' => '::Admin/Buttons/list__action_show_button.html.twig'),
                        'edit' => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    ),
                    'label' => 'backend.admin.actions',
                )
            )
        ;
    }
}

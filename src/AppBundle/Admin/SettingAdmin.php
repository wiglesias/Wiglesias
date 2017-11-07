<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Class SettingAdmin.
 *
 * @category Admin
 *
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class SettingAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Configuración';
    protected $baseRoutePattern = 'setting/profile';
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
            ->with('backend.admin.general', $this->getFormMdSuccessBoxArray(5))
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.setting.firstName',
                    'required' => false,
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label' => 'backend.admin.setting.lastName',
                    'required' => false,
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label' => 'backend.admin.setting.company',
                    'required' => false,
                )
            )
            ->end()
            ->with('backend.admin.contact.contact', $this->getFormMdSuccessBoxArray(3))
            ->add(
                'address',
                null,
                array(
                    'label' => 'backend.admin.setting.address',
                    'required' => true,
                )
            )
            ->add(
                'city',
                null,
                array(
                    'label' => 'backend.admin.setting.city',
                    'required' => true,
                )
            )
            ->add(
                'mobile',
                null,
                array(
                    'label' => 'backend.admin.setting.mobile',
                    'required' => false,
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'backend.admin.setting.phone',
                    'required' => false,
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'backend.admin.setting.email',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(3))
            ->add(
                'identityCard',
                null,
                array(
                    'label' => 'backend.admin.setting.identityCard',
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
                    'label' => 'backend.admin.setting.firstName',
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label' => 'backend.admin.setting.lastName',
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label' => 'backend.admin.setting.company',
                )
            )
            ->add(
                'identityCard',
                null,
                array(
                    'label' => 'backend.admin.setting.identityCard',
                )
            )
            ->add(
                'city',
                null,
                array(
                    'label' => 'backend.admin.setting.city',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'backend.admin.setting.email',
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
                    'label' => 'backend.admin.setting.firstName',
                    'editable' => true,
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label' => 'backend.admin.setting.lastName',
                    'editable' => true,
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label' => 'backend.admin.setting.company',
                    'editable' => true,
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'backend.admin.setting.email',
                    'editable' => true,
                )
            )
            ->add(
                'identityCard',
                null,
                array(
                    'label' => 'backend.admin.setting.identityCard',
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

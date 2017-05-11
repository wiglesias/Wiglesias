<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class CustomerAdmin
 *
 * @category Admin
 * @package AppBundle\Admin
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class CustomerAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Cliente';
    protected $baseRoutePattern = 'facturacion/cliente';
    protected $datagridValues = array(
        '_sort_by'    => 'username',
        '_sort_order' => 'asc',
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Datos de Cliente', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nombre',
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label' => 'Apellidos',
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label' => 'Empresa',
                )
            )
            ->add(
                'identityCard',
                null,
                array(
                    'label' => 'DNI/CIF',
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'Teléfono',
                )
            )
            ->add(
                'mobile',
                null,
                array(
                    'label' => 'movil',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'adress',
                null,
                array(
                    'label' => 'Dirección',
                )
            )
            ->add(
                'city',
                null,
                array(
                    'label' => 'Ciudad',
                )
            )
            ->add(
                'postalCode',
                null,
                array(
                    'label' => 'Codigo Postal',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'Email',
                )
            )
            ->add(
                'enabled',
                'checkbox',
                array(
                    'label'    => 'backend.admin.enabled',
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
                    'label' => 'Nombre',
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label' => 'Apellidos',
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label' => 'Empresa',
                )
            )
            ->add(
                'identityCard',
                null,
                array(
                    'label' => 'DNI/CIF',
                )
            )
            ->add(
                'city',
                null,
                array(
                    'label' => 'Ciudad',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'Email',
                )
            );
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
                    'label'    => 'Nombre',
                    'editable' => true,
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label'    => 'Apellidos',
                    'editable' => true,
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label'    => 'Empresa',
                    'editable' => true,
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label'    => 'Email',
                    'editable' => true,
                )
            )
            ->add(
                'identityCard',
                null,
                array(
                    'label'    => 'DNI/CIF',
                    'editable' => true,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label'    => 'backend.admin.enabled',
                    'editable' => true,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'show'   => array('template' => '::Admin/Buttons/list__action_show_button.html.twig'),
                        'edit'   => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    ),
                    'label'   => 'backend.admin.actions',
                )
            )
        ;
    }
}

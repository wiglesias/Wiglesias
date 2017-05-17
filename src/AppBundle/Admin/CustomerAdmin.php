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
            ->with('General', $this->getFormMdSuccessBoxArray(5))
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nombre',
                    'required' => false,
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label' => 'Apellidos',
                    'required' => false,
                )
            )
            ->add(
                'company',
                null,
                array(
                    'label' => 'Empresa',
                    'required' => false,
                )
            )
            ->add(
                'identityCard',
                null,
                array(
                    'label' => 'DNI/CIF',
                )
            )
            ->end()
            ->with('Dirección', $this->getFormMdSuccessBoxArray(4))
            ->add(
                'adress',
                null,
                array(
                    'label' => 'Dirección',
                    'required' => true,
                )
            )
            ->add(
                'city',
                null,
                array(
                    'label' => 'Ciudad',
                    'required' => true,
                )
            )
            ->add(
                'province',
                null,
                array(
                    'label' => 'Provincia',
                    'required' => true,
                )
            )
            ->add(
                'postalCode',
                null,
                array(
                    'label' => 'Código Postal',
                    'required' => true,
                )
            )
            ->end()
            ->with('Contacto', $this->getFormMdSuccessBoxArray(3))
            ->add(
                'mobile',
                null,
                array(
                    'label' => 'Móvil',
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'Teléfono',
                    'required' => false,
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

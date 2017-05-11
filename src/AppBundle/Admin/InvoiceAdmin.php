<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class InvoiceAdmin
 *
 * @category Admin
 * @package AppBundle\Admin
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class InvoiceAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Factura';
    protected $baseRoutePattern = 'facturacion/factura';
    protected $datagridValues = array(
        '_sort_by'    => 'date',
        '_sort_order' => 'asc',
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Factura', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'date',
                'sonata_type_date_picker',
                array(
                    'label' => 'Fecha Factura',
                )
            )
            ->add(
                'iva',
                null,
                array(
                    'label' => 'IVA',
                )
            )
            ->add(
                'irpf',
                null,
                array(
                    'label' => 'IRPF',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'customer',
                null,
                array(
                    'label' => 'Cliente',
                    'required' => true,
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
            ->with('Líneas de facturas', $this->getFormMdSuccessBoxArray(12))
            ->add(
                'lines',
                'sonata_type_collection',
                array(
                    'label' => 'Línea',
                    'required' => true,
                    'cascade_validation' => true,
                    'error_bubbling' => true,
                    'by_reference' => false,
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
//                    'sortable' => 'position',
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
                'customer',
                null,
                array(
                    'label' => 'Cliente',
                )
            )
            ->add(
                'date',
                null,
                array(
                    'label' => 'Fecha factura',
                )
            )
            ->add(
                'iva',
                null,
                array(
                    'label' => 'IVA',
                )
            )
            ->add(
                'irpf',
                null,
                array(
                    'label' => 'IRPF',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'Activo',
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
                'customer',
                null,
                array(
                    'label'    => 'Cliente',
                    'editable' => true,
                )
            )
            ->add(
                'date',
                null,
                array(
                    'label'    => 'Fecha factura',
                    'editable' => true,
                )
            )
            ->add(
                'iva',
                null,
                array(
                    'label'    => 'IVA',
                    'editable' => true,
                )
            )
            ->add(
                'irpf',
                null,
                array(
                    'label'    => 'IRPF',
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

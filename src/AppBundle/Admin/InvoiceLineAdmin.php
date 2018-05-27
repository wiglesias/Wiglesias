<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class InvoiceLineAdmin.
 *
 * @category Admin
 *
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class InvoiceLineAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Lines';
    protected $baseRoutePattern = 'facturacion/lines';
    protected $datagridValues = array(
        '_sort_by' => 'name',
        '_sort_order' => 'asc',
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('backend.admin.general', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.invoice_line.name',
                )
            )
            ->add(
                'price',
                null,
                array(
                    'label' => 'backend.admin.invoice_line.price',
                )
            )
            ->add(
                'amount',
                null,
                array(
                    'label' => 'backend.admin.invoice_line.amount',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'invoice',
                null,
                array(
                    'label' => 'backend.admin.invoice.invoice',
                    'attr' => array(
                        'hidden' => true,
                    ),
                    'required' => true,
                )
            )
            ->add(
                'enabled',
                'checkbox',
                array(
                    'label' => 'backend.admin.enabled',
                    'required' => false,
                    'attr' => array(
                        'hidden' => true,
                    ),
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
                    'label' => 'backend.admin.invoice_line.name',
                )
            )
            ->add(
                'price',
                null,
                array(
                    'label' => 'backend.admin.invoice_line.price',
                )
            )
            ->add(
                'amount',
                null,
                array(
                    'label' => 'backend.admin.invoice_line.amount',
                )
            )
            ->add(
                'invoice',
                null,
                array(
                    'label' => 'backend.admin.invoice.invoice',
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
                    'label' => 'backend.admin.invoice_line.name',
                    'editable' => true,
                )
            )
            ->add(
                'price',
                null,
                array(
                    'label' => 'backend.admin.invoice_line.price',
                    'editable' => true,
                )
            )
            ->add(
                'amount',
                null,
                array(
                    'label' => 'backend.admin.invoice_line.amount',
                    'editable' => true,
                )
            )
            ->add(
                'invoice',
                null,
                array(
                    'label' => 'backend.admin.invoice.invoice',
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

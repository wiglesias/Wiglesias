<?php

namespace AppBundle\Admin;

use AppBundle\Enum\InvoiceIvaTypeEnum;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class InvoiceAdmin.
 *
 * @category Admin
 *
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class InvoiceAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Invoice';
    protected $baseRoutePattern = 'billing/invoice';
    protected $datagridValues = array(
        '_sort_by' => 'id',
        '_sort_order' => 'desc',
    );

    /**
     * Configure route collection.
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        $collection
            ->add('invoice', $this->getRouterIdParameter().'/invoice')
            ->add('pdf', $this->getRouterIdParameter().'/pdf')
            ->add('send', $this->getRouterIdParameter().'/send')
            ->remove('delete');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('backend.admin.invoice.invoice', $this->getFormMdSuccessBoxArray(4))
            ->add(
                'date',
                'sonata_type_date_picker',
                array(
                    'label' => 'backend.admin.invoice.date',
                    'format' => 'd/M/y',
                    'required' => true,
                )
            )
            ->add(
                'iva',
                ChoiceType::class,
                array(
                    'label' => 'backend.admin.invoice.iva',
                    'choices' => InvoiceIvaTypeEnum::getEnumArray(),
                    'multiple' => false,
                    'expanded' => false,
                    'required' => true,
                )
            )
            ->add(
                'irpf',
                null,
                array(
                    'label' => 'backend.admin.invoice.irpf',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(3))
            ->add(
                'customer',
                null,
                array(
                    'label' => 'backend.admin.invoice.customer',
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
            ->end();
        if ($this->id($this->getSubject())) { // is edit mode, disable on new subjetcs
            $formMapper
                ->with('backend.admin.invoice.lines', $this->getFormMdSuccessBoxArray(12))
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
                    )
                )
                ->end();
        }
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
                    'label' => 'backend.admin.invoice.customer',
                )
            )
            ->add(
                'date',
                'doctrine_orm_date',
                array(
                    'label' => 'backend.admin.invoice.date',
                    'field_type' => 'sonata_type_date_picker',
                    'format' => 'd-m-Y',
                )
            )
            ->add(
                'iva',
                null,
                array(
                    'label' => 'backend.admin.invoice.iva',
                ),
                ChoiceType::class,
                array(
                    'expanded' => false,
                    'multiple' => false,
                    'choices' => InvoiceIvaTypeEnum::getEnumArray(),
                )
            )
            ->add(
                'irpf',
                null,
                array(
                    'label' => 'backend.admin.invoice.irpf',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'backend.admin.enabled',
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
                'id',
                null,
                array(
                    'label' => 'backend.admin.invoice.id',
                    'editable' => false,
                )
            )
            ->add(
                'date',
                null,
                array(
                    'label' => 'backend.admin.invoice.date',
                    'editable' => true,
                    'format' => 'd/m/Y',
                )
            )
            ->add(
                'customer',
                null,
                array(
                    'label' => 'backend.admin.invoice.customer',
                    'editable' => true,
                )
            )
            ->add(
                'taxableBase',
                null,
                array(
                    'label' => 'backend.admin.invoice.taxableBase',
                    'editable' => false,
                )
            )
            ->add(
                'calculateIva',
                null,
                array(
                    'label' => 'backend.admin.invoice.iva',
                    'editable' => false,
                )
            )
            ->add(
                'calculateIrpf',
                null,
                array(
                    'label' => 'backend.admin.invoice.irpf',
                    'editable' => false,
                )
            )
            ->add(
                'total',
                null,
                array(
                    'label' => 'backend.admin.invoice.total',
                    'editable' => false,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'show' => array('template' => '::Admin/Buttons/list__action_show_button.html.twig'),
                        'edit' => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'invoice' => array('template' => '::Admin/Buttons/list__action_invoice_pdf_button.html.twig'),
                        'pdf' => array('template' => '::Admin/Buttons/list__action_pdf_button.html.twig'),
                        'send' => array('template' => '::Admin/Buttons/list__action_send_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    ),
                    'label' => 'backend.admin.actions',
                )
            )
        ;
    }
}

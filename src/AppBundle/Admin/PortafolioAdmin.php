<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class PortafolioAdmin
 *
 * @category Admin
 * @package AppBundle\Admin
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class PortafolioAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Portafolio';
    protected $baseRoutePattern = 'activitats/activitat';
    protected $datagridValues = array(
        '_sort_by'    => 'date',
        '_sort_order' => 'desc',
    );

    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('show')
            ->remove('batch');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Proyectos', $this->getFormMdSuccessBoxArray(8))
            ->add(
                'title',
                null,
                array(
                    'label' => 'backend.admin.portafolio.project',
                )
            )
            ->add(
                'description',
                'ckeditor',
                array(
                    'label'       => 'backend.admin.portafolio.description',
                    'config_name' => 'my_config',
                    'required'    => true,
                )
            )
            ->add(
                'imageFile',
                'file',
                array(
                    'label'    => 'backend.admin.portafolio.image',
                    'help'     => $this->getImageHelperFormMapperWithThumbnail(),
                    'required' => false,
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(4))
            ->add(
                'type',
                null,
                array(
                    'label' => 'backend.admin.portafolio.category',
                )
            )
            ->add(
                'date',
                'sonata_type_date_picker',
                array(
                    'label'    => 'backend.admin.portafolio.date',
                    'format'   => 'd/M/y',
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
            ->end();
    }
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'date',
                'doctrine_orm_date',
                array(
                    'label'      => 'backend.admin.portafolio.date',
                    'field_type' => 'sonata_type_date_picker',
                    'format'     => 'd-m-Y',
                )
            )
            ->add(
                'title',
                null,
                array(
                    'label' => 'backend.admin.portafolio.project',
                )
            )
            ->add(
                'description',
                null,
                array(
                    'label' => 'backend.admin.portafolio.description',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'backend.admin.enabled',
                    'editable' => true,
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
                'image',
                null,
                array(
                    'label'    => 'backend.admin.portafolio.image',
                    'template' => '::Admin/Cells/list__cell_image_field.html.twig'
                )
            )
            ->add(
                'date',
                'date',
                array(
                    'label'    => 'backend.admin.portafolio.date',
                    'format'   => 'd/m/Y',
                    'editable' => true,
                )
            )
            ->add(
                'title',
                null,
                array(
                    'label' => 'backend.admin.portafolio.project',
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
                    'label'   => 'backend.admin.actions',
                    'actions' => array(
                        'edit'   => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    )
                )
            );
    }
}

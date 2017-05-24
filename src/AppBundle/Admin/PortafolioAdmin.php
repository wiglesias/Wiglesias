<?php

namespace AppBundle\Admin;

use AppBundle\Repository\PortfolioCategoryRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
    protected $baseRoutePattern = 'portafolios/portafolio';
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
            ->remove('batch');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', $this->getFormMdSuccessBoxArray(8))
            ->add(
                'title',
                null,
                array(
                    'label' => 'backend.admin.portafolio.project',
                )
            )
            ->add(
                'shortDescription',
                null,
                array(
                    'label' => 'Breve descripción',
                )
            )
            ->add(
                'description',
                CKEditorType::class,
                array(
                    'label'       => 'backend.admin.portafolio.description',
                    'config_name' => 'my_config',
                    'required'    => true,
                )
            )
            ->add(
                'imageFile',
                FileType::class,
                array(
                    'label'    => 'backend.admin.portafolio.image',
                    'help'     => $this->getImageHelperFormMapperWithThumbnail(),
                    'required' => false,
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(4))
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
                'categories',
                null,
                array(
                    'label' => 'Categoría',
                    'required' => true,
                    'query_builder' => function (PortfolioCategoryRepository $repository) {
                        return $repository->getAllSortedByTitleQB();
                    },
                )
            )
            ->add(
                'enabled',
                CheckboxType::class,
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
                'categories',
                null,
                array(
                    'label' => 'Categorías',
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
                'categories',
                null,
                array(
                    'label' => 'Categorías',
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
                        'show'   => array('template' => '::Admin/Buttons/list__action_show_button.html.twig'),
                        'edit'   => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    ),
                    'label'   => 'backend.admin.actions',
                )
            );
    }
}

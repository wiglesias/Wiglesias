<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

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

//    /**
//     * @param FormMapper $formMapper
//     */
//    protected function configureFormFields(FormMapper $formMapper)
//    {
//        $formMapper
//            ->with('backend.admin.post.post', $this->getFormMdSuccessBoxArray(6))
//            ->add(
//                'publishedAt',
//                'sonata_type_date_picker',
//                array(
//                    'label' => 'backend.admin.published_date',
//                )
//            )
//            ->add(
//                'imageFile',
//                'file',
//                array(
//                    'label'    => 'backend.admin.post.image',
//                    'help'     => $this->getImageHelperFormMapperWithThumbnail(),
//                    'required' => false,
//                )
//            )
//            ->add(
//                'author',
//                null,
//                array(
//                    'label' => 'backend.admin.post.author',
//                )
//            )
//            ->end()
//            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
//            ->add(
//                'tags',
//                null,
//                array(
//                    'label' => 'backend.admin.post.tags',
//                    'query_builder' => function (TagRepository $repository) {
//                        return $repository->getAllSortedByTitleQB();
//                    },
//                )
//            )
//            ->add(
//                'metaKeywords',
//                null,
//                array(
//                    'label' => 'backend.admin.post.metakeywords',
//                    'help'  => 'backend.admin.post.metakeywordshelp',
//                )
//            )
//            ->add(
//                'metaDescription',
//                null,
//                array(
//                    'label' => 'backend.admin.post.metadescription',
//                )
//            )
//            ->add(
//                'enabled',
//                'checkbox',
//                array(
//                    'label'    => 'backend.admin.enabled',
//                    'required' => false,
//                )
//            )
//            ->end()
//            ->with('backend.admin.post.content', $this->getFormMdSuccessBoxArray(12))
//            ->add(
//                'title',
//                null,
//                array(
//                    'label' => 'backend.admin.post.title',
//                )
//            )
//            ->add(
//                'shortDescription',
//                null,
//                array(
//                    'label' => 'backend.admin.post.shortdescription',
//                )
//            )
//            ->add(
//                'description',
//                CKEditorType::class,
//                array(
//                    'label'       => 'backend.admin.post.description',
//                    'config_name' => 'my_config',
//                    'required'    => true,
//                )
//            )
//            ->end();
//    }

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

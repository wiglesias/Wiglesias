<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ContactMessageAnswerType
 *
 * @category FormType
 * @package AppBundle\Form\Type
 * @author Wils Iglesias <wiglesias83@gamil.com>
 */
class ContactMessageAnswerType extends ContactMessageType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'description',
                TextareaType::class,
                array(
                    'label'    => 'backend.admin.contact.answer',
                    'required' => true,
                    'attr'     => array(
                        'rows' => 6,
                    ),
                )
            )
            ->add(
                'send',
                SubmitType::class,
                array(
                    'label'    => 'backend.admin.submit',
                    'attr'  => array(
                        'class' => 'btn btn-lg btn-dark',
                    ),
                )
            );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact_message_answer';
    }
}

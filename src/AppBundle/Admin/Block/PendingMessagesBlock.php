<?php

namespace AppBundle\Admin\Block;

use Doctrine\ORM\EntityManager;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PendingMessagesBlock.
 *
 * @category Block
 *
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class PendingMessagesBlock extends AbstractBlockService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * Constructor.
     *
     * @param null|string     $name
     * @param EngineInterface $templating
     * @param EntityManager   $em
     * @param Translator      $translator
     */
    public function __construct($name, EngineInterface $templating, EntityManager $em, Translator $translator)
    {
        parent::__construct($name, $templating);
        $this->em = $em;
        $this->translator = $translator;
    }

    /**
     * @param BlockContextInterface $blockContext
     * @param Response|null         $response
     *
     * @return Response
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        // merge settings
        $settings = $blockContext->getSettings();

        $pendingMessagesAmount = $this->em->getRepository('AppBundle:ContactMessage')->getPendingMessagesAmount();

        $backgroundColor = 'bg-green';
        $content = '<h3><i class="fa fa-check-circle-o" aria-hidden="true"></i></h3><p>'.$this->translator->trans('backend.admin.contact.text_1').'</p>';

        if ($pendingMessagesAmount > 0) {
            $backgroundColor = 'bg-red';
            if ($pendingMessagesAmount == 1) {
                $content = '<h3>'.$pendingMessagesAmount.'</h3><p>'.$this->translator->trans('backend.admin.contact.text_2').'</p>';
            } else {
                $content = '<h3>'.$pendingMessagesAmount.'</h3><p>'.$this->translator->trans('backend.admin.contact.text_3').'</p>';
            }
        }

        return $this->renderResponse(
            $blockContext->getTemplate(),
            array(
                'block' => $blockContext->getBlock(),
                'settings' => $settings,
                'title' => 'Notificacions',
                'background' => $backgroundColor,
                'content' => $content,
            ),
            $response
        );
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return 'pending_messages';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'title' => 'Resum',
            'content' => 'Default content',
            'template' => ':Admin/Blocks:contact_message.html.twig',
        ));
    }
}

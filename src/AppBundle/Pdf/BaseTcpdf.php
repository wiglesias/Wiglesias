<?php

namespace AppBundle\Pdf;

use Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

/**
 * Class BaseTcpdf.
 *
 * @category Pdf
 *
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class BaseTcpdf extends \TCPDF
{
    const PDF_WIDTH = 210;
    const PDF_MARGIN_LEFT = 15;
    const PDF_MARGIN_RIGHT = 15;
    const PDF_MARGIN_TOP = 20;
    const PDF_MARGIN_BOTTOM = 20;
    const MARGIN_VERTICAL_SMALL = 3;
    const MARGIN_VERTICAL_BIG = 8;

    /**
     * @var AssetsHelper
     */
    private $ahs;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * BaseTcpdf constructor.
     *
     * @param AssetsHelper $ahs
     * @param Translator   $translator
     *
     * @internal param Translator $ts
     */
    public function __construct(AssetsHelper $ahs, Translator $translator)
    {
        parent::__construct();
        $this->ahs = $ahs;
        $this->translator = $translator;
    }

    /**
     * Page header.
     */
//    public function header()
//    {
//        // logo
//        $this->Image($this->ahs->getUrl('/bundles/app/img/logo-pdf.png'), 75, 20, 60);
//        $this->SetXY(self::PDF_MARGIN_LEFT, 11);
//        $this->setFontStyle(null, 'I', 8);
//    }

    /**
     * Page footer.
     */
    public function footer()
    {
        $this->SetXY(self::PDF_MARGIN_LEFT, 280);
        $this->setFontStyle(null, 'I',  8);
        $this->Cell(0,0, 'anything', 0, 0, 'T', 0, 'C');
    }

    /**
     * @param string $font
     * @param string $style
     * @param int    $size
     */
    public function setFontStyle($font = 'dejavusans', $style = '', $size = 12)
    {
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $this->SetFont($font, $style, $size, '', true);
    }
}

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
    const PDF_MARGIN_TOP = 55;
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
    public function header()
    {
        $styleWhite = array('width' => 0, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255));

        // logo
//        $this->Image($this->ahs->getUrl('/bundles/app/img/logo-pdf.png'), 75, 20, 60);
        $this->SetXY(self::PDF_MARGIN_LEFT, 20);
        $this->SetFillColor(3, 169, 244);
        $this->SetTextColor(255, 255, 255);
        $this->setFontStyle(null, 'B', 18);
        $this->setCellMargins(0, 0, 0, 0);
        $this->setCellPaddings(0, 3, 0, 3);
        $this->MultiCell(180, 0, 'IT CONSULTANT', 0, 'C', true, 1, '', '', true, 0, true, true, 0, 'T', false);
        $this->Line(94, 32, 114, 32, $styleWhite);
        $this->setFontStyle(null, '', 12);
        $this->SetTextColor(0, 0, 0);
        $this->setCellPaddings(0, 0, 0, 3);
        $this->MultiCell(180, 0, 'Software Developer', 0, 'C', true, 1, '', '', true, 0, true, true, 0, 'T', false);
        $this->SetXY(self::PDF_MARGIN_LEFT, 55);
        $this->setFontStyle(null, 'I', 8);
    }

    /**
     * Page footer.
     */
    public function footer()
    {
        $this->SetXY(self::PDF_MARGIN_LEFT, 280);
        $this->setFontStyle(null, 'I', 8);
        $this->Cell(0, 0, 'website: www.wiglesias.com, email: info@gmail.com', 0, 0, 'C', 0, 'C');
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

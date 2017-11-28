<?php

namespace AppBundle\Service;

use AppBundle\Entity\Invoice;
use AppBundle\Pdf\BaseTcpdf;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper;

/**
 * Class InvoicePdfBuilderService
 *
 * @category Service
 * @package  AppBundle\Service
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class InvoicePdfBuilderService
{
    /**
     * @var TCPDFController
     */
    private $tcpdf;

    /**
     * @var AssetsHelper
     */
    private $tha;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var string public web title
     */
    private $pwt;

    /**
     * InvoicePdfBuilderService constructor.
     *
     * @param TCPDFController $tcpdf
     * @param AssetsHelper    $tha
     * @param Translator      $translator
     * @param string          $pwt
     */
    public function __construct(TCPDFController $tcpdf, AssetsHelper $tha, Translator $translator, $pwt)
    {
        $this->tcpdf = $tcpdf;
        $this->tha = $tha;
        $this->translator = $translator;
        $this->pwt = $pwt;
    }

    /**
     * @param Invoice $invoice
     *
     * @return \TCPDF
     */
    public function build(Invoice $invoice)
    {
        /** @var BaseTcpdf $pdf */
        $pdf = $this->tcpdf->create($this->tha, $this->translator);

        $maxCellWidth = BaseTcpdf::PDF_WIDTH - BaseTcpdf::PDF_MARGIN_LEFT - BaseTcpdf::PDF_MARGIN_RIGHT;

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($this->pwt);
        $pdf->SetTitle($this->translator->trans('backend.admin.invoice.invoice'));
        $pdf->SetSubject($this->translator->trans('backend.admin.invoice.description'));
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        // remove default header/footer
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(BaseTcpdf::PDF_MARGIN_LEFT, BaseTcpdf::PDF_MARGIN_TOP, BaseTcpdf::PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(true, BaseTcpdf::PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // Add start page
        $pdf->AddPage(PDF_PAGE_ORIENTATION, PDF_PAGE_FORMAT, true, true);
        $pdf->setPrintFooter(true);

        $pdf->SetXY(BaseTcpdf::PDF_MARGIN_LEFT, BaseTcpdf::PDF_MARGIN_TOP);
        $pdf->setFontStyle(null, '', 11);
        // contact
        $pdf->Write(0, 'FACTURA '.$invoice->getInvoiceNumber(), '', false, 'L', true);
        $pdf->Write(0, $invoice->getDate()->format('d/m/Y'), '', false, 'L', true);
        $pdf->Ln(BaseTcpdf::MARGIN_VERTICAL_SMALL);
        $pdf->Write(0,$invoice->getCustomer()->getName(), '', false, 'L', true);
        $pdf->Write(0, $invoice->getCustomer()->getIdentityCard(), '', false, 'L', true);
        $pdf->Write(0, $invoice->getCustomer()->getAddress(), '', false, 'L', true);
        $pdf->Write(0, $invoice->getCustomer()->getCity(), '', false, 'L', true);
        $pdf->Ln(BaseTcpdf::MARGIN_VERTICAL_SMALL);
        // description
        $pdf->Ln(BaseTcpdf::MARGIN_VERTICAL_BIG);
//        $pdf->setCellPaddings(2, 1, 0, 0);
//        $pdf->setCellMargins(1, 0, 1, 0);

        $pdf->MultiCell(100, 7, 'CONCEPTO', 0, 'L', false, 0, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(25, 7, 'CANTIDAD', 0, 'C', false, 0, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(25, 7, 'PRECIO', 0, 'C', false, 0, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(30, 7, 'TOTAL', 0, 'C', false, 0, '', '', true, 0, true, true, 0, 'T', false);


//        $pdf->MultiCell(100, 7, 'CONCEPTO', 1, 'L', false, 1, '', '', true, 0, true, true, 0, 'T', false);
//        $pdf->setCellMargins(1, 0, 0, 0);

        return $pdf;
    }
}

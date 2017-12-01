<?php

namespace AppBundle\Service;

use AppBundle\Entity\Invoice;
use AppBundle\Entity\InvoiceLine;
use AppBundle\Entity\Setting;
use AppBundle\Pdf\BaseTcpdf;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper;

/**
 * Class InvoicePdfBuilderService.
 *
 * @category Service
 *
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
     * @param Setting $setting
     *
     * @return \TCPDF
     */
    public function build(Invoice $invoice, Setting $setting)
    {
        /** @var BaseTcpdf $pdf */
        $pdf = $this->tcpdf->create($this->tha, $this->translator);

//        $maxCellWidth = BaseTcpdf::PDF_WIDTH - BaseTcpdf::PDF_MARGIN_LEFT - BaseTcpdf::PDF_MARGIN_RIGHT;

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
        // contact
        $pdf->setFontStyle(null, '', 12);
        $pdf->Write(0, 'FACTURA '.$invoice->getInvoiceNumber(), '', false, 'L', true);
        $pdf->Write(0, 'Fecha: ', '', false, 'L', false);
        $pdf->setFontStyle(null, 'B', 11);
        $pdf->Write(0, $invoice->getDate()->format('d/m/Y'), '', false, 'L', true);
        $pdf->Ln(BaseTcpdf::MARGIN_VERTICAL_SMALL);

        $y = $pdf->GetY();

        $pdf->Write(0, $setting->getFullName(), '', false, 'L', true);
        $pdf->setFontStyle(null, '', 11);
        $pdf->Write(0, $setting->getIdentityCard(), '', false, 'L', true);
        $pdf->Write(0, $setting->getAddress(), '', false, 'L', true);
        $pdf->Write(0, $setting->getCity().' ('.$setting->getCity()->getProvince()->getName().')', '', false, 'L', true);
        $pdf->Write(0, $setting->getMobile().' - '.$setting->getEmail(), '', false, 'L', true);

        $pdf->SetY($y);
        $pdf->SetX(125);

        $pdf->setFontStyle(null, 'B', 11);
        $pdf->Write(0, $invoice->getCustomer()->getName(), '', false, 'L', true);
        $pdf->setFontStyle(null, '', 11);
        $pdf->SetX(125);
        $pdf->Write(0, $invoice->getCustomer()->getIdentityCard(), '', false, 'L', true);
        $pdf->SetX(125);
        $pdf->Write(0, $invoice->getCustomer()->getAddress(), '', false, 'L', true);
        $pdf->SetX(125);
        $pdf->Write(0, $invoice->getCustomer()->getCity(), '', false, 'L', true);

        // table
        $pdf->Ln(BaseTcpdf::MARGIN_VERTICAL_BIG);
        $pdf->setCellPaddings(2, 1, 0, 0);
        // table header
        $pdf->SetFillColor(3, 169, 244);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->MultiCell(100, 7, 'CONCEPTO', 0, 'L', true, 0, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(25, 7, 'CANTIDAD', 0, 'R', true, 0, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(25, 7, 'PRECIO', 0, 'R', true, 0, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(30, 7, 'TOTAL', 0, 'R', true, 1, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->SetTextColor(0, 0, 0);

        // table body
        $pdf->setFontStyle(null, '', 10);
        $pdf->setCellMargins(0, 0, 0, 2);
        $pdf->setCellPaddings(1, 2, 1, 2);
        /** @var InvoiceLine $line */
        foreach ($invoice->getLines() as $line) {
            $pdf->MultiCell(100, 8, $line->getName(), 1, 'L', false, 0, '', '', true, 0, true, true, 0, 'T', false);
            $pdf->MultiCell(25, 8, $line->getAmount(), 1, 'R', false, 0, '', '', true, 0, true, true, 0, 'T', false);
            $pdf->MultiCell(25, 8, number_format($line->getPrice(), 2, ',', '.').' €', 1, 'R', false, 0, '', '', true, 0, true, true, 0, 'T', false);
            $pdf->MultiCell(30, 8, number_format($line->getTotal(), 2, ',', '.').' €', 1, 'R', false, 1, '', '', true, 0, true, true, 0, 'T', false);
        }
        $pdf->setCellMargins(1, 0, 1, 0);
        $pdf->setCellPaddings(0, 0, 0, 0);

        // table footer
        $pdf->Ln(BaseTcpdf::MARGIN_VERTICAL_BIG);

//        $xc=100;
//        $yc=100;
//        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(3, 169, 244));
//
//        $pdf->Line($xc-85, $yc, $xc+95, $yc, $style);
//
//        $fy = $pdf->GetY();
//        $pdf->SetY($fy);

//        $pdf->SetX(120);
        $pdf->setFontStyle(null, 'B', 11);
        $pdf->Write(0, 'Base imponible', '', false, 'L', true);
        $pdf->setFontStyle(null, 'B', 11);
//        $pdf->SetX(120);
        $pdf->Write(0, 'IVA '.$invoice->getIva().' %', '', false, 'L', true);
        $pdf->setFontStyle(null, 'B', 11);
//        $pdf->SetX(120);
        $pdf->Write(0, 'IRPF '.$invoice->getIrpf().' %', '', false, 'L', true);
        $pdf->setFontStyle(null, 'B', 11);
//        $pdf->SetX(120);
        $pdf->Write(0, 'Total', '', false, 'L', true);
//        $pdf->SetY($fy);
//        $pdf->SetX(170);
        $pdf->Write(0, number_format($invoice->getTaxableBase(), 2, ',', '.').' €', '', false, 'R', true);
        $pdf->SetX(170);
        $pdf->Write(0, number_format($invoice->getCalculateIva(), 2, ',', '.').' €', '', false, 'R', true);
        $pdf->SetX(170);
        $pdf->Write(0, number_format($invoice->getCalculateIrpf(), 2, ',', '.').' €', '', false, 'R', true);

        $pdf->Write(0, number_format($invoice->getTotal(), 2, ',', '.').' €', '', false, 'R', true);

//        $xc=100;
//        $yc=100;
//        $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(3, 169, 244));
//        $pdf->SetXY(BaseTcpdf::PDF_MARGIN_LEFT, 170);
//        $pdf->Line($xc-85, $yc, $xc+95, $yc, $style);

        return $pdf;
    }
}

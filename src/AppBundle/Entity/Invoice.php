<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Invoice
 *
 * @category Entity
 * @package AppBundle\Entity
 * @author Wils Iglesias <wiglesias83@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="invoice")
 */
class Invoice extends AbstractBase
{
    const DEFAULT_IVA = 21;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer", inversedBy="invoices")
     */
    private $customer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=21})
     */
    private $iva = self::DEFAULT_IVA;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $irpf;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\InvoiceLine", mappedBy="invoice", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $lines;

    /**
     *
     * Methods
     *
     */

    /**
     * Invoice constructor.
     */
    public function __construct()
    {
        $this->lines = new ArrayCollection();
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     *
     * @return Invoice
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return  $this->getCreatedAt()->format('Y') . '-' . $this->getId();
    }

    /**
     * @param \DateTime $date
     *
     * @return Invoice
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return int
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * @param int $iva
     *
     * @return Invoice
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * @return int
     */
    public function getIrpf()
    {
        return $this->irpf;
    }

    /**
     * @param int $irpf
     *
     * @return Invoice
     */
    public function setIrpf($irpf)
    {
        $this->irpf = $irpf;

        return $this;
    }

    /**
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * @param array $lines
     *
     * @return Invoice
     */
    public function setLines($lines)
    {
        $this->lines = $lines;

        return $this;
    }

    /**
     * @param InvoiceLine $line
     *
     * @return $this
     */
    public function addLine(InvoiceLine $line)
    {
        if (!$this->lines->contains($line)) {
            $this->lines->add($line);
            $line->setInvoice($this);
        }

        return $this;
    }

    /**
     * @param InvoiceLine $line
     *
     * @return $this
     */
    public function removeLine(InvoiceLine $line)
    {
        if ($this->lines->contains($line)) {
            $this->lines->removeElement($line);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getTaxableBase()
    {
        $total = 0;
        /** @var InvoiceLine $line */
        foreach ($this->getLines() as $line) {
            $total = $total + $line->getTotal();
        }

        return $total;
    }

    /**
     * @return float|int
     */
    public function getCalculateIva()
    {
        return $this->getTaxableBase() * ($this->iva / 100);
    }

    /**
     * @return float|int
     */
    public function getCalculateIrpf()
    {
        return $this->getTaxableBase() * ($this->irpf / 100);
    }

    /**
     * @return int|float
     */
    public function getTotal()
    {
        return $this->getTaxableBase() + $this->getCalculateIva() - $this->getCalculateIrpf();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id ? $this->getDate()->format('d/m/Y'): '---';
    }
}

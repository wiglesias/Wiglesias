<?php

namespace AppBundle\Entity;

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
     * @ORM\Column(type="integer")
     */
    private $iva;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $irpf;

    /**
     *
     * Methods
     *
     */

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
     * @return string
     */
    public function __toString()
    {
        return $this->id ? $this->getDate()->format('d/m/Y'): '---';
    }
}

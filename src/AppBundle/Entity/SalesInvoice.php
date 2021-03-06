<?php

/**
 * This file is part of The OBMS project: https://github.com/obms/obms
 *
 * Copyright (c) Jaime Niñoles-Manzanera Jimeno.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SalesInvoice
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SalesInvoiceRepository")
 */
class SalesInvoice
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="SalesBudget", mappedBy="salesInvoice")
     */
    private $salesBudget;

    /**
     * @ORM\OneToOne(targetEntity="SalesAmendmentInvoice", inversedBy="salesInvoice")
     */
    private $salesAmendmentInvoice;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return SalesInvoice
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return SalesInvoice
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set salesBudget
     *
     * @param \AppBundle\Entity\SalesBudget $salesBudget
     * @return SalesInvoice
     */
    public function setSalesBudget(\AppBundle\Entity\SalesBudget $salesBudget = null)
    {
        $this->salesBudget = $salesBudget;

        return $this;
    }

    /**
     * Get salesBudget
     *
     * @return \AppBundle\Entity\SalesBudget 
     */
    public function getSalesBudget()
    {
        return $this->salesBudget;
    }

    /**
     * Set salesAmendmentInvoice
     *
     * @param \AppBundle\Entity\SalesAmendmentInvoice $salesAmendmentInvoice
     * @return SalesInvoice
     */
    public function setSalesAmendmentInvoice(\AppBundle\Entity\SalesAmendmentInvoice $salesAmendmentInvoice = null)
    {
        $this->salesAmendmentInvoice = $salesAmendmentInvoice;

        return $this;
    }

    /**
     * Get salesAmendmentInvoice
     *
     * @return \AppBundle\Entity\SalesAmendmentInvoice 
     */
    public function getSalesAmendmentInvoice()
    {
        return $this->salesAmendmentInvoice;
    }
}

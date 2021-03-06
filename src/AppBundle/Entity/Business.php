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
 * Business.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BusinessRepository")
 */
class Business
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=255)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="cifnif", type="string", length=255)
     */
    private $cifnif;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @ORM\ManyToMany(targetEntity="AdministrationBundle\Entity\User", inversedBy="businesses", cascade={"persist"})
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="AdministrationBundle\Entity\User", mappedBy="currentBusiness")
     */
    private $usersCurrentBusiness;

    /**
     * @ORM\OneToMany(targetEntity="Third", mappedBy="business", cascade="remove")
     */
    private $thirds;

    /**
     * @ORM\OneToMany(targetEntity="ThirdType", mappedBy="business", cascade="remove")
     */
    private $thirdtypes;

    /**
     * @ORM\OneToMany(targetEntity="Worker", mappedBy="business", cascade="remove")
     */
    private $workers;

    /**
     * @ORM\OneToMany(targetEntity="SalesNote", mappedBy="business", cascade="remove")
     */
    private $salesNotes;

    /**
     * @ORM\OneToMany(targetEntity="SalesOrder", mappedBy="business", cascade="remove")
     */
    private $salesOrders;

    /**
     * @ORM\OneToMany(targetEntity="SalesBudget", mappedBy="business", cascade="remove")
     */
    private $salesBudgets;

    /**
     * @ORM\OneToMany(targetEntity="SalesAmendmentInvoice", mappedBy="business", cascade="remove")
     */
    private $salesAmendmentInvoices;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fullname.
     *
     * @param string $fullname
     *
     * @return Business
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname.
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set cifnif.
     *
     * @param string $cifnif
     *
     * @return Business
     */
    public function setCifnif($cifnif)
    {
        $this->cifnif = $cifnif;

        return $this;
    }

    /**
     * Get cifnif.
     *
     * @return string
     */
    public function getCifnif()
    {
        return $this->cifnif;
    }

    /**
     * Set address.
     *
     * @param string $address
     *
     * @return Business
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * String operator.
     */
    public function __toString()
    {
        return $this->fullname;
    }

    /**
     * Add users.
     *
     * @param \AdministrationBundle\Entity\User $users
     *
     * @return Business
     */
    public function addUser(\AdministrationBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove users.
     *
     * @param \AdministrationBundle\Entity\User $users
     */
    public function removeUser(\AdministrationBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add usersCurrentBusiness.
     *
     * @param \AdministrationBundle\Entity\User $usersCurrentBusiness
     *
     * @return Business
     */
    public function addUsersCurrentBusiness(\AdministrationBundle\Entity\User $usersCurrentBusiness)
    {
        $this->usersCurrentBusiness[] = $usersCurrentBusiness;

        return $this;
    }

    /**
     * Remove usersCurrentBusiness.
     *
     * @param \AdministrationBundle\Entity\User $usersCurrentBusiness
     */
    public function removeUsersCurrentBusiness(\AdministrationBundle\Entity\User $usersCurrentBusiness)
    {
        $this->usersCurrentBusiness->removeElement($usersCurrentBusiness);
    }

    /**
     * Get usersCurrentBusiness.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersCurrentBusiness()
    {
        return $this->usersCurrentBusiness;
    }

    /**
     * Add thirds.
     *
     * @param \AppBundle\Entity\Third $thirds
     *
     * @return Business
     */
    public function addThird(\AppBundle\Entity\Third $thirds)
    {
        $this->thirds[] = $thirds;

        return $this;
    }

    /**
     * Remove thirds.
     *
     * @param \AppBundle\Entity\Third $thirds
     */
    public function removeThird(\AppBundle\Entity\Third $thirds)
    {
        $this->thirds->removeElement($thirds);
    }

    /**
     * Get thirds.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThirds()
    {
        return $this->thirds;
    }

    /**
     * Add thirdtypes.
     *
     * @param \AppBundle\Entity\ThirdType $thirdtypes
     *
     * @return Business
     */
    public function addThirdtype(\AppBundle\Entity\ThirdType $thirdtypes)
    {
        $this->thirdtypes[] = $thirdtypes;

        return $this;
    }

    /**
     * Remove thirdtypes.
     *
     * @param \AppBundle\Entity\ThirdType $thirdtypes
     */
    public function removeThirdtype(\AppBundle\Entity\ThirdType $thirdtypes)
    {
        $this->thirdtypes->removeElement($thirdtypes);
    }

    /**
     * Get thirdtypes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThirdtypes()
    {
        return $this->thirdtypes;
    }

    /**
     * Add workers.
     *
     * @param \AppBundle\Entity\Worker $workers
     *
     * @return Business
     */
    public function addWorker(\AppBundle\Entity\Worker $workers)
    {
        $this->workers[] = $workers;

        return $this;
    }

    /**
     * Remove workers.
     *
     * @param \AppBundle\Entity\Worker $workers
     */
    public function removeWorker(\AppBundle\Entity\Worker $workers)
    {
        $this->workers->removeElement($workers);
    }

    /**
     * Get workers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkers()
    {
        return $this->workers;
    }

    /**
     * Add workerDowns.
     *
     * @param \AppBundle\Entity\WorkerDown $workerDowns
     *
     * @return Business
     */
    public function addWorkerDown(\AppBundle\Entity\WorkerDown $workerDowns)
    {
        $this->workerDowns[] = $workerDowns;

        return $this;
    }

    /**
     * Remove workerDowns.
     *
     * @param \AppBundle\Entity\WorkerDown $workerDowns
     */
    public function removeWorkerDown(\AppBundle\Entity\WorkerDown $workerDowns)
    {
        $this->workerDowns->removeElement($workerDowns);
    }

    /**
     * Get workerDowns.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkerDowns()
    {
        return $this->workerDowns;
    }

    /**
     * Add workerHollidays.
     *
     * @param \AppBundle\Entity\WorkerHolliday $workerHollidays
     *
     * @return Business
     */
    public function addWorkerHolliday(\AppBundle\Entity\WorkerHolliday $workerHollidays)
    {
        $this->workerHollidays[] = $workerHollidays;

        return $this;
    }

    /**
     * Remove workerHollidays.
     *
     * @param \AppBundle\Entity\WorkerHolliday $workerHollidays
     */
    public function removeWorkerHolliday(\AppBundle\Entity\WorkerHolliday $workerHollidays)
    {
        $this->workerHollidays->removeElement($workerHollidays);
    }

    /**
     * Get workerHollidays.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkerHollidays()
    {
        return $this->workerHollidays;
    }

    /**
     * Add workerPayrolls.
     *
     * @param \AppBundle\Entity\WorkerPayroll $workerPayrolls
     *
     * @return Business
     */
    public function addWorkerPayroll(\AppBundle\Entity\WorkerPayroll $workerPayrolls)
    {
        $this->workerPayrolls[] = $workerPayrolls;

        return $this;
    }

    /**
     * Remove workerPayrolls.
     *
     * @param \AppBundle\Entity\WorkerPayroll $workerPayrolls
     */
    public function removeWorkerPayroll(\AppBundle\Entity\WorkerPayroll $workerPayrolls)
    {
        $this->workerPayrolls->removeElement($workerPayrolls);
    }

    /**
     * Get workerPayrolls.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkerPayrolls()
    {
        return $this->workerPayrolls;
    }

    /**
     * Add salesNotes
     *
     * @param \AppBundle\Entity\SalesNote $salesNotes
     * @return Business
     */
    public function addSalesNote(\AppBundle\Entity\SalesNote $salesNotes)
    {
        $this->salesNotes[] = $salesNotes;

        return $this;
    }

    /**
     * Remove salesNotes
     *
     * @param \AppBundle\Entity\SalesNote $salesNotes
     */
    public function removeSalesNote(\AppBundle\Entity\SalesNote $salesNotes)
    {
        $this->salesNotes->removeElement($salesNotes);
    }

    /**
     * Get salesNotes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalesNotes()
    {
        return $this->salesNotes;
    }

    /**
     * Add salesOrders
     *
     * @param \AppBundle\Entity\SalesOrder $salesOrders
     * @return Business
     */
    public function addSalesOrder(\AppBundle\Entity\SalesOrder $salesOrders)
    {
        $this->salesOrders[] = $salesOrders;

        return $this;
    }

    /**
     * Remove salesOrders
     *
     * @param \AppBundle\Entity\SalesOrder $salesOrders
     */
    public function removeSalesOrder(\AppBundle\Entity\SalesOrder $salesOrders)
    {
        $this->salesOrders->removeElement($salesOrders);
    }

    /**
     * Get salesOrders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalesOrders()
    {
        return $this->salesOrders;
    }

    /**
     * Add salesBudgets
     *
     * @param \AppBundle\Entity\SalesBudget $salesBudgets
     * @return Business
     */
    public function addSalesBudget(\AppBundle\Entity\SalesBudget $salesBudgets)
    {
        $this->salesBudgets[] = $salesBudgets;

        return $this;
    }

    /**
     * Remove salesBudgets
     *
     * @param \AppBundle\Entity\SalesBudget $salesBudgets
     */
    public function removeSalesBudget(\AppBundle\Entity\SalesBudget $salesBudgets)
    {
        $this->salesBudgets->removeElement($salesBudgets);
    }

    /**
     * Get salesBudgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalesBudgets()
    {
        return $this->salesBudgets;
    }

    /**
     * Add salesAmendmentInvoices
     *
     * @param \AppBundle\Entity\SalesAmendmentInvoice $salesAmendmentInvoices
     * @return Business
     */
    public function addSalesAmendmentInvoice(\AppBundle\Entity\SalesAmendmentInvoice $salesAmendmentInvoices)
    {
        $this->salesAmendmentInvoices[] = $salesAmendmentInvoices;

        return $this;
    }

    /**
     * Remove salesAmendmentInvoices
     *
     * @param \AppBundle\Entity\SalesAmendmentInvoice $salesAmendmentInvoices
     */
    public function removeSalesAmendmentInvoice(\AppBundle\Entity\SalesAmendmentInvoice $salesAmendmentInvoices)
    {
        $this->salesAmendmentInvoices->removeElement($salesAmendmentInvoices);
    }

    /**
     * Get salesAmendmentInvoices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalesAmendmentInvoices()
    {
        return $this->salesAmendmentInvoices;
    }
}

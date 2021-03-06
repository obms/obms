<?php

/**
 * This file is part of The OBMS project: https://github.com/obms/obms.
 *
 * Copyright (c) Jaime Niñoles-Manzanera Jimeno.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdministrationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use AdministrationBundle\Entity\Administrator;
use AdministrationBundle\Entity\User;
use AppBundle\Entity\ThirdType;
use AppBundle\Entity\Third;
use AppBundle\Entity\Business;
use AppBundle\Entity\Worker;
use AppBundle\Entity\WorkerPayroll;
use AppBundle\Entity\WorkerHolliday;
use AppBundle\Entity\WorkerDown;
use AppBundle\Entity\SalesNote;
use AppBundle\Entity\SalesNoteDetail;
use AppBundle\Entity\SalesOrder;
use AppBundle\Entity\SalesOrderDetail;
use AppBundle\Entity\SalesBudget;
use AppBundle\Entity\SalesBudgetDetail;
use AppBundle\Entity\SalesPreinvoice;
use AppBundle\Entity\SalesInvoice;
use AppBundle\Entity\SalesAmendmentInvoice;
use AppBundle\Entity\SalesAmendmentInvoiceDetail;

class SampleDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('sample:data')
            ->setDescription('Load sample data for local developement.')
            ->addArgument('argument', InputArgument::OPTIONAL, '¿Only delete ([delete])?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        $loremipsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in tempor risus. '
        .'Morbi urna purus, consectetur in varius a, volutpat vel massa. Curabitur sit amet nibh porttitor, '
        .'ornare nulla at, faucibus sem. In mollis semper massa, non tempor leo tristique in. Donec commodo '
        .'justo scelerisque, elementum lectus gravida, aliquet neque. Morbi at mi tellus. Suspendisse '
        .'elementum, felis a aliquet vehicula, nibh tellus ultricies dui, ac sagittis dui dui vel ante. '
        .'Mauris eu accumsan velit. Aenean at ultricies massa, a dignissim dui. Suspendisse ut lectus '
        .'fermentum, interdum lectus non, bibendum turpis.';
        $loremipsum .= 'Phasellus suscipit blandit mauris in ultrices. Sed est ipsum, aliquam a ultrices ut, '
        .'finibus vel nisi. Nulla imperdiet quam vel magna consectetur, nec pharetra metus cursus. Suspendisse '
        .'mollis id ligula scelerisque hendrerit. Nunc dignissim eleifend mollis. Maecenas sed pulvinar neque. '
        .'Suspendisse sed mauris dictum, ultricies justo nec, lobortis risus. Nam tellus massa, varius '
        .'fringilla iaculis ac, mattis vitae est. Duis dictum mauris non nisl tristique aliquet.';
        $loremipsum .= 'Aenean at mattis urna, eu lacinia velit. Maecenas malesuada eget tortor sed feugiat. '
        .'Vestibulum at diam orci. Nulla sem ipsum, mattis a tellus eget, mollis tempus arcu. Duis viverra '
        .'augue eget nunc semper, sed viverra mauris elementum. Nullam et quam neque. Sed sodales porta eros '
        .'vitae eleifend.';
        $loremipsum .= 'Vivamus id tortor vitae nibh dictum volutpat. Integer auctor dolor sit amet hendrerit '
        .'tincidunt. Cras finibus congue urna lobortis rutrum. Ut feugiat elit ac diam efficitur, ac feugiat '
        .'tortor sollicitudin. Vestibulum in odio eget mi suscipit sollicitudin et bibendum urna. Nulla quis '
        .'ipsum maximus, vulputate magna eu, ultricies nibh. Nam blandit massa eget arcu mollis, vel congue '
        .'augue malesuada. Pellentesque sit amet elementum dolor, nec gravida sapien. Etiam egestas lorem quis '
        .'tellus vulputate placerat quis fringilla est. Donec eu lectus ac enim iaculis fermentum. Vestibulum '
        .'ante felis, commodo id ullamcorper pretium, pharetra tristique odio. Nulla facilisi. Pellentesque ut '
        .'nisi sollicitudin, convallis augue id, gravida risus. Quisque at convallis est. Donec ut urna '
        .'pulvinar, finibus tortor vel, aliquam eros. Suspendisse consectetur convallis enim, vel dapibus '
        .'lacus congue vel.';
        $loremipsum .= 'Integer volutpat turpis sed leo accumsan tempor. Integer eget venenatis purus. Nunc '
        .'malesuada pulvinar semper. Proin eu nibh ligula. Proin lorem nulla, eleifend ut leo a, aliquam cursus '
        .'orci. Nam est dui, rutrum sit amet nisl nec, fringilla rhoncus turpis. Cras porta fermentum ornare. '
        .'Proin non porttitor nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per '
        .'inceptos himenaeos. Ut nec lacus semper, sagittis sapien ac, consequat sem.';

        $loremipsumshort = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in tempor risus. '
        .'Morbi urna purus, consectetur in varius a, volutpat vel massa. Curabitur sit amet nibh porttitor, '
        .'ornare nulla at, faucibus sem. In mollis semper massa, non tempor leo tristique in. Donec commodo '
        .'justo scelerisque, elementum lectus gravida, aliquet neque. Morbi at mi tellus. Suspendisse elementum, '
        .'felis a aliquet vehicula, nibh tellus ultricies dui, ac sagittis dui dui vel ante. Mauris eu accumsan '
        .'velit. Aenean at ultricies massa, a dignissim dui. Suspendisse ut lectus fermentum, interdum lectus '
        .'non, bibendum turpis.';

        $manager = $this->getContainer()->get('doctrine')->getManager();

        $factory = $this->getContainer()->get('security.encoder_factory');

        if ($argument == 'delete') {
            // only deleting sample data
            $this->deleteAll($manager, $output);
        } else {
            $this->deleteAll($manager, $output);

            $output->write('loading data.. ');

            $mainuser = $manager->getRepository('AdministrationBundle:User')->findOneByUsername('user');

            for ($i = 1; $i <= 10; $i ++) {
                $administrator = new Administrator();
                $administrator->setUsername('administrator'.$i);
                $administrator->setEmail('administrator'.$i.'@thedomainobms.com');
                $encoder = $factory->getEncoder($administrator);
                $password = $encoder->encodePassword('thepass', $administrator->getSalt());
                $administrator->setPassword($password);
                $manager->persist($administrator);

                $newUser = new User();
                $newUser->setUsername('user'.$i);
                $newUser->setEmail('user'.$i.'@thedomainobms.com');
                $encoder = $factory->getEncoder($newUser);
                $password = $encoder->encodePassword('thepass', $newUser->getSalt());
                $newUser->setPassword($password);
                $newUser->setIsEnabled(true);
                $manager->persist($newUser);

                $newBusiness = new Business();
                $newBusiness->setFullname('Business '.$i);
                $newBusiness->setCifnif('Cifnif '.$i);
                $newBusiness->setAddress('Address '.$i);
                $newBusiness->addUser($newUser);
                $newBusiness->addUser($mainuser);
                if ($i == 1) {
                    $mainuser->setCurrentBusiness($newBusiness);
                }
                $manager->persist($newBusiness);

                // THIRDS //////////////////////////////////////////////////////////////////////
                $newThirdType = new ThirdType();
                $newThirdType->setName('Third type '.$i);
                $newThirdType->setBusiness($newBusiness);
                $manager->persist($newThirdType);

                $newThird = new Third();
                $newThird->setFullname('Third '.$i);
                $newThird->setTelephone('Telephone '.$i);
                $newThird->setAddress('Adress '.$i);
                $newThird->setEmail('Email '.$i);
                $newThird->setWeb('Web '.$i);
                $newThird->setThirdType($newThirdType);
                $newThird->setBusiness($newBusiness);
                $manager->persist($newThird);

                // HUMAN RESOURCES //////////////////////////////////////////////////////////////////////
                $newWorker = new Worker();
                $newWorker->setFullname('Worker '.$i);
                $newWorker->setTelephone('Telephone '.$i);
                $newWorker->setEmail('emailworker'.$i.'@thedomainobms.com');
                $newWorker->setBusiness($newBusiness);
                $manager->persist($newWorker);

                $newPayroll = new WorkerPayroll();
                $newPayroll->setWorker($newWorker);
                $newPayroll->setYear(2015);
                $newPayroll->setMonth(9);
                $newPayroll->setAmount(1000);
                $manager->persist($newPayroll);

                $newHolliday = new WorkerHolliday();
                $newHolliday->setWorker($newWorker);
                $newHolliday->setInitdate(new \DateTime('now'));
                $newHolliday->setFinishdate(new \DateTime('now'));
                $manager->persist($newHolliday);

                $newDown = new WorkerDown();
                $newDown->setWorker($newWorker);
                $newDown->setInitdate(new \DateTime('now'));
                $newDown->setFinishdate(new \DateTime('now'));
                $manager->persist($newDown);

                // SHOPPING //////////////////////////////////////////////////////////////////////
                // STORAGE //////////////////////////////////////////////////////////////////////
                // SALES //////////////////////////////////////////////////////////////////////
                $newSalesNote = new SalesNote();
                $newSalesNote->setDate(new \DateTime('now'));
                $newSalesNote->setBusiness($newBusiness);
                $newSalesNote->setReference('N'.$i);
                $newSalesNote->setDescription('Description '.$i);
                $manager->persist($newSalesNote);

                for ($j = 1; $j <= 3; $j++) {
                    $newSalesNoteDetail = new SalesNoteDetail();
                    $newSalesNoteDetail->setPrice($i + $j/100);
                    $newSalesNoteDetail->setConcept('Concept '.$i);
                    $newSalesNoteDetail->setQuantity($j);
                    $newSalesNoteDetail->setSalesNote($newSalesNote);
                    $manager->persist($newSalesNoteDetail);
                }

                $newSalesOrder = new SalesOrder();
                $newSalesOrder->setDate(new \DateTime('now'));
                $newSalesOrder->setBusiness($newBusiness);
                $newSalesOrder->setReference('O'.$i);
                $newSalesOrder->setDescription('Description '.$i);
                $manager->persist($newSalesOrder);

                for ($j = 1; $j <= 3; $j++) {
                    $newSalesOrderDetail = new SalesOrderDetail();
                    $newSalesOrderDetail->setPrice($i + $j/100);
                    $newSalesOrderDetail->setConcept('Concept '.$i);
                    $newSalesOrderDetail->setQuantity($j);
                    $newSalesOrderDetail->setSalesOrder($newSalesOrder);
                    $manager->persist($newSalesOrderDetail);
                }

                $newSalesBudget = new SalesBudget();
                $newSalesBudget->setDate(new \DateTime('now'));
                $newSalesBudget->setBusiness($newBusiness);
                $newSalesBudget->setReference('B'.$i);
                $newSalesBudget->setDescription('Description '.$i);
                $manager->persist($newSalesBudget);

                for ($j = 1; $j <= 3; $j++) {
                    $newSalesBudgetDetail = new SalesBudgetDetail();
                    $newSalesBudgetDetail->setPrice($i + $j/100);
                    $newSalesBudgetDetail->setConcept('Concept '.$i);
                    $newSalesBudgetDetail->setQuantity($j);
                    $newSalesBudgetDetail->setSalesBudget($newSalesBudget);
                    $manager->persist($newSalesBudgetDetail);
                }

                $newSalesPreinvoice = new SalesPreinvoice();
                $newSalesPreinvoice->setDate(new \DateTime('now'));
                $newSalesPreinvoice->setSalesBudget($newSalesBudget);
                $newSalesPreinvoice->setReference('PI'.$i);
                $manager->persist($newSalesPreinvoice);

                $newSalesInvoice = new SalesInvoice();
                $newSalesInvoice->setDate(new \DateTime('now'));
                $newSalesInvoice->setSalesBudget($newSalesBudget);
                $newSalesInvoice->setReference('I'.$i);
                $manager->persist($newSalesInvoice);

                $newSalesAmendmentInvoice = new SalesAmendmentInvoice();
                $newSalesAmendmentInvoice->setDate(new \DateTime('now'));
                $newSalesAmendmentInvoice->setBusiness($newBusiness);
                $newSalesAmendmentInvoice->setSalesInvoice($newSalesInvoice);
                $newSalesAmendmentInvoice->setReference('R'.$i);
                $manager->persist($newSalesAmendmentInvoice);

                for ($j = 1; $j <= 3; $j++) {
                    $newSalesAmendmentInvoiceDetail = new SalesAmendmentInvoiceDetail();
                    $newSalesAmendmentInvoiceDetail->setPrice($i + $j/100);
                    $newSalesAmendmentInvoiceDetail->setConcept('Concept '.$i);
                    $newSalesAmendmentInvoiceDetail->setQuantity($j);
                    $newSalesAmendmentInvoiceDetail->setSalesAmendmentInvoice($newSalesAmendmentInvoice);
                    $manager->persist($newSalesAmendmentInvoiceDetail);
                }

                // ACCOUNTING //////////////////////////////////////////////////////////////////////
                // PRODUCTION //////////////////////////////////////////////////////////////////////
                // LOGISTICS //////////////////////////////////////////////////////////////////////
                // PLANIFICATION //////////////////////////////////////////////////////////////////////
                // PROCESS CONTROL //////////////////////////////////////////////////////////////////////
                // DOCUMENTS //////////////////////////////////////////////////////////////////////
                // INTELLIGENCE //////////////////////////////////////////////////////////////////////
            }
        }

        $manager->flush();

        $output->writeln('ok');
    }

    private function deleteAll(EntityManager $manager, OutputInterface $output)
    {
        $output->write('Deleting sample data.. ');

        $administrators = $manager->getRepository('AdministrationBundle:Administrator')->findAll();
        foreach ($administrators as $administrator) {
            if ($administrator->getUsername() != 'administrator') {
                $manager->remove($administrator);
            }
        }

        $users = $manager->getRepository('AdministrationBundle:User')->findAll();
        foreach ($users as $user) {
            if ($user->getUsername() != 'user') {
                $manager->remove($user);
            }
        }

        $businesses = $manager->getRepository('AppBundle:Business')->findAll();
        foreach ($businesses as $business) {
            $manager->remove($business);
        }

        $manager->flush();
    }
}

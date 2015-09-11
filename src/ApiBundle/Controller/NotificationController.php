<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("Notification")
 */
class NotificationController extends FOSRestController //implements ClassResourceInterface
{
    /**
     * View().
     */
    public function getAction()
    {
        $manager = $this->getDoctrine()->getEntityManager();

        $notifications = $manager->getRepository('BackBundle:Notification')->findAll();

        //$view = $this->view ( $notificaciones, 200 )->setTemplate ( "MyBundle:Users:getUsers.html.twig" )->setTemplateVar ( 'users' );

        $view = $this->view($notifications, 200)
            ->setTemplate('ApiBundle:Notificaciones:getNotifications.html.twig')
            ->setTemplateVar('notificaciones')
        ;

        return $this->handleView($view);
    } // "get_notifications" [GET] /notifications
}
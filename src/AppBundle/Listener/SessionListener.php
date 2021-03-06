<?php

/**
 * This file is part of The OBMS project: https://github.com/obms/obms
 *
 * Copyright (c) Jaime Niñoles-Manzanera Jimeno.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\Router;

class SessionListener
{
    private $securityContext;

    private $container;

    private $router;

    public function __construct(SecurityContext $securityContext, Container $container, Router $router)
    {
        $this->securityContext = $securityContext;
        $this->container = $container;
        $this->router = $router;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        // if we have a session id stored in database for this user
        // but it is different than the session id log out the user because there is someone
        // logged in on a different device
        if ($token = $this->securityContext->getToken()) {
            if ($token->getUser() != 'anon.') {
                $user = $token->getUser();

                if (get_class($user) == 'AdministrationBundle\Entity\User') {
                    if (!$user->getIsEnabled()) {
                        $this->container->get('session')->getFlashBag()->add(
                                'danger',
                                'You cannot log in because you are disabled.'
                            );
                        $this->securityContext->setToken(null);
                    }

                    if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY') || $this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                        if ($user->getSessionId() != $this->container->get('session')->getId()) {
                            $this->container->get('session')->getFlashBag()->add(
                                    'danger',
                                    'Logged out because your user credentials are being used in other device.'
                                );
                            $this->securityContext->setToken(null);
                            $response = new RedirectResponse($this->router->generate('app_home'));
                            $event->setResponse($response);

                            return $event;
                        }
                    }
                }
            }
        }
    }
}

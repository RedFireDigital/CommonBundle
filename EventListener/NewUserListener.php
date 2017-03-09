<?php

/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    09/03/17
 * Time:    10:26
 * Project: fruitful-property-investments
 * File:    NewUserListener.php
 *
 **/

namespace PartFire\CommonBundle\EventListener;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\UserEvent;
use PartFire\CommonBundle\Entity\Repository\RepositoryFactory;
use PartFire\CommonBundle\Interfaces\IPAddressable;
use Symfony\Component\HttpFoundation\Request;

class NewUserListener
{
    private $repoFactory;

    public function __construct(RepositoryFactory $repositoryFactory)
    {
        $this->repoFactory = $repositoryFactory;
    }

    public function onCreateUserSetIPAddress(FilterUserResponseEvent $userEvent)
    {
        $request = $userEvent->getRequest();
        $user = $userEvent->getUser();
        $this->setIPAddress($user, $request);
    }

    private function setIPAddress(IPAddressable $iPAddressable, Request $request)
    {
        $iPAddressable->setIPAddress($this->getIp($request));
        $this->saveEntity($iPAddressable);
    }

    private function getIp(Request $request) : string
    {
        return $request->getClientIp();
    }

    private function saveEntity($entity)
    {
        $this->repoFactory->saveAndGetEntity($entity);
    }
}
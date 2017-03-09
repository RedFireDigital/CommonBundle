<?php

/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    09/03/17
 * Time:    10:35
 * Project: fruitful-property-investments
 * File:    IPAddressable.php
 *
 **/

namespace PartFire\CommonBundle\Interfaces;

interface IPAddressable
{
    public function setIPAddress($ip);
}
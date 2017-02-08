<?php

/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    08/12/16
 * Time:    10:37
 * Project: PartFire MangoPay Bundle
 * File:    CommonOutputInterface.php
 *
 **/

namespace PartFire\CommonBundle\Services\Output;

interface CommonOutputInterface
{
    public function info($string);

    public function infoid($string);

    public function comment($string);

    public function error($string);

    public function highlight($string);

    public function highlightid($string);

    public function getLogArray();
    public function getLogString();
}
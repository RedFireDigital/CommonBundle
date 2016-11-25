<?php
/**
 * Created by Carl Owens (carl@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Copyright © 2016 PartFire Ltd. All rights reserved.
 *
 * User:    Carl Owens
 * Date:    14/11/2016
 * Time:    21:59
 * File:    CountryData.php
 **/

namespace PartFire\CommonBundle\Data;


class CountryData
{
    protected $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        $string = file_get_contents( __DIR__ . DIRECTORY_SEPARATOR . "CountryData.json");
        return json_decode($string, false);
    }
}
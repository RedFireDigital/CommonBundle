<?php

/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    16/03/17
 * Time:    21:12
 * Project: opus-symfony
 * File:    CSVService.php
 *
 **/

namespace PartFire\CommonBundle\Services\CSV;

use Doctrine\Common\Collections\ArrayCollection;

class CSVService
{
    public function getCSVDataAsStandardClass($csvDataArray) : ArrayCollection
    {
        $csvCollection = new ArrayCollection();
        $headerRow = [];

        for ($row=0; $row < count($csvDataArray); $row++) {
            $propertyName = $this->getPropertyNameFromName($csvDataArray[$row]);
            $headerRow[] = $propertyName;

            if ($row == 0) {
                $newStdMaster = new \StdClass();
                $newStdMaster->$propertyName = null;
            }

            if ($row > 0) {
                $std = clone $newStdMaster;

            }

            //echo $data[$c] . "<br />\n";
        }

        $row++;
    }

    private function getPropertyNameFromName($name)
    {
        $upperCaseFirst = ucfirst($name);
        $removeSpaces = preg_replace("/[^a-zA-Z0-9]+/", "", $upperCaseFirst);
        return $removeSpaces;
    }
}
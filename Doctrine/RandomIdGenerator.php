<?php

/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    07/03/17
 * Time:    22:29
 * Project: fruitful-property-investments
 * File:    RandomIdGenerator.php
 *
 **/

namespace PartFire\CommonBundle\Doctrine;

use Doctrine\ORM\Id\AbstractIdGenerator;

class RandomIdGenerator extends AbstractIdGenerator
{
    public function generate(\Doctrine\ORM\EntityManager $em, $entity)
    {
        $entity_name = $em->getClassMetadata(get_class($entity))->getName();

        // Id must be 6 digits length, so range is 100000 - 999999
        $min_value = 100000;
        $max_value = 999999;

        $max_attempts = $min_value - $max_value;
        $attempt = 0;

        while (true) {
            $id = mt_rand($min_value, $max_value);
            $item = $em->find($entity_name, $id);

            if (!$item) {
                return $id;
            }

            // Should we stop?
            $attempt++;
            if ($attempt > $max_attempts) {
                throw new \Exception('RandomIdGenerator worked hardly, but failed to generate unique ID :(');
            }
        }

    }
}
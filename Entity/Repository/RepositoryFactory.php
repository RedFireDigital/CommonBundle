<?php
/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    15/11/16
 * Time:    22:54
 * Project: PartFire Common
 * File:    RepositoryFactory.php
 *
 **/

namespace PartFire\CommonBundle\Entity\Repository;

use Doctrine\ORM\EntityManager;

class RepositoryFactory extends RepositoryBaseFactory  implements Repository
{
    public $bundleName = "PartFireCommonBundle";
    
    public function getBundleName()
    {
        return $this->bundleName;
    }
    
    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }
}
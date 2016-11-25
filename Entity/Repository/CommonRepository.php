<?php
/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    24/11/16
 * Time:    23:18
 * Project: fruitful-property-investments
 * File:    CommonRepository.php
 *
 **/

namespace PartFire\CommonBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;

class CommonRepository extends EntityRepository
{
    /**
     *
     * @param string $methodName
     * @return string
     */
    protected function _getPropertyFromMethodName($methodName)
    {
        $prop = substr($methodName, 3); // strip get/set
        return $prop;
    }
    
    public function persist($entity)
    {
        $this->em->persist($entity);
    }
    
    public function save()
    {
        $this->em->flush();
    }
    
    public function remove($entity){
        $this->em->remove($entity);
    }
    
    public function removeAndSave($entity)
    {
        $this->em->remove($entity);
        $this->save();
    }
    
    public function saveAndGetEntity($entity)
    {
        $this->persist($entity);
        $this->save();
        
        return $this->refresh($entity);
    }
    
    public function refresh($entity)
    {
        $this->em->refresh($entity);
        return $entity;
    }
}
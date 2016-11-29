<?php
/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    28/11/16
 * Time:    12:37
 * Project: fruitful-property-investments
 * File:    RepositoryBaseFactory.php
 *
 **/

namespace PartFire\CommonBundle\Entity\Repository;

use Doctrine\ORM\EntityManager;

class RepositoryBaseFactory implements Repository
{
    
    protected $em;
    protected $repository;
    public $bundleName;
    
    public $entityManagerName  = 'default';
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = array();
    }
    
    public function getBundleName()
    {
        return $this->bundleName;
    }
    
    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }
    
    public function __call($name, $arguments)
    {
        $prop = $this->_getPropertyFromMethodName($name);
        try {
            try {
                $repo = $this->em->getRepository($this->getBundleName() . ':' . $prop);
            } catch (\Exception $e) {
                throw new \ErrorException('Can not find repo ' .$prop . ' in bundle ' . $this->getBundleName() . ' ( ' . $this->getBundleName() . ':' . $prop . ' ) on ' . get_class($this) . " --> " . $e->getMessage());
            }
            
            
            return $repo;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    
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
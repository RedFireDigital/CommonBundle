<?php
/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    15/11/16
 * Time:    23:42
 * Project: PartFire Common
 * File:    RepositoryAbstract.php
 *
 **/

namespace Partfire\CommonBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class RepositoryAbstract extends EntityRepository implements Repository
{
    public $bundleName;
            
    public function findAllByPage($page, $pageLimit = 10)
    {
        $queryString    = 'SELECT a FROM ' . $this->getBundleName() .':' .$this->entityname.' a ORDER BY a.id DESC';
        $query          = $this->getEntityManager()->createQuery($queryString);
        
        $pagination     = $this->getPaginator()->paginate(
            $query,
            $page,
            $pageLimit
        );
        
        return $pagination;
    }
    
    public function getDropDownSelectBox()
    {
        $returnArray = array();
        foreach ($this->findAll(array(), array('name'=>'asc')) as $make) {
            $returnArray[$make->getId()] = $make->getName();
        };
        return $returnArray;
    }
    
    public function getCountAll()
    {
        $queryString    = 'SELECT COUNT(u.id) FROM ' . $this->getBundleName() .':' .$this->entityname.' u';
        $query          = $this->getEntityManager()->createQuery($queryString);
        $count          = $query->getSingleScalarResult();
        return $count;
    }
    
    public function getCountWhere(Array $where)
    {
        $queryString    = 'SELECT COUNT(u.id) FROM ' . $this->getBundleName() .':' .$this->entityname.' u WHERE u.' . $where['item'] . ' = :value'. $where['value'];
        $query          = $this->getEntityManager()->createQuery($queryString);
        $count          = $query->getSingleScalarResult();
        return $count;
    }
    
    public function getCountWheres($wheres)
    {
        $whereString = "";
        
        //var_dump($wheres);
        $count = 0;
        foreach($wheres as $where => $value) {
            $count++;
            
            
            if (is_bool($value) === true) {
                $value = $value ? "1" : "0";
            }
            
            if (is_object($value)) {
                $value = $value->getId();
            }
            
            $whereString .= "u." . $where . " = '" . $value ."'";
            
            if ($count == count($wheres)) {
                
            } else {
                $whereString .= " AND ";
            }
        }
        
        
        $queryString    = 'SELECT COUNT(u.id) FROM ' . $this->getBundleName() .':' .$this->entityname.' u WHERE ' . $whereString;
        
        //die();
        $query          = $this->getEntityManager()->createQuery($queryString);
        
        $count          = $query->getSingleScalarResult();
        
        //die();
        return $count;
    }
    
    public function getAllOrderedRows($limit = 10)
    {
        return $this->findBy(
            array(),
            array('id'=>'desc'),
            $limit,
            0
        );
    }
    
    public function removeEntity($entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }
    
    public function getBundleName()
    {
        return $this->bundleName;
    }
    
    public function getMergedCriteria($item)
    {
        if (is_array($item)) {
            $criteria = array_merge($this->getEnabledCriteria(), $item);
        } else {
            $criteria = $this->getEnabledCriteria();
            $criteria[] = $item;
        }
        return $criteria;
    }
    
    protected function getEnabledCriteria()
    {
        return [
            'enabled'       => true,
            'deleted'       => false,
        ];
    }
    
    public function persist($entity)
    {
        $this->_em->persist($entity);
    }
    
    public function save()
    {
        $this->_em->flush();
    }
    
}
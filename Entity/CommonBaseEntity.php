<?php
/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 *
 * User:    gra
 * Date:    16/04/15
 * Time:    14:55
 * File:    CommonBaseEntity.php
 **/

namespace PartFire\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\HasLifecycleCallbacks
 * @ORM\MappedSuperclass
 * @ExclusionPolicy("all")
 */

class CommonBaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"comment" = "Unique identifier"})
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @var datetime $created_date
     * @ORM\Column(name="created_date", type="datetime", options={"comment" = "Timestamp when the row was created"})
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdDate;

    /**
     * @var datetime $updated_date
     * @ORM\Column(name="updated_date", type="datetime", options={"comment" = "Timestamp when the row was last updated"})
     * @Gedmo\Timestampable
     */
    protected $updatedDate;

    /**
     * @ORM\Column(type="boolean", options={"comment" = "Enable/Disable flag"});
     * @Assert\NotNull()
     */
    protected $enabled = true;

    /**
     * @ORM\Column(type="boolean", options={"comment" = "Deleted/Exists flag"});
     * @Assert\NotNull()
     */
    protected $deleted = false;

    /**
     * @ORM\Column(name="hash", type="string", unique=true, options={"comment" = "Unique hash number"})
     */
    protected $hash;

    public function __construct()
    {
        $this->hash = $this->getHashValue(80);
    }

    public function __call($method, $arguments)
    {
        if (preg_match('/^(get|is|has)([A-Z].*)$/', $method, $matches)) {
            return $this->{lcfirst($matches[2])};
        } elseif (preg_match('/^(set)([A-Z].*)$/', $method, $matches)) {
            $this->{lcfirst($matches[2])} = $arguments[0];
            return;
        }
        throw new \Exception(sprintf(
            'Method does not exist for class "%s" - ' . $method .'',
            get_class($this)
        ));
    }

    public function createFromArray($data)
    {
        foreach ($data as $item => $value) {
            $this->{"set" . ucfirst($item)}($value);
        }
    }

    /**
     * Get last Id inserted
     */
    public function getLastInsertId()
    {
        return $this->id;
    }

    /**
     * Get hash string
     */
    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    public function getHashValue(
        $length = 20,
        $keySpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $str = '';
        $max = mb_strlen($keySpace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keySpace[random_int(0, $max)];
        }
        return $str;
    }

    public function getHumanCreatedTime()
    {
        return $this->createdDate->format('D, d M y H:i:s');
    }

    public function getPaddedId($size = 8)
    {
        return str_pad($this->getId(), $size, '0', STR_PAD_LEFT);
    }

    /**
     * @return datetime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param datetime $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return (boolean)$this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return (boolean)$this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function sluggify($url)
    {
        # Prep string with some basic normalization
        $url = strtolower($url);
        $url = strip_tags($url);
        $url = stripslashes($url);
        $url = html_entity_decode($url);

        # Remove quotes (can't, etc.)
        $url = str_replace('\'', '', $url);

        # Replace non-alpha numeric with hyphens
        $match = '/[^a-z0-9]+/';
        $replace = '-';
        $url = preg_replace($match, $replace, $url);

        $url = trim($url, '-');

        return $url;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return datetime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * @param datetime $updatedDate
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
    }
}

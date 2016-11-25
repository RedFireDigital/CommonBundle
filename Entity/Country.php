<?php
/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 *
 * User:    gra
 * Date:    21/08/2014
 * Time:    13:04
 * File:    Country.php
 **/

namespace PartFire\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Entity
 * @ORM\Table(name="partfire_country", indexes={
 *  @ORM\Index(name="index_enabled", columns={"enabled", "deleted"}) })
 * @ORM\Entity(repositoryClass="PartFire\CommonBundle\Entity\Repository\CountryRepository")
 * @ExclusionPolicy("all")
 */

class Country extends CommonBaseEntity
{
    /**
     * @ORM\Column(name="country_name",type="string", length=255, unique=true, nullable=false);
     *
     */

    protected $countryName;

    /**
     * @ORM\Column(name="old_country_name",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $oldCountryName;

    /**
     * @ORM\Column(name="type",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $type;

    /**
     * @ORM\Column(name="sub_type",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $subType;

    /**
     * @ORM\Column(name="sovereignty",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $sovereignty;

    /**
     * @ORM\Column(name="capital",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $capital;

    /**
     * @ORM\Column(name="iso_4217_currency_code",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $iso4217CurrencyCode;

    /**
     * @ORM\Column(name="iso_4217_currency_name",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $iso4217CurrencyName;

    /**
     * @ORM\Column(name="itu_telephone_code",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $ituTelephoneCode;


    /**
     * @ORM\Column(name="iso_3166_2_letter",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $iso31662Letter;

    /**
     * @ORM\Column(name="iso_3166_3_letter",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $iso31663Letter;

    /**
     * @ORM\Column(name="iso_3166_1_number",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $iso31661Number;

    /**
     * @ORM\Column(name="iana_country_tld",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $ianaCountryCode;

    /**
     * @param mixed $capital
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;
    }

    /**
     * @return mixed
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * @param mixed $countryName
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
    }

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param mixed $ianaCountryCode
     */
    public function setIanaCountryCode($ianaCountryCode)
    {
        $this->ianaCountryCode = $ianaCountryCode;
    }

    /**
     * @return mixed
     */
    public function getIanaCountryCode()
    {
        return $this->ianaCountryCode;
    }

    /**
     * @param mixed $iso31661Number
     */
    public function setIso31661Number($iso31661Number)
    {
        $this->iso31661Number = $iso31661Number;
    }

    /**
     * @return mixed
     */
    public function getIso31661Number()
    {
        return $this->iso31661Number;
    }

    /**
     * @param mixed $iso31662Letter
     */
    public function setIso31662Letter($iso31662Letter)
    {
        $this->iso31662Letter = $iso31662Letter;
    }

    /**
     * @return mixed
     */
    public function getIso31662Letter()
    {
        return $this->iso31662Letter;
    }

    /**
     * @param mixed $iso31663Letter
     */
    public function setIso31663Letter($iso31663Letter)
    {
        $this->iso31663Letter = $iso31663Letter;
    }

    /**
     * @return mixed
     */
    public function getIso31663Letter()
    {
        return $this->iso31663Letter;
    }

    /**
     * @param mixed $iso4217CurrencyCode
     */
    public function setIso4217CurrencyCode($iso4217CurrencyCode)
    {
        $this->iso4217CurrencyCode = $iso4217CurrencyCode;
    }

    /**
     * @return mixed
     */
    public function getIso4217CurrencyCode()
    {
        return $this->iso4217CurrencyCode;
    }

    /**
     * @param mixed $iso4217CurrencyName
     */
    public function setIso4217CurrencyName($iso4217CurrencyName)
    {
        $this->iso4217CurrencyName = $iso4217CurrencyName;
    }

    /**
     * @return mixed
     */
    public function getIso4217CurrencyName()
    {
        return $this->iso4217CurrencyName;
    }

    /**
     * @param mixed $ituTelephoneCode
     */
    public function setItuTelephoneCode($ituTelephoneCode)
    {
        $this->ituTelephoneCode = $ituTelephoneCode;
    }

    /**
     * @return mixed
     */
    public function getItuTelephoneCode()
    {
        $this->ituTelephoneCode = str_replace('-', '', $this->ituTelephoneCode);
        $this->ituTelephoneCode = str_replace('+', '', $this->ituTelephoneCode);

        return $this->ituTelephoneCode;
    }

    /**
     * @param mixed $oldCountryName
     */
    public function setOldCountryName($oldCountryName)
    {
        $this->oldCountryName = $oldCountryName;
    }

    /**
     * @return mixed
     */
    public function getOldCountryName()
    {
        return $this->oldCountryName;
    }

    /**
     * @param mixed $sovereignty
     */
    public function setSovereignty($sovereignty)
    {
        $this->sovereignty = $sovereignty;
    }

    /**
     * @return mixed
     */
    public function getSovereignty()
    {
        return $this->sovereignty;
    }

    /**
     * @param mixed $subType
     */
    public function setSubType($subType)
    {
        $this->subType = $subType;
    }

    /**
     * @return mixed
     */
    public function getSubType()
    {
        return $this->subType;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getCountryName();
    }

    public function __construct()
    {
        parent::__construct();
    }
}

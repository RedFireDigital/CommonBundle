<?php
namespace PartFire\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use PartFire\CommonBundle\Data\CountryData;
use PartFire\CommonBundle\Entity\Country;

/**
 * Default country fixtures.
 **/
class LoadCountryData extends AbstractFixture implements OrderedFixtureInterface
{
    private $countries;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $countryData = new CountryData();
        $this->countries = $countryData->getData();

        foreach ($this->countries as $country) {
            $countryEntity = new Country();
            $countryEntity->setCapital($country->capital);
            $countryEntity->setCountryName($country->country_name);
            $countryEntity->setIanaCountryCode($country->iana_country_tld);
            $countryEntity->setIso4217CurrencyCode($country->iso_4217_currency_code);
            $countryEntity->setIso31661Number($country->iso_3166_1_number);
            $countryEntity->setType($country->type);
            $countryEntity->setSubType($country->sub_type);
            $countryEntity->setSovereignty($country->sovereignty);
            $countryEntity->setOldCountryName($country->old_country_name);
            $countryEntity->setItuTelephoneCode($country->itu_telephone_code);
            $countryEntity->setIso4217CurrencyName($country->iso_4217_currency_name);
            $countryEntity->setIso31662Letter($country->iso_3166_2_letter);
            $countryEntity->setIso31663Letter($country->iso_3166_3_letter);
            $countryEntity->setEnabled(true);
            $countryEntity->setDeleted(false);
            $manager->persist($countryEntity);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 100;
    }
}

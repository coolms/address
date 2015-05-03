<?php
/**
 * CoolMS2 Address Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/address for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAddress\View\Helper;

use Zend\View\Helper\AbstractHelper,
    CmsAddress\Mapping\AddressInterface,
    CmsAddress\Mapping\IndividualAddressInterface,
    CmsAddress\Mapping\LegalAddressInterface;

/**
 * View helper for rendering address
 */
class Address extends AbstractHelper
{
    /**
     * @var AddressInterface
     */
    protected $entity;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $template;

    /**
     * @param AddressInterface $addressEntity
     * @param string $locale
     * @param string $template
     * @return self|string
     */
    public function __invoke(AddressInterface $address = null, $locale = null, $template = null)
    {
        if (func_num_args() === 0) {
            return $this;
        }
        if (null !== $address) {
            if (null !== $locale) {
                $this->setLocale($locale);
            }
            if (null !== $template) {
            	$this->setTemplate($template);
            }
            return $this->render($address);
        }
    }

    /**
     * Render address
     *
     * @param AddressInterface $address
     * @return string
     */
    public function render(AddressInterface $address)
    {
        $this->setEntity($address);
        return $this->format();
    }

    /**
     * @param AddressInterface $address
     * @return self
     */
    public function setEntity(AddressInterface $address)
    {
    	$this->entity = $address;
    	return $this;
    }

    /**
     * @return AddressInterface
     */
    public function getEntity()
    {
    	return $this->entity;
    }

    /**
     * @param string $locale
     * @return self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        if (null === $this->locale) {
            $this->setLocale(\Locale::getDefault());
        }
        return $this->locale;
    }

    /**
     * @param string $template
     * @return self
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return string
     */
    protected function format()
    {
        $address = [];

        $entity = $this->getEntity();
        $locality = $entity->getLocality();

        $country = $locality->getCountry();
        $address[] = $country->getVariant() ?: $country->getName();
        $address[] = $entity->getPostCode();
        $address[] = $locality->getName();
        $address[] = $entity->getStreet();

        $houseNumber = $entity->getHouseNumber();
        if ($houseNumber) {
            $address[] = "д. $houseNumber"; 
        }

        $housing = $entity->getHousing();
        if ($housing) {
            if (is_numeric($housing)) {
                $address[] = "корп. $housing";
            } else {
                $address[count($address) - 1] .= $housing;
            }
        }

        if ($entity instanceof LegalAddressInterface) {
            $officeNumer = $entity->getOfficeNumber();
            if ($officeNumer) {
                $address[] = "оф. $officeNumer";
            }
        } elseif ($entity instanceof IndividualAddressInterface) {
            $apartmentNumer = $entity->getApartmentNumber();
            if ($apartmentNumer) {
            	$address[] = "кв. $apartmentNumer";
            }
        }

        return implode(', ', $address);
    }
}

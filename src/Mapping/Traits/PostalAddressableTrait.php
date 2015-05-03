<?php
/**
 * CoolMS2 Address Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/address for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAddress\Mapping\Traits;

use CmsAddress\Mapping\PostalAddressInterface;

trait PostalAddressableTrait
{
    /**
     * @var PostalAddressInterface
     *
     * @Form\ComposedObject({
     *      "target_object":"CmsAddress\Mapping\PostalAddressInterface",
     *      "options":{
     *          "label":"Postal address",
     *          "name":"postalAddress",
     *          "partial":"cms-address/address/fieldset",
     *          "text_domain":"CmsAddress",
     *      }})
     */
    protected $postalAddress;

    /**
     * @return PostalAddressInterface
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * @param PostalAddressInterface $address
     */
    public function setPostalAddress(PostalAddressInterface $address)
    {
        $this->postalAddress = $address;
        if ($address instanceof \CmsCommon\Mapping\Common\ObjectableInterface) {
            $address->setObject($this);
        }
    }
}

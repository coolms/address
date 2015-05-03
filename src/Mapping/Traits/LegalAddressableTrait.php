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

use CmsAddress\Mapping\LegalAddressInterface;

trait LegalAddressableTrait
{
    /**
     * @var LegalAddressInterface
     *
     * @Form\ComposedObject({
     *      "target_object":"CmsAddress\Mapping\LegalAddressInterface",
     *      "options":{
     *          "label":"Legal address",
     *          "name":"legalAddress",
     *          "partial":"cms-address/legal/fieldset",
     *          "text_domain":"CmsAddress",
     *      }})
     */
    protected $legalAddress;

    /**
     * @return LegalAddressInterface
     */
    public function getLegalAddress()
    {
        return $this->legalAddress;
    }

    /**
     * @param LegalAddressInterface $address
     */
    public function setLegalAddress(LegalAddressInterface $address)
    {
        $this->legalAddress = $address;
        if ($address instanceof \CmsCommon\Mapping\Common\ObjectableInterface) {
            $address->setObject($this);
        }
    }
}

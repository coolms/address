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

use CmsAddress\Mapping\IndividualAddressInterface;

trait IndividualAddressableTrait
{
    /**
     * @var IndividualAddressInterface
     *
     * @Form\ComposedObject({
     *      "target_object":"CmsAddress\Mapping\IndividualAddressInterface",
     *      "options":{
     *          "label":"Individual address",
     *          "name":"individualAddress",
     *          "partial":"cms-address/individual/fieldset",
     *          "text_domain":"CmsAddress",
     *      }})
     */
    protected $individualAddress;

    /**
     * @return IndividualAddressInterface
     */
    public function getIndividualAddress()
    {
        return $this->individualAddress;
    }

    /**
     * @param IndividualAddressInterface $address
     */
    public function setIndividualAddress(IndividualAddressInterface $address)
    {
        $this->individualAddress = $address;
        if ($address instanceof \CmsCommon\Mapping\Common\ObjectableInterface) {
            $address->setObject($this);
        }
    }
}

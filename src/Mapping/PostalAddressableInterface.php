<?php
/**
 * CoolMS2 Address Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/address for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAddress\Mapping;

interface PostalAddressableInterface extends AddressableInterface
{
    /**
     * @param PostalAddressInterface $address
     */
    public function setPostalAddress(PostalAddressInterface $address);

    /**
     * @return PostalAddressInterface
     */
    public function getPostalAddress();
}

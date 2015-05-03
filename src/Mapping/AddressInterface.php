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

interface AddressInterface
{
    /**
     * @return \CmsGeo\Mapping\Subdivision\LocalityInterface
     */
    public function getLocality();

    /**
     * @return string
     */
    public function getPostCode();

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @return number
     */
    public function getHouseNumber();

    /**
     * @return string
     */
    public function getHousing();
}

<?php
/**
 * CoolMS2 Address module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAddress for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAddress\Mapping;

use Doctrine\Common\EventSubscriber,
    Doctrine\Common\EventArgs,
    Doctrine\ORM\Events;

class AddressableSubscriber implements EventSubscriber
{
    const INTERFACE_ADDRESSABLE             = 'CmsAddress\\Mapping\\AddressableInterface';
    const INTERFACE_INDIVIDUAL_ADDRESSABLE  = 'CmsAddress\\Mapping\\IndividualAddressableInterface';
    const INTERFACE_LEGAL_ADDRESSABLE       = 'CmsAddress\\Mapping\\LegalAddressableInterface';
    const INTERFACE_POSTAL_ADDRESSABLE      = 'CmsAddress\\Mapping\\PostalAddressableInterface';

    const INTERFACE_ADDRESS                 = 'CmsAddress\\Mapping\\AddressInterface';
    const INTERFACE_INDIVIDUAL_ADDRESS      = 'CmsAddress\\Mapping\\IndividualAddressInterface';
    const INTERFACE_LEGAL_ADDRESS           = 'CmsAddress\\Mapping\\LegalAddressInterface';
    const INTERFACE_POSTAL_ADDRESS          = 'CmsAddress\\Mapping\\PostalAddressInterface';

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return [Events::loadClassMetadata];
    }

    /**
     * @param EventArgs $eventArgs
     */
    public function loadClassMetadata(EventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();
        if ($metadata->isMappedSuperclass) {
            return;
        }
        
        $mappings = $metadata->getAssociationMappings();
        $classImplements = class_implements($metadata->getName());
        
        if (in_array(static::INTERFACE_ADDRESSABLE, $classImplements)) {
            
            $relations = [];
            
            if (!isset($mappings['individualAddress'])
                && in_array(static::INTERFACE_INDIVIDUAL_ADDRESSABLE, $classImplements)
            ) {
                $relations[] = [
                    'targetEntity'  => static::INTERFACE_INDIVIDUAL_ADDRESS,
                    'fieldName'     => 'individualAddress',
                ];
            }
            if (!isset($mappings['legalAddress'])
                && in_array(static::INTERFACE_LEGAL_ADDRESSABLE, $classImplements)
            ) {
                $relations[] = [
                    'targetEntity'  => static::INTERFACE_LEGAL_ADDRESS,
                    'fieldName'     => 'legalAddress',
                ];
            }
            if (!isset($mappings['postalAddress'])
                && in_array(static::INTERFACE_POSTAL_ADDRESSABLE, $classImplements)
            ) {
                $relations[] = [
                    'targetEntity'  => static::INTERFACE_POSTAL_ADDRESS,
                    'fieldName'     => 'postalAddress',
                ];
            }
            
            foreach ($relations as $relation) {
                $metadata->mapOneToOne(array_merge_recursive($relation, [
                    'orphanRemoval' => true,
                    'cascade'       => ['persist','remove'],
                    'joinColumn'    => [
                        'nullable'  => true,
                        'onDelete'  => 'CASCADE',
                        'onUpdate'  => 'CASCADE',
                    ],
                ]));
            }
        }
    }
}

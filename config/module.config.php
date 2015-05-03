<?php
/**
 * CoolMS2 Address module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAddress for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAddress;

return [
    'controllers' => [
        'invokables' => [
            'CmsAddress\Controller\Admin' => 'CmsAddress\Controller\AdminController',
        ],
    ],
    'router' => [
        'routes' => [
            'cms-admin' => [
                'child_routes' => [
                    'address' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/address[/:controller[/:action[/:id]]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z\-]*',
                                'action' => '[a-zA-Z\-]*',
                                'id' => '[a-zA-Z0-9\-]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'CmsAddress\Controller',
                                'controller' => 'Admin',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type'          => 'gettext',
                'base_dir'      => __DIR__ . '/../language',
                'pattern'       => '%s.mo',
                'text_domain'   => __NAMESPACE__,
            ],
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'cmsAddress' => 'CmsAddress\View\Helper\Address',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . 'Driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . 'Driver',
                ],
            ],
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    'CmsAddress\Mapping\IndividualAddressInterface' => 'CmsAddress\Entity\IndividualAddress',
                    'CmsAddress\Mapping\LegalAddressInterface'      => 'CmsAddress\Entity\LegalAddress',
                    'CmsAddress\Mapping\PostalAddressInterface'     => 'CmsAddress\Entity\PostalAddress',
                    'CmsAddress\Mapping\LocalityInterface'          => 'CmsGeo\Entity\Subdivision\Locality',
                ],
            ],
        ],
        'eventmanager' => [
            'orm_default' => [
                'subscribers' => [
                    'CmsAddress\AddressableSubscriber' => 'CmsAddress\Mapping\AddressableSubscriber',
                ],
            ],
        ],
        'discriminator_map' => [
            'orm_default' => [
                'maps' => [
                    'CmsAddress\Entity\AbstractAddress' => [
                        'CmsAddressIndividualAddress'   => 'CmsAddress\Entity\IndividualAddress',
                        'CmsAddressLegalAddress'        => 'CmsAddress\Entity\LegalAddress',
                        'CmsAddressPostalAddress'       => 'CmsAddress\Entity\PostalAddress',
                    ],
                ],
            ],
        ],
    ],
];

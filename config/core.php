<?php

return [
    /**
             * Service Providers.
         */
    'providers' => [
        /**
         * Global providers.
         */
        OWC\PDC\FAQ\RestApi\RestApiServiceProvider::class,
        OWC\PDC\FAQ\ElasticSearch\ElasticSearchServiceProvider::class,

        /**
         * Providers specific to the admin.
         */
        'admin'    => [
            OWC\PDC\FAQ\Metabox\MetaboxServiceProvider::class,
        ]
    ],

    'dependencies' => [
        [
            'type'    => 'plugin',
            'label'   => 'OpenPDC Base',
            'version' => 'v2.2.13',
            'file'    => 'pdc-base/pdc-base.php',
        ],
    ]

];

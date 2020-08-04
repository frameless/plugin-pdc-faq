<?php

return [
    /**
             * Service Providers.
         */
    'providers' => [
        /**
         * Global providers.
         */
        OWC\PDC\FAQ\RestApi\RestAPIServiceProvider::class,
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
            'version' => '3.0.0',
            'file'    => 'pdc-base/pdc-base.php',
        ],
    ]

];

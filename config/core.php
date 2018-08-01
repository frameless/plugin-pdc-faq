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
];
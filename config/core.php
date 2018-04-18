<?php

return [

    /**
     * Service Providers.
     */
    'providers' => [
        /**
         * Global providers.
         */
	    OWC_PDC_FAQ\Core\RestApi\RestApiServiceProvider::class,

	    /**
         * Providers specific to the admin.
         */
        'admin'    => [
	        OWC_PDC_FAQ\Core\Metabox\MetaboxServiceProvider::class,
        ]

    ],

];
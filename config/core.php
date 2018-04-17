<?php

return [

    /**
     * Service Providers.
     */
    'providers' => [
        /**
         * Global providers.
         */

	    /**
         * Providers specific to the admin.
         */
        'admin'    => [
	        OWC_PDC_FAQ\Core\Metabox\MetaboxServiceProvider::class,
        ]

    ],

];
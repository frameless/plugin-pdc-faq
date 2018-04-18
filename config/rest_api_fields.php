<?php

$pdcItemFaqModel = new \OWC_PDC_FAQ\Core\RestApi\PdcItemFaqModel();

return [

	'pdc-item' => [
		'pdc_faq' => [
			'get_callback'    => [$pdcItemFaqModel, 'getFaqs'],
			'update_callback' => null,
			'schema'          => null,
		]
	]
];
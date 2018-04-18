<?php

$pdcItem = new \OWC_PDC_FAQ\Core\PostTypes\PdcItem();

return [

	'pdc-item' => [
		'pdc_faq' => [
			'get_callback'    => [$pdcItem, 'getFaqsForRestApi'],
			'update_callback' => null,
			'schema'          => null,
		]
	]
];
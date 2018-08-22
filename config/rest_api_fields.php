<?php

$pdcItem = new \OWC\PDC\FAQ\PostTypes\PdcItem();

return [

	'pdc-item' => [
		'pdc_faq' => [
			'get_callback'    => [$pdcItem, 'getFaqsForRestApi'],
			'update_callback' => null,
			'schema'          => null,
		]
	]
];
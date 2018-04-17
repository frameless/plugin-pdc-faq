<?php

return [

	'faq' => [
		'id'         => 'pdc_faqdata',
		'title'      => __('Veelgestelde vragen', 'pdc-faq'),
		'post_types' => ['pdc-item'],
		'context'    => 'normal',
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		'fields'     => [
			'faqs' => [
				'group' => [
					'id'         => 'pdc_faq_group',
					'type'       => 'group',
					'clone'      => true,
					'sort_clone' => true,
					// List of sub-fields
					'fields'     => [
						[
							'id'   => 'pdc_faq_question',
							'name' => __('Vraag', 'pdc-faq'),
							'desc' => _x('', 'Beschrijving bij de Vraag van de FAQ', 'pdc-faq'),
							'type' => 'text',
						],
						[
							'id'   => 'pdc_faq_answer',
							'name' => __('Antwoord', 'pdc-faq'),
							'desc' => _x('Gebruik van HTML is toegestaan', 'Beschrijving bij het Antwoord van de FAQ', 'pdc-faq'),
							'type' => 'wysiwyg',
						]
					]
				]
			]
		]
	]
];


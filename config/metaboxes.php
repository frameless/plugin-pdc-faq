<?php

return [

	'faq' => [
		'id'         => 'pdc_faqdata',
		'title'      => __('Frequently asked questions', 'pdc-faq'),
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
							'name' => __('Question', 'pdc-faq'),
							'desc' => _x('', 'Description for the Question of a FAQ item', 'pdc-faq'),
							'type' => 'text',
						],
						[
							'id'   => 'pdc_faq_answer',
							'name' => __('Answer', 'pdc-faq'),
							'desc' => _x('Use of HTML is allowed', 'Description for the Answer of a FAQ item', 'pdc-faq'),
							'type' => 'wysiwyg',
							// Editor settings, see https://codex.wordpress.org/Function_Reference/wp_editor
							'options' => array(
								'textarea_rows' => 4,
								'teeny'         => false
							),
						]
					]
				]
			]
		]
	]
];


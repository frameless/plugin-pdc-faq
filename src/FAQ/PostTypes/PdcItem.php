<?php

namespace OWC\PDC\FAQ\PostTypes;

class PdcItem
{
	const faq_group_meta_key   = '_owc_pdc_faq_group';
	const faq_answer_meta_key  = 'pdc_faq_answer';

	/**
	 * @param $object
	 * @param $field_name
	 * @param $request
	 *
	 * @return mixed
	 */
	public function getFaqsForRestApi($object, $field_name, $request)
	{
		$faqs = get_post_meta($object['id'], self::faq_group_meta_key, true);

		return $faqs;
	}

	public function getFaqsForElasticSearch($postId)
	{
		$metadata = '';

		$faqs = get_post_meta($postId, self::faq_group_meta_key, true);

		if ( ! empty($faqs) ) {
			foreach ( $faqs as $faq ) {
				$metadata .= $faq[ self::faq_answer_meta_key ];
			}
		}

		return $metadata;
	}
}
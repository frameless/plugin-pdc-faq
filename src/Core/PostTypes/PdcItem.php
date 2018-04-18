<?php

namespace OWC_PDC_FAQ\Core\PostTypes;

class PdcItem
{
	const faq_group_meta_key   = '_owc_pdc_faq_group';
	const faq_answer_meta_key  = 'pdc_faq_answer';
	const faq_elasticsearch_id = 'faq_group';
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

	public function getFaqsForElasticSearch($additionalPreparedMeta, $post_id)
	{
		if ( 'pdc-item' == get_post_type($post_id) ) {

			$metadata = '';

			$faqs = get_post_meta($post_id, self::faq_group_meta_key, true);

			foreach ( $faqs as $faq ) {
				$metadata .= $faq[ self::faq_answer_meta_key ];
			}
			if ( ! empty($metadata) ) {
				$additionalPreparedMeta[ self::faq_elasticsearch_id ] = $metadata;
			}
		}

		return $additionalPreparedMeta;
	}
}
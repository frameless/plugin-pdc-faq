<?php

namespace OWC_PDC_FAQ\Core\RestApi;

class PdcItemFaqModel
{
	/**
	 * @param $object
	 * @param $field_name
	 * @param $request
	 *
	 * @return mixed
	 */
	public function getFaqs($object, $field_name, $request)
	{
		$meta_id = '_owc_pdc_faq_group';
		$faqs    = get_post_meta($object['id'], $meta_id, true);

		return $faqs;
	}
}
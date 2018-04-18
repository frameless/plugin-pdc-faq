<?php

namespace OWC_PDC_FAQ\Core\ElasticSearch;

use OWC_PDC_FAQ\Core\Plugin\ServiceProvider;
use OWC_PDC_FAQ\Core\PostTypes\PdcItem;

class ElasticSearchServiceProvider extends ServiceProvider
{
	const faq_elasticsearch_id = 'faq_group';

	public function register()
	{
		$this->plugin->loader->addFilter('owc/elasticsearch/additional_prepared_meta', $this, 'registerElasticSearchMetaData', 10, 2);
	}

	/**
	 * register metaboxes for settings page
	 *
	 * @param $rwmbMetaboxes
	 *
	 * @return array
	 */
	public function registerElasticSearchMetaData($additionalPreparedMeta, $postId)
	{
		if ( 'pdc-item' == get_post_type($postId) ) {

			$pdcItem = new PdcItem();

			$metadata = $pdcItem->getFaqsForElasticSearch($postId);

			if ( ! empty($metadata) ) {
				$additionalPreparedMeta[ self::faq_elasticsearch_id ] = $metadata;
			}
		}

		return $additionalPreparedMeta;
	}
}
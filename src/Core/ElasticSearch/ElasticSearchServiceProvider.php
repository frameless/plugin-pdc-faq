<?php

namespace OWC_PDC_FAQ\Core\ElasticSearch;

use OWC_PDC_FAQ\Core\Plugin\ServiceProvider;

class ElasticSearchServiceProvider extends ServiceProvider
{

	public function register()
	{
		$pdcItem = new \OWC_PDC_FAQ\Core\PostTypes\PdcItem();
		$this->plugin->loader->addFilter('owc/elasticsearch/additional_prepared_meta', $pdcItem, 'getFaqsForElasticSearch', 10, 2);
	}
}
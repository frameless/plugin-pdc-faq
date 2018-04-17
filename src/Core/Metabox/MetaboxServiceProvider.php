<?php

namespace OWC_PDC_FAQ\Core\Metabox;

use OWC_PDC_FAQ\Core\Plugin\ServiceProvider;

class MetaboxServiceProvider extends ServiceProvider
{

	public function register()
	{

		$this->plugin->loader->addFilter('owc/pdc_base/config/metaboxes', $this, 'registerMetaboxes', 10, 1);
	}

	/**
	 * register metaboxes for settings page
	 *
	 * @param $rwmbMetaboxes
	 *
	 * @return array
	 */
	public function registerMetaboxes($pdcBaseMetaboxes)
	{

		$configMetaboxes = (array)apply_filters('owc/pdc_faq/config/metaboxes', $this->plugin->config->get('metaboxes'));

		return array_merge($pdcBaseMetaboxes, $configMetaboxes);
	}

}
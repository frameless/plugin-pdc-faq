<?php

namespace OWC_PDC_FAQ\Core\Metabox;

use OWC_PDC_FAQ\Core\Plugin\ServiceProvider;

class MetaboxServiceProvider extends ServiceProvider
{

	public function register()
	{
		$this->plugin->loader->addAction('owc/pdc-base/plugin', $this, 'registerMetaboxes', 10, 1);
	}

	/**
	 * register metaboxes for settings page into pdc-base plugin
	 *
	 * @param $plugin
	 *
	 * @return $plugin OWC_PDC_Base\Core\Plugin
	 */
	public function registerMetaboxes( $basePlugin )
	{
		$configMetaboxes = $this->plugin->config->get('metaboxes');
		$basePlugin->config->set( 'metaboxes.faq', $configMetaboxes['faq']);
	}
}
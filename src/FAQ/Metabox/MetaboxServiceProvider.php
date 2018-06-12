<?php

namespace OWC\PDC\FAQ\Metabox;

use OWC\PDC\Base\Foundation\ServiceProvider;

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
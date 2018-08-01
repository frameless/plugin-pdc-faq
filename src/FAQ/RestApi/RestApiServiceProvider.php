<?php

namespace OWC\PDC\FAQ\RestApi;

use OWC\PDC\FAQ\Plugin\ServiceProvider;

class RestApiServiceProvider extends ServiceProvider
{

	public function register()
	{
		$this->plugin->loader->addAction('owc/pdc-base/plugin', $this, 'registerRestApiFields', 10, 1);
	}

	/**
	 * register metaboxes for settings page into pdc-base plugin
	 *
	 * @param $plugin
	 *
	 * @return $plugin OWC\PDC\FAQ\Plugin
	 */
	public function registerRestApiFields( $basePlugin )
	{

		$configRestApiFields = $this->plugin->config->get('rest_api_fields');

		foreach ( $configRestApiFields as $postType => $configRestApiFieldGroup ) {

			foreach ( $configRestApiFieldGroup as $restApiFieldName => $configRestApiField ) {

				$basePlugin->config->set( "rest_api_fields.{$postType}.{$restApiFieldName}", $configRestApiField);
			}
		}
	}

	/**
	 * register endpoint fields for use in the RestApi.
	 */
	public function registerRestApiFields_old($pdcBaseRestApiFields)
	{
		$configRestApiFields = $this->plugin->config->get('rest_api_fields');

		foreach ( $configRestApiFields as $postType => $configRestApiFieldGroup ) {

			foreach ( $configRestApiFieldGroup as $restApiFieldName => $configRestApiField ) {
				$pdcBaseRestApiFields[ $postType ][ $restApiFieldName ] = $configRestApiField;
			}
		}

		return $pdcBaseRestApiFields;
	}
}
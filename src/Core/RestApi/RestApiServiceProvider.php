<?php

namespace OWC_PDC_FAQ\Core\RestApi;

use OWC_PDC_FAQ\Core\Plugin\ServiceProvider;

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
	 * @return $plugin OWC_PDC_Base\Core\Plugin
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
<?php

namespace OWC_PDC_FAQ\Core\RestApi;

use OWC_PDC_FAQ\Core\Plugin\ServiceProvider;

class RestApiServiceProvider extends ServiceProvider
{

	public function register()
	{
		$this->plugin->loader->addFilter('owc/pdc_base/config/rest_api_fields_per_posttype', $this, 'registerRestApiFields', 10, 1);
	}

	/**
	 * register endpoint fields for use in the RestApi.
	 */
	public function registerRestApiFields($pdcBaseRestApiFields)
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
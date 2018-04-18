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
		$configRestApiFields = (array)apply_filters('owc/pdc_faq/config/rest_api_fields', $this->plugin->config->get('rest_api_fields'));

		foreach ( $configRestApiFields['pdc-item'] as $restApiFieldName => $configRestApiField ) {
			$pdcBaseRestApiFields['pdc-item'][ $restApiFieldName ] = $configRestApiField;
		}

		return $pdcBaseRestApiFields;
	}
}
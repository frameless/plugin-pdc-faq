<?php

namespace OWC_PDC_FAQ\Core\Metabox;

use Mockery as m;
use OWC_PDC_FAQ\Core\Config;
use OWC_PDC_FAQ\Core\Plugin\BasePlugin;
use OWC_PDC_FAQ\Core\Plugin\Loader;
use OWC_PDC_FAQ\Core\Tests\Unit\TestCase;

class MetaboxServiceProviderTest extends TestCase
{

	public function setUp()
	{
		\WP_Mock::setUp();
	}

	public function tearDown()
	{
		\WP_Mock::tearDown();
	}

	/** @test */
	public function check_registration_of_metaboxes()
	{
		$config = m::mock(Config::class);
		$plugin = m::mock(BasePlugin::class);

		$plugin->config = $config;
		$plugin->loader = m::mock(Loader::class);

		$service = new MetaboxServiceProvider($plugin);

		$plugin->loader->shouldReceive('addFilter')->withArgs([
			'owc/pdc_base/config/metaboxes',
			$service,
			'registerMetaboxes',
			10,
			1
		])->once();

		$service->register();

		$configMetaboxes = [
			'faq' => [
				'id'     => 'metadata',
				'fields' => [
					'general' => [
						'testfield_noid' => [
							'type' => 'heading'
						],
						'testfield1'     => [
							'id' => 'metabox_id1'
						],
						'testfield2'     => [
							'id' => 'metabox_id2'
						]
					]
				]
			]
		];

		$existingMetaboxes = [
			'base' => [
				'id'     => 'metadata',
				'fields' => [
					'general' => [
						'testfield_noid' => [
							'type' => 'heading'
						],
						'testfield1'     => [
							'id' => 'metabox_id1'
						],
						'testfield2'     => [
							'id' => 'metabox_id2'
						]
					]
				]
			]
		];

		$expectedMetaboxesAfterMerge = [

			'base'                   => [
				'id'             => 'metadata',
				'fields'         => [
					'general' => [
						'testfield_noid' => [
							'type' => 'heading'
						],
						'testfield1'     => [
							'id' => 'metabox_id1'
						],
						'testfield2'     => [
							'id' => 'metabox_id2'
						]
					]
				]
			],
			'faq' => [
				'id'             => 'metadata',
				'fields'         => [
					'general' => [
						'testfield_noid' => [
							'type' => 'heading'
						],
						'testfield1'     => [
							'id' => 'metabox_id1'
						],
						'testfield2'     => [
							'id' => 'metabox_id2'
						]
					]
				]
			]
		];

		$config->shouldReceive('get')->with('metaboxes')->once()->andReturn($configMetaboxes);

		$this->assertEquals($expectedMetaboxesAfterMerge, $service->registerMetaboxes($existingMetaboxes));
	}
}

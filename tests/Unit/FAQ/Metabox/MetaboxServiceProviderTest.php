<?php

namespace OWC\PDC\FAQ\Metabox;

use Mockery as m;
use OWC\PDC\FAQ\Config;
use OWC\PDC\FAQ\Plugin\BasePlugin;
use OWC\PDC\FAQ\Plugin\Loader;
use OWC\PDC\FAQ\Tests\Unit\TestCase;

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

		$plugin->loader->shouldReceive('addAction')->withArgs([
			'owc/pdc-base/plugin',
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

		$config->shouldReceive('get')->with('metaboxes')->once()->andReturn($configMetaboxes);

		$basePlugin         = new \StdClass();
		$basePlugin->config = m::mock(Config::class);

		$basePlugin->config->shouldReceive('set')->withArgs( ['metaboxes.faq', $configMetaboxes['faq']])->once();

		$service->registerMetaboxes($basePlugin);

		$this->assertTrue( true );
	}
}

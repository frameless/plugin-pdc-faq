<?php

namespace OWC_PDC_FAQ\Core\ElasticSearch;

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
	public function check_registration_of_elasticsearch_metadata()
	{
		$config = m::mock(Config::class);
		$plugin = m::mock(BasePlugin::class);

		$plugin->config = $config;
		$plugin->loader = m::mock(Loader::class);

		$service = new ElasticSearchServiceProvider($plugin);

		$plugin->loader->shouldReceive('addFilter')->withArgs([
			'owc/pdc-elasticsearch/elasticpress/postargs/meta',
			$service,
			'registerElasticSearchMetaData',
			10,
			2
		])->once();

		$service->register();

		$additional_prepared_meta          = [];
		$expected_additional_prepared_meta = ['faq_group' => 'antwoord!!'];

		$postID = 5;

		\WP_Mock::userFunction('get_post_type', [
				'args'   => $postID,
				'times'  => '1',
				'return' => 'pdc-item'
			]
		);

		$faq_group_meta = [
			0 => [
				'pdc_faq_question' => 'Vraag??',
				'pdc_faq_answer'   => 'antwoord!!'
			]
		];

		\WP_Mock::userFunction('get_post_meta', [
				'args'   => [
					$postID,
					\WP_Mock\Functions::type('string'),
					true
				],
				'times'  => '1',
				'return' => $faq_group_meta
			]
		);

		$this->assertEquals($expected_additional_prepared_meta, $service->registerElasticSearchMetaData($additional_prepared_meta, $postID));

	}
}

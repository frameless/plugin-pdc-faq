<?php

namespace OWC_PDC_FAQ\Core\RestApi;

use Mockery as m;
use OWC_PDC_FAQ\Core\Config;
use OWC_PDC_FAQ\Core\Plugin\BasePlugin;
use OWC_PDC_FAQ\Core\Plugin\Loader;
use OWC_PDC_FAQ\Core\Tests\Unit\TestCase;
use OWC_PDC_FAQ\Core\PostTypes\PdcItem;

class RestApiServiceProviderTest extends TestCase
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
	public function check_registration_of_RestApi()
	{
		$config = m::mock(Config::class);
		$plugin = m::mock(BasePlugin::class);

		$plugin->config = $config;
		$plugin->loader = m::mock(Loader::class);

		$service = new RestApiServiceProvider($plugin);

		$plugin->loader->shouldReceive('addFilter')->withArgs([
			'owc/pdc_base/config/rest_api_fields_per_posttype',
			$service,
			'registerRestApiFields',
			10,
			1
		])->once();

		$service->register();

		$configRestApiFields = [
			'posttype1' => [
				'endpoint_field3' =>
					[
						'get_callback'    => ['object', 'callback3'],
						'update_callback' => null,
						'schema'          => null,
					]
			]
		];

		$existingRestApiFields = [
			'posttype1' => [
				'endpoint_field1' =>
					[
						'get_callback'    => ['object', 'callback1'],
						'update_callback' => null,
						'schema'          => null,
					],
				'endpoint_field2' =>
					[
						'get_callback'    => ['object', 'callback2'],
						'update_callback' => null,
						'schema'          => null,
					]
			],
			'posttype2' => [
				'endpoint_field1' =>
					[
						'get_callback'    => ['object', 'callback1'],
						'update_callback' => null,
						'schema'          => null,
					],
				'endpoint_field2' =>
					[
						'get_callback'    => ['object', 'callback2'],
						'update_callback' => null,
						'schema'          => null,
					]
			]
		];

		$expectedRestApiFields = [
			'posttype1' => [
				'endpoint_field1' =>
					[
						'get_callback'    => ['object', 'callback1'],
						'update_callback' => null,
						'schema'          => null,
					],
				'endpoint_field2' =>
					[
						'get_callback'    => ['object', 'callback2'],
						'update_callback' => null,
						'schema'          => null,
					],
				'endpoint_field3' =>
					[
						'get_callback'    => ['object', 'callback3'],
						'update_callback' => null,
						'schema'          => null,
					]
			],
			'posttype2' => [
				'endpoint_field1' =>
					[
						'get_callback'    => ['object', 'callback1'],
						'update_callback' => null,
						'schema'          => null,
					],
				'endpoint_field2' =>
					[
						'get_callback'    => ['object', 'callback2'],
						'update_callback' => null,
						'schema'          => null,
					]
			]
		];

		$config->shouldReceive('get')->with('rest_api_fields')->once()->andReturn($configRestApiFields);

		$this->assertEquals( $expectedRestApiFields, $service->registerRestApiFields( $existingRestApiFields ) );
	}

	/** @test */
	public function check_get_faqs_for_rest_api()
	{
		$postID         = 5;
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

		$pdcItem = new PdcItem();

		$object['id'] = $postID;

		$this->assertEquals($faq_group_meta, $pdcItem->getFaqsForRestApi($object, $field_name = '', $request = ''));
	}

}

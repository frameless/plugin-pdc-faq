<?php

namespace OWC\PDC\FAQ\RestAPI;

use Mockery as m;
use OWC\PDC\Base\Foundation\Config;
use OWC\PDC\Base\Foundation\Loader;
use OWC\PDC\Base\Foundation\Plugin;
use OWC\PDC\FAQ\PostTypes\PdcItem;
use OWC\PDC\FAQ\Tests\Unit\TestCase;
use WP_Mock;

class RestAPIServiceProviderTest extends TestCase
{
    public function setUp(): void
    {
        WP_Mock::setUp();
    }

    public function tearDown(): void
    {
        WP_Mock::tearDown();
    }

    /** @test */
    public function check_registration_of_RestAPI()
    {
        $config = m::mock(Config::class);
        $plugin = m::mock(Plugin::class);

        $plugin->config = $config;
        $plugin->loader = m::mock(Loader::class);

        $service = new RestAPIServiceProvider($plugin);

        $service->register();

        $this->assertTrue(true);
    }

    /** @test */
    public function check_get_faqs_for_rest_API()
    {
        $postID         = 5;
        $faq_group_meta = [
            0 => [
                'pdc_faq_question' => 'Vraag??',
                'pdc_faq_answer'   => 'antwoord!!'
            ]
        ];

        WP_Mock::userFunction('get_post_meta', [
            'args'   => [
                $postID,
                \WP_Mock\Functions::type('string'),
                true
            ],
            'times'  => '1',
            'return' => $faq_group_meta
        ]);

        $pdcItem = new PdcItem();

        $object['id'] = $postID;

        $this->assertEquals($faq_group_meta, $pdcItem->getFaqsForRestAPI($object, $field_name = '', $request = ''));
    }
}

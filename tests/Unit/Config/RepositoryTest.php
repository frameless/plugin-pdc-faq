<?php

namespace OWC_PDC_FAQ\Core\Tests\Unit\Config;

use OWC_PDC_FAQ\Core\Config;
use OWC_PDC_FAQ\Core\Tests\Unit\TestCase;

class RepositoryTest extends TestCase
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
    public function gets_value_correctly()
    {
        $repository = new Config(__DIR__ . '/config');
        $repository->boot();

        $config = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'testfile2' => [
                    'in_directory' => 'directory'
                ],
                'multi'     => [
                    'deep' => [
                        'multi_level' => 'works'
                    ]
                ]
            ]
        ];

        $this->assertEquals($config, $repository->all());
        $this->assertEquals($config, $repository->get(false));
        $this->assertEquals(true, $repository->get('test.single_file'));
        $this->assertEquals('directory', $repository->get('directory.testfile2.in_directory'));
        $this->assertEquals('works', $repository->get('directory.multi.deep.multi_level'));
    }

    /** @test */
    public function check_setting_of_path()
    {

        $repository = new Config(__DIR__ . '/config');
        $path       = '/test/path/config/';
        $repository->setPath($path);

        $this->assertEquals($repository->getPath(), $path);
    }

    /** @test */
    public function check_setting_of_protected_nodes()
    {
        $repository = new Config(__DIR__ . '/config');
        $repository->boot();

        $expectedConfig = [
            'test'      => [
                'test'
            ],
            'directory' => [
                'testfile2' => [
                    'in_directory' => 'directory'
                ],
                'multi'     => [
                    'deep' => [
                        'multi_level' => 'works'
                    ]
                ]
            ]
        ];
        $repository->set('test', ['test']);
        $this->assertEquals($expectedConfig, $repository->all());

        $repository->setProtectedNodes(['test']);
        $repository->set('test', ['test2']);
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => 'test'
        ];

        $repository = new Config(__DIR__ . '/config');
        $repository->boot();
        $repository->set('directory', 'test');
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'test' => 'node'
            ]
        ];
        $repository->set('directory', ['test' => 'node']);
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'test' => [
                    'node' => 'nog deeper'
                ]
            ]
        ];
        $repository->set('directory', ['test' => ['node' => 'nog deeper']]);
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'testfile2' => 'test',
                'multi'     => [
                    'deep' => [
                        'multi_level' => 'works'
                    ]
                ]
            ]
        ];

        $repository = new Config(__DIR__ . '/config');
        $repository->boot();
        $repository->set('directory.testfile2', 'test');
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'testfile2' => [
                    'test' => 'node'
                ],
                'multi'     => [
                    'deep' => [
                        'multi_level' => 'works'
                    ]
                ]
            ]
        ];
        $repository->set('directory.testfile2', ['test' => 'node']);
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'testfile2' => [
                    'test' => [
                        'node' => 'nog deeper'
                    ]
                ],
                'multi'     => [
                    'deep' => [
                        'multi_level' => 'works'
                    ]
                ]
            ]
        ];
        $repository->set('directory.testfile2', ['test' => ['node' => 'nog deeper']]);
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'testfile2' => [
                    'in_directory' => 'directory',
                ],
                'multi'     => 'test'
            ]
        ];

        $repository = new Config(__DIR__ . '/config');
        $repository->boot();
        $repository->set('directory.multi', 'test');
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'testfile2' => [
                    'in_directory' => 'directory',
                ],
                'multi'     => [
                    'deep' => 'test'
                ]
            ]
        ];

        $repository = new Config(__DIR__ . '/config');
        $repository->boot();
        $repository->set('directory.multi.deep', 'test');
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'testfile2' => [
                    'in_directory' => 'directory',
                ],
                'multi'     => [
                    'deep' => [
                        'multi_level' => 'works_also_via_set'
                    ]
                ]
            ]
        ];
        $repository->set('directory.multi.deep', ['multi_level' => 'works_also_via_set']);
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'         => [
                'single_file' => true
            ],
            'directory'    => [
                'testfile2' => [
                    'in_directory' => 'directory',
                ],
                'multi'     => [
                    'deep' => [
                        'multi_level' => 'works'
                    ]
                ]
            ],
            'doesnotexist' => [
                'directory' => [
                    'multi' => [
                        'deep' => null
                    ]
                ]
            ]
        ];

        $repository = new Config(__DIR__ . '/config');
        $repository->boot();
        $repository->set('doesnotexist.directory.multi.deep');
        $this->assertEquals($expectedConfig, $repository->all());

        $expectedConfig = [
            'test'      => [
                'single_file' => true
            ],
            'directory' => [
                'testfile2' => [
                    'in_directory' => 'directory',
                ],
                'multi'     => [
                    'deep' => [
                        'multi_level' => 'works'
                    ]
                ]
            ],
            ''          => null
        ];

        $repository = new Config(__DIR__ . '/config');
        $repository->boot();
        $repository->set([null => null]);
        $this->assertEquals($expectedConfig, $repository->all());
    }
}
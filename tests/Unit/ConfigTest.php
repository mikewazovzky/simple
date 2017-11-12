<?php

use Mikewazovzky\Simple\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public $config;

    protected function setUp()
    {
        $this->config = Config::instance();
    }

    /** @test */
    function it_reads_config_data()
    {
        $this->config->loadData('db', null, __DIR__ . '/../../config');
        $this->assertEquals('root', $this->config->get('db', 'user'));
    }
}

<?php

use PHPUnit\Framework\TestCase;
use MWazovzky\Simple\Environment;

class EnvironmentTest extends TestCase
{
    /** @test */
    function it_can_load_env_data_from_file()
    {
        $env = Environment::instance();

        $result = $env->loadData('wrong path');
        $this->assertFalse($result);

        $result = $env->loadData(__DIR__.'/../../.env.example');
        $this->assertTrue($result);
    }

    /** @test */
    function it_can_get_env_param()
    {
        $env = Environment::instance();
        $env->loadData(__DIR__.'/../../.env.example');

        $this->assertEquals('mysql', $env->get('DB_CONNECTION'));
        $this->assertEquals('mysql', env('DB_CONNECTION'));
    }
}

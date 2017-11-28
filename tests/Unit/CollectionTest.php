<?php

use PHPUnit\Framework\TestCase;
use MWazovzky\Simple\Dummy;

class CollectionTest extends TestCase
{
    public $dummy;

    protected function setUp()
    {
        $this->dummy = new Dummy;
    }

    /** @test */
    public function it_implements_array_access()
    {
        $this->dummy['key'] = 'value';
        $this->assertEquals('value', $this->dummy['key']);
    }

    /** @test */
    public function it_implements_array_countable()
    {
        $this->dummy[] = 1;
        $this->assertCount(1, $this->dummy);

        $this->dummy[] = 2;
        $this->assertCount(2, $this->dummy);
    }

    /** @test */
    public function it_implements_array_iterator()
    {
        // Setup dummy values
        $arr = ['one' => 1, 'two' => 2, 'three' => 3];
        foreach ($arr as $key => $value) {
            $this->dummy[$key] = $value;
        }
        // Iterate over dummy
        foreach ($this->dummy as $key => $value) {
            $this->assertEquals($arr[$key], $value);
        }
    }
}

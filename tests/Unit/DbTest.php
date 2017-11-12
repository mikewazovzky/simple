<?php

use Mikewazovzky\Simple\Db;
use Mikewazovzky\Simple\Config;
use PHPUnit\Framework\TestCase;

class DbTest extends TestCase
{
    protected $db;

    protected function setUp()
    {
        $config = Config::instance()->loadData('db', null, __DIR__ . '/../../config');
    }

    /** @test */
    function it_sets_up_db_connection()
    {
        $db = Db::instance();
        $this->assertNotNull($db);
    }

    /** @test */
    public function it_fetch_data_from_database()
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM news';
        $data = $db->queryRaw($sql);

        $this->assertNotNull($data);
    }


}

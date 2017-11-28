<?php

use MWazovzky\Simple\Db;
use MWazovzky\Simple\Config;
use PHPUnit\Framework\TestCase;

class DbTest extends TestCase
{
    protected $db;

    protected function setUp()
    {
        $config = Config::instance()->loadData('db', null, __DIR__ . '/../../config');
        $this->db = Db::instance();
    }

    public function tearDown()
    {
        $this->db->dropTable('test');
    }

    /** @test */
    function it_sets_up_database_connection()
    {
        $this->assertNotNull($this->db);
    }

    /** @test */
    public function it_creates_table()
    {
        $result = $this->createTable('test');

        $this->assertTrue($result);
    }

    /** @test */
    public function it_drops_table()
    {
        $this->createTable('test');

        $result = $this->db->dropTable('test');

        $this->assertTrue($result);
    }

    /** @test */
    public function it_inserts_data()
    {
        $this->createTable($table = 'test');

        $result = $this->db->insert($table, [
            'name' => 'Mike',
            'email' => 'mike@example.com',
        ]);

        $this->assertTrue($result);
    }

    /** @test */
    public function it_fetches_data_from_database()
    {
        $this->createTable($table = 'test');

        $result = $this->db->insert($table, [
            'name' => 'Mike',
            'email' => 'mike@example.com',
        ]);
        $this->assertTrue($result);

        $sql = 'SELECT * FROM ' . $table;
        $data = $this->db->queryRaw($sql);

        $this->assertCount(1, $data);
    }

    /** @test */
    public function it_checks_if_table_exists()
    {
        $result = $this->db->tableExists('test');
        $this->assertFalse($result);

        $this->createTable('test');

        $result = $this->db->tableExists('test');
        $this->assertTrue($result);
    }

    protected function createTable(string $table, array $attributes = null) : bool
    {
        $data = $attributes ?:  [
            'id' => 'int AUTO_INCREMENT PRIMARY KEY',
            'name' => 'varchar(255)',
            'email' => 'varchar(100)'
        ];

        return  $this->db->createTable($table, $data);
    }
}

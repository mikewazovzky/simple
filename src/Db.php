<?php

namespace MWazovzky\Simple;

use MWazovzky\Simple\Exceptions\DatabaseException;

class Db
{
    use Singleton;

    /**
     * @var database connection handler
     */
    protected $dbh;

    /**
     * Set up database connection
     * connection parameters are read from config
     */
    protected function __construct()
    {
        $config = Config::instance()->get('db');

        // Allow to connect manually via Db::connect if no configuration data provided
        if (!isset($config)) {
            return;
        }

        try {
            $this->dbh = $this->connect($config['host'], $config['database'], $config['user'], $config['password']);
        } catch (\PDOException $e) {
            throw new DatabaseException('Db::__constuct: ' . $e->getMessage());
        }
    }

    /**
     * Connect to database
     *
     * @param string $host
     * @param string $dbname - pass null to set up conection without specific a database
     * @param string $user
     * @param string $password - optional
     */
    protected function connect($host, $dbname, $user, $password = '')
    {
        $dbs = "mysql:host={$host};" . ($dbname ? "dbname={$dbname}" : '');

        return new \PDO($dbs, $user, $password);
    }

    /**
     * Perform databse query (no results expected)
     *
     * @param string $sql - sql query request
     * @param array $data - sql request binding values
     * @return bool - true if query performed successfully
     */
    public function execute(string $sql, array $data = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            return $sth->execute($data);
        } catch (\PDOException $e ) {
            throw new DatabaseException('Db::execute: ' . $e->getMessage() );
        }
    }

    /**
     * Perform databse query
     * @param string $sql - sql query request
     * @param array $data - sql request binding values
     * @return array|bool - query results as array in case of success, false if request fails
     */
    public function query(string $class, string $sql, $data = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $result = $sth->execute($data);
            if ($result !== false) {
                return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
            }
            return [];
        } catch (\PDOException $e ) {
            throw new DatabaseException('Db::query: ' . $e->getMessage() );
        }
    }

    /**
     * Perform raw databse query
     * @param string $sql - sql query request
     * @param array $data - sql request binding values
     * @return array|bool - query results as array in case of success, false if request fails
     */
    public function queryRaw(string $sql, $data = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $result = $sth->execute($data);
            if ($result !== false) {
                return $sth->fetchAll(\PDO::FETCH_ASSOC);
            }
            return [];
        } catch (\PDOException $e ) {
            throw new DatabaseException('Db::query: ' . $e->getMessage() );
        }
    }

    /**
     * Databse query Generator
     *
     * @param string $sql - sql query request
     * @param array $data - sql request binding values
     * @return array|bool - query results as array in case of success, false if request fails
     */
    public function queryEach(string $class, string $sql, $data = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);
            $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
            while ($result = $sth->fetch()) {
                yield $result;
            }
        } catch (\PDOException $e ) {
            throw new DatabaseException('Db::query: ' . $e->getMessage() );
        }
    }

    /**
     * Get id of last inserted database record
     *
     * @return intger
     */
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    /**
     *
     * @return array
     */
    public function errorInfo()
    {
        return $this->dbh->errorInfo();
    }

    /**
     * Create database table.
     *
     * @param string $table - table name
     * @param array $attributes - table structure as ['name' => 'varchar(255) PRIMARY KEY']
     */
    public function createTable(string $table, array $attributes)
    {
        $params = '';
        $char = '';
        foreach ($attributes as $name => $type) {
            $params .= "{$char} {$name} {$type}";
            $char = ',';
        }

        $sql = "CREATE TABLE IF NOT EXISTS $table ($params)";

        return $this->execute($sql);
    }

    /**
     * Drop database table.
     *
     * @param string $table
     */
    public function dropTable(string $table)
    {
        $sql = "DROP TABLE IF EXISTS $table";

        return $this->execute($sql);
    }

    /**
     * Insert raw into database.
     *
     * @param string $table
     * @param array $attributes
     */
    public function insert(string $table, array $attributes): bool
    {
        $fields = [];
        $values = [];

        foreach ($attributes as $key => $value) {
            $fields[] = $key;
            $values[":$key"] = $value;
        }

        $sql = 'INSERT INTO ' . $table .
            ' (' . implode(',', $fields) . ')
            VALUES
            (' . implode(',', array_keys($values)) . ')';

        return $this->execute($sql, $values);
    }

    /**
     * Check if table exists.
     *
     * @param string $table
     * @param string|null $database - current database connection is checked if no database provided
     * @return bool
     */
    public function tableExists(string $table, string $database = null)
    {
        $db = $database ?: config('db.database');

        $sql = "SELECT count(*)
            FROM information_schema.TABLES
            WHERE (TABLE_SCHEMA = '$db') AND (TABLE_NAME = '$table')";

        $result =  $this->queryRaw($sql);

        $count = $result[0]['count(*)'];
        return $count != 0;
    }
}

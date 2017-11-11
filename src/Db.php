<?php

namespace Mikewazovzky\Simple;

use Mikewazovzky\Simple\Exceptions\DatabaseException;

class Db
{
    use Singleton;

    /**
     * @var database connection handler
     */
    public $dbh;

    /**
     * Set up database connection
     * connection parameters are read from config.php file
     */
    protected function __construct()
    {
        $config = Config::instance()->data['db'];

        try {
            $this->dbh = new \PDO(
                "mysql:host={$config['host']};dbname={$config['database']}",
                $config['user'],
                $config['password']
            );
        } catch (\PDOException $e ) {
            throw new DatabaseException('Db::__constuct: ' . $e->getMessage() );
        }
    }

    /**
     * Perform databse query (no results expected)
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
     * Databse query Generator
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
;           while ($result = $sth->fetch()) {
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

    public function queryRaw($sql)
    {
        try {
            $stmt = $this->dbh->query($sql);
            if (!$stmt) {
                var_dump($this->errorInfo());
            }
            return $stmt->fetchAll();
        } catch (\PDOException $e ) {
            throw new DatabaseException('Db::query: ' . $e->getMessage() );
        }
    }
}

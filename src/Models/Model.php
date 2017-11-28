<?php

namespace MWazovzky\Simple\Models;

use MWazovzky\Simple\Db;

abstract class Model
{
    /**
     * @var database record id, all model tables should have id field
     */
    public $id;

    /**
     * Get all Model records from a database
     *
     * @param integer $limit - limits the number of records to return
     * @return array of Model (static::class) objects
     */
    public static function getAll($limit = 5)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' LIMIT ' . $limit;
        $results = $db->query(static::class, $sql);
        return $results;
    }

    /**
     * Generator. Yield  Model records from a database
     *
     * @return Model (static::class) objects
     */
    public static function getEach()
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        $generator = $db->queryEach(static::class, $sql);
        foreach ($generator as $item) {
            yield $item;
        }
    }

    /**
     * Find database record with specified id
     *
     * @param integer $id
     * @return object of class Model (static::class)
     */
    public static function findById(int $id)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $data = [':id' => $id];
        $results = $db->query(static::class, $sql, $data);
        return $results[0];
    }

    /**
     * Insert object into database as a record
     *
     * @return bool
     */
    public function insert()
    {
        // construct data required for sql statement
        $fields = [];
        $values = [];

        foreach ($this as $key => $value) {
            if ($key == 'id' || $key == 'time') {
                continue;
            }

            $fields[] = $key;
            $values[":$key"] = $value;
        }

        // build sql statement
        $sql = 'INSERT INTO ' . static::TABLE .
            ' (' . implode(',', $fields) . ')
            VALUES
            (' . implode(',', array_keys($values)) . ')';

        // execute insert
        $db = Db::instance();
        $results = $db->execute($sql, $values);

        if ($results == false) {
            return false;
        }

        // set model id field
        $this->id = $db->lastInsertId();
        return true;
    }

    /**
     * Update object database record with current properties values
     *
     * @return boolean - true if success, false if failure
     */
    public function update()
    {
        // construct data required for sql statement
        $fields = [];
        $values = [];

        foreach ($this as $key => $value) {
            if ($key == 'id' || $key == 'time') {
                continue;
            }
            $fields[] = $key . '=:' . $key;
            $values[":$key"] = $value;
        }
        $values[":id"] = $this->id;

        // build and execute sql statement
        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(',', $fields) . ' WHERE id=:id';
        $db = Db::instance();
        $result = $db->execute($sql, $values);
        return $result;
    }

    /**
     * Save object to database record
     * Model::update() is called for existing database records,
     * Model::insert() for new records
     *
     * @return boolean - true if success, false if failure
     */
    public function save()
    {
        if ($this->id === null) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    /**
     * Delete object record from a database
     *
     * @return boolean - true if success, false if failure
     */
    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        $db = Db::instance();
        $data = [':id' => $this->id ];
        return $db->execute($sql, $data);
    }
}

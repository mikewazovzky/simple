<?php

namespace Mikewazovzky\Simple;

trait Collection
{
    protected $data = [];

    /**
     * Implements ArrayAccess Interface Methods
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if ('' == $offset) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * Implements Iterator Interface Methods
     */
    public function current()
    {
        return current($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function next()
    {
        return next($this->data);
    }

    public function rewind()
    {
        reset($this->data);
    }

    public function valid()
    {
        return false != current($this->data);
    }

    /**
     * Implements Countable Interface Methods
     */
    public function count()
    {
        return count($this->data);
    }
}

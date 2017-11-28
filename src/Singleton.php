<?php

namespace MWazovzky\Simple;

trait Singleton
{
    /**
     * Singleton instance
     *
     * @var object
     */
    protected static $instance;

    /**
     * Instantaniate singleton object
     *
     * @return object
     */
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }
}

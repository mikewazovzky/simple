<?php
namespace Mikewazovzky\Simple;

trait Singleton
{
	protected static $instance;
	public $value;

	protected function __construct() {}
	protected function __clone() {}

	public static function instance()
	{
		if(self::$instance === null) {
			self::$instance = new self;
		}
		return self::$instance;
	}
}
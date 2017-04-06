<?php
namespace Mikewazovzky\Simple;

trait Magic 
{
	/**
	 * Magic methods __set, __get, __isset methods
	 * hanle request to non-existing properties
	 */
	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}
	public function __get($key)
	{
		return $this->data[$key];
	}	
	public function __isset($key)
	{
		return isset($this->data[$key]);
	}	
}
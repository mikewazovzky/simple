<?php
namespace Mikewazovzky\Simple;
/**
 * Implements Iterator interface 
 * to use the trait Class should have an (array) $data property
 */
trait Iterator 
{
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
		next($this->data);
	}
	public function rewind()
	{
		reset($this->data);
	}
	public function valid() : bool 
	{
		return key($this->data) !== null;	
	}
}
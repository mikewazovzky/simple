<?php
namespace Mikewazovzky\Simple;
/**
 * Implements ArrayAccess interface 
 * to use the trait class should have an (array) $data property
 */
trait ArrayAccess 
{
	public function offsetExists ($offset ) : bool
	{
		return array_key_exists($offset, $this->data);
	}
	public function offsetGet ($offset ) 
	{
		return $this->data[$offset] ?: null;
	}
	public function offsetSet ($offset, $value )
	{
		if ('' == $offset) {
			$this->data[] = $value;
		} else {
			$this->data[$offset] = $value;
		}		
	}
	public function offsetUnset ($offset )
	{
		unset($this->data[$offset]);
	}
}
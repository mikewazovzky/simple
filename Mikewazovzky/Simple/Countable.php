<?php
namespace Mikewazovzky\Simple;

trait Countable
{
	/**
	 * Count object elements. 
	 * Countable interface implementation
	 */
	public function count()
	{
		return count($this->data);
	}
}

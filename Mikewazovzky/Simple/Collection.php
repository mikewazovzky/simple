<?php
namespace Mikewazovzky\Simple;

trait Collection
{
	use Countable;	
	use ArrayAccess;
	use Iterator;
	/**
	 * @var array $data - array to store Collection data 
	 */
	protected $data = [];
}
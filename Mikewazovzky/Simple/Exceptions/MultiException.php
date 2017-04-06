<?php
namespace Mikewazovzky\Simple\Exceptions;
use Mikewazovzky\Simple\Collection;

class MultiException extends \Exception implements \ArrayAccess, \Iterator, \Countable
{
	use Collection;
}
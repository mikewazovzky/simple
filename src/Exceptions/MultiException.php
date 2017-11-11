<?php

namespace Mikewazovzky\Simple\Exceptions;

use Mikewazovzky\Simple\Collection;
use Mikewazovzky\Simple\BasicException;

class MultiException implements \ArrayAccess, \Iterator, \Countable
{
    use Collection;
}

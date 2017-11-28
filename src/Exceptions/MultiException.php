<?php

namespace MWazovzky\Simple\Exceptions;

use MWazovzky\Simple\Collection;
use MWazovzky\Simple\BasicException;

class MultiException implements \ArrayAccess, \Iterator, \Countable
{
    use Collection;
}

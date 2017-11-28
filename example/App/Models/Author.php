<?php

namespace App\Models;

use MWazovzky\Simple\Models\Model;

class Author extends Model
{
    const TABLE = 'authors';
    /**
     * Table structure
     * integer auto_increment $id
     * varchar(100) $name
     * varchar(100) $email
     */
    public $name;
    public $email;
}

<?php
namespace News\Models;

use Mikewazovzky\Simple\Models\Model;

class Author extends Model
{
    const TABLE = 'authors';

    public $name;
    public $email;
}
<?php
namespace Mikewazovzky\Simple\Models;

class Author extends Model
{
    const TABLE = 'authors';

    public $name;
    public $email;
}
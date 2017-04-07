<?php
namespace Mikewazovzky\News\Models;

class Author extends Model
{
    const TABLE = 'authors';

    public $name;
    public $email;
}
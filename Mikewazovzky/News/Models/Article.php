<?php
namespace Mikewazovzky\News\Models;

use Mikewazovzky\Simple\Exceptions\MultiException;

class Article extends Model
{
    const TABLE = 'news';

    public $title;
    public $body;    
    public $author_id;
    public $time;

    public function __get($key)
    {
    	if ($key != 'author' || $this->author_id == null) {
    		return null;
    	}

    	$author = Author::findById($this->author_id);
    	return $author->name;
    }

    public function fill(array $parameters)
    {
        $exception = new MultiException;
        // add validation, define the rules, now all can be set empty strings 
        if(!empty($parameters['title'])) {
            $this->title = $this->sanitizeString($parameters['title']);
        } else {
            $exception[] = new \Exception('Wrong title: cannot be empty');
        }

        if(!empty($parameters['body'])) {
            $this->body = $this->sanitizeString($parameters['body']);
        } else {
            $exception[] = new \Exception('Wrong body: cannot be empty');
        }

        if(!empty($parameters['author_id'])) {
            $this->author_id = (int) $parameters['author_id'];
        } else {
            $exception[] = new \Exception('Wrong author_id: cannot be empty');
        }        

        if(count($exception) != 0) {
            throw $exception;
        } 

        // var_dump($this);
        // die();

    }        
    
    public function sanitizeString($data)
    {
        return htmlspecialchars($data);
    }  
}
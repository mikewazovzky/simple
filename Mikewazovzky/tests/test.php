<?php
require __DIR__ . '/../vendor/autoload.php';

use Mikewazovzky\Simple\Models\Article;

foreach (Article::getEach() as $article) {
	echo '<br>', $article->title;
}
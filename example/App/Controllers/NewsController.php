<?php

namespace App\Controllers;

use App\Models\Article;
use MWazovzky\Simple\Controllers\Controller;
use MWazovzky\Simple\Exceptions\NodataException;

class NewsController extends Controller
{
    /**
     * Load Index Page with all news data
     */
    protected function index()
    {
        $this->view->articles = Article::getAll();
        $this->view->display('news.php');
    }

    /**
     * Load Single Article Page with Article data
     */
    protected function show()
    {
        $id = (int) $_GET['id'];
        $article = Article::findById($id);

        if (! $article) {
            throw new NodataException('NodataException: can not find article with id = ' . $id );
        }

        $this->view->article = $article;
        $this->view->display('show.php');
    }
}

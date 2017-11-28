<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Article;

class AdminController extends NewsController
{
    /**
     * Load Index Page with all news data
     */
    protected function index()
    {
        $this->view->admin = true;
        $this->view->authors = Author::getAll();
        $this->view->button = 'Save';

        parent::index();
    }

    /**
     * Load article Edit Page
     *  article id is fetched from GET request parameter
     *  article current parameters are loaded from a database
     */
    protected function edit()
    {
        $id = (int) $_GET['id'];
        $this->view->article = $this->getArticle($id);
        $this->redirect('index');
    }

    /**
     * Save article to a database
     *  article data are fetched from POST request parameters
     */
    protected function save()
    {
        $id  = isset($_POST['id'])  ? (int) $_POST['id']  : null;
        $article = $id  ? $this->getArticle($id) : new Article;

        try {
            $article->fill($_POST);
            $article->save();
        } catch (MultiException $e) {
            $this->view->errors = $e;
        }

        $this->index();
    }

    /**
     * Delete article from a database
     *  article id is fetched from GET request parameter
     */
    protected function delete()
    {
        $id = (int) $_GET['id'];
        $article = $this->getArticle($id);
        $article->delete();
        $this->redirect();
    }

    /**
     * Redirect
     * @param string|null $action - specified controller
     */
    /**
     * Fetch article form a database
     * @param integer $id
     * @return \App\Models\Article
     * @throws \App\Exceptions\NodataException if no artcile found
     */
    protected function getArticle($id)
    {
        $article = Article::findById($id);
        if (! $article) {
            throw new NodataException('NodataException: can not find article with id = ' . $id );
        }
        return $article;
    }
}

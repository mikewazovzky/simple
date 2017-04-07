<?php
namespace Mikewazovzky\News\Controllers;

use Mikewazovzky\News\Models\Article;
use Mikewazovzky\News\Models\Author;
use Mikewazovzky\Simple\Exceptions\NodataException;
use Mikewazovzky\Simple\Exceptions\MultiException;

class Admin extends Client 
{
	/**
	 * Load Index Page with all news data
	 */
	protected function actionIndex()
	{
		$this->view->admin = true;
		$this->view->authors = Author::getAll();
		$this->view->button = 'Save';

		parent::actionIndex();
	}
	/**
	 * Load article Edit Page
	 *  article id is fetched from GET request parameter
	 * 	article current parameters are loaded from a database 
	 */
	protected function actionEdit()
	{
		$id = (int) $_GET['id'];
		$this->view->article = $this->getArticle($id);
		$this->redirect('Index');
	}
	/**
	 * Save article to a database
	 *	article data are fetched from POST request parameters
	 */
	protected function actionSave()
	{
		$id  = isset($_POST['id'])  ? (int) $_POST['id']  : null;
		$article = $id  ? $this->getArticle($id) : new Article;

		try {
			$article->fill($_POST);
			$article->save();	

		} catch (MultiException $e) {
			$this->view->errors = $e;			
		}

		$this->actionIndex();
	}
	/**
	 * Delete article from a database
	 *  article id is fetched from GET request parameter
	 */
	protected function actionDelete()
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
	protected function redirect($action = 'Index')  
	{
		$this->action($action);
	}
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
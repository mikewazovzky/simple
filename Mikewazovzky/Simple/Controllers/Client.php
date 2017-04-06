<?php
namespace Mikewazovzky\Simple\Controllers;
use Mikewazovzky\Simple\Models\Article;
use Mikewazovzky\Simple\Exceptions\NodataException;

class Client extends Controller 
{
	/**
	 * Load Index Page with all news data
	 */
	protected function actionIndex()
	{
		$this->view->articles = Article::getAll();
		$this->view->display(__DIR__ . '/../../news/templates/news.php');
	}
	/**
	 * Load Single Article Page with Article data
	 */
	protected function actionSingle()
	{
		$id = (int) $_GET['id'];
		$article = Article::findById($id);	
					
		if (! $article) {
			throw new NodataException('NodataException: can not find article with id = ' . $id );
		}

		$this->view->article = $article;	
		$this->view->display(__DIR__ . '/../../news/templates/single.php');
	}
}
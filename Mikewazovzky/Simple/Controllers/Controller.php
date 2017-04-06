<?php
namespace Mikewazovzky\Simple\Controllers;
use Mikewazovzky\Simple\View;

class Controller
{
	/**
	 * @var Mikewazovzky\Simple\View object
	 */
	protected $view;

	public function __construct()
	{
		$this->view = new View;
	}
	/**
	 * Proxy: select and call proper action method
	 */
	public function action($action)
	{
		$this->beforeAction();
		$method = 'action' . $action;
		return $this->$method();
	}
	/**
	 * Method called before every action
	 */
	protected function beforeAction()
	{
		//  whatever ...
	}
}
<?php
namespace Mikewazovzky\Simple;

use Mikewazovzky\Simple\Exceptions\NodataException;

class Config
{
	use Singleton;
	public $data;

	public function __construct($filename = null)
	{
		if ($filename == null) {
			$filename = $_SERVER['DOCUMENT_ROOT'] .'/environment.php';
		}
		
		
		if (!file_exists($filename)) {
			throw new NodataException('Configuration file ' . $filename . ' not found.');
		}
		
		
		$this->data = include $filename;
	}

} 
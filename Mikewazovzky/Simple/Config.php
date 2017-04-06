<?php
namespace Mikewazovzky\Simple;

class Config
{
	use Singleton;
	public $data;

	public function __construct($filename = null)
	{
		if ($filename == null) {
			$filename = __DIR__ . '/../../environment.php';
		}
		$this->data = include $filename;
	}

} 
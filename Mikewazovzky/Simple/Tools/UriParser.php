<?php
namespace Mikewazovzky\Simple\Tools;

class UriParser
{
	protected $segments;
	protected $parameters;
	
	public function __construct($uri)
	{
		$this->segments = explode ('/', $uri);

		$count = count($this->segments);
		$params = str_replace('?', '', $this->segments[$count-1]);
		$items = explode('&', $params);
		foreach ($items as $item) {
			list($key, $value) = explode('=', $item);
			$this->parameters[$key] = $value;
		}
	}
	/**
	 * Return uri segment
	 * @param integer $index - segment serial number starting from 1
	 */
	public function segment($index)
	{
		$length = count($this->segments) - 1;
		if ($index < 1 || $index >= $length ) {
			return null;
		}
 		return $this->segments[$index];
	}
	/**
	 * Return uri parameter(s)
	 * @param mixed $key parameter key, default value is null
	 * @return string|null|array 
	 *		string parameters[key] if parameter exists, 
	 *		null if parameters[key] does not exist
	 *		array of all parameters if argument $key is set to null or not provided 
	 */
	public function parameter($key = null)
	{
		if($key === null) {
			return $this->parameters;
		}	
		return $this->parameters[$key] ?: null;
	}
}
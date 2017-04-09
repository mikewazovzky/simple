<?php
namespace Mikewazovzky\Simple;
/**
 * Class View provides user presentation based on template and set of data.
 * 
 * All data needed to constract a presenation are stored within a protected 
 * array   $data  property  and  are  directly  accessible  by  their  name 
 * (array key)  within a template  using  PHP magic methods implemented via 
 * App\Miagic trait.
 * Class  View  implements ArrayAccess, Countable, and Iterator interfaces.  
 * Interfaces are build upun $data array  property and are  implemented via 
 * traits.
 * @package Smart MVC
 * @author Mike Wazovzky (mike.wazovzky@gmail.com)
 * @version 1.0
 */
class View implements \Countable, \ArrayAccess, \Iterator 
{
	use TCollection;
	/**
	 * Renders view to a string
 	 * @param string $template path to template file
	 * @return string
	 */
	public function render($template)
	 {
	 	// split data[] to local variables available within a template
	 	foreach ($this->data as $key => $value) {
	 		$$key = $value;
	 	}
	 	
	 	ob_start();
	 	include($template);
	 	$content = ob_get_contents();
	 	ob_get_clean();
	 	return $content;
	 } 
	/**
	 * Display view
	 */
	public function display($template)
	{
		echo $this->render($template);
	}	 
	/**
	 * Pass data ['key' => value] needed to render template
	 * @deprecated - replaced by Magic trait to set View data
	 * @param mixed - data key
	 * @param mixed - data value
	 */
	public function assign($key, $value)
	{
		$this->data[$key] = $value;
	}
}
<?php

namespace Mikewazovzky\Simple;

class View
{
    use Magic;

    /**
     * Render view template to the string.
     * Populated template data
     *
     * @param string $template
     * @return string
     */
    public function render($template, $templatePath = null)
    {
        // Create vars available to template
        foreach ($this->data as $prop => $value) {
            $$prop = $value;
        }

        $path = $templatePath ?: '/../../../../templates';

        ob_start();
        include __DIR__ . $path . '/' .$template;
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

    /**
     * Display (echo) template
     *
     * @param type name
     * @return type
     */
    public function display($template, $path = null)
    {
        echo $this->render($template, $path);
    }
}

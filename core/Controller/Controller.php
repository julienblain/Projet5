<?php


namespace Core\Controller;


class Controller
{
    protected $viewPath;
    protected $template;

    //appelé par les controleurs enfants pour generer la page
    protected function render(string $view, array $variables = []) {
        ob_start();
        if (!empty($variables)) {
            //imports variables in the array, and return them at the view
            extract($variables);
        }
//var_dump($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');

        $content = ob_get_clean();
        require($this->viewPath . 'templates/' . $this->template . '.php');
    }
}
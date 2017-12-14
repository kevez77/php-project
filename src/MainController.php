<?php
namespace Itb;

class MainController
{
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function indexAction()
    {
        $template = 'main.html.twig';
        $args = [
            'pageTitle' => 'Home'
        ];

        $html = $this->twig->render($template, $args);
        print $html;

    }

    public function loginAction()
    {
        $template = 'login.html.twig';
        $args = [
            'pageTitle' => 'Login'
        ];

        $html = $this->twig->render($template, $args);
        print $html;

    }

    public function aboutAction()
    {
        $template = 'about.html.twig';
        $args = [
            'pageTitle' => 'About'
        ];

        $html = $this->twig->render($template, $args);
        print $html;

    }

}
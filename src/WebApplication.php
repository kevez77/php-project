<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 13/12/2017
 * Time: 18:18
 */

namespace Itb;


class WebApplication
{
    private $maincontroller;
    private $logincontroller;
    private $registerController;

    const PATH_TO_TEMPLATE = __DIR__ . '/../views';

                public function __construct()
                {
                $twig = new\Twig\Environment(new \Twig_Loader_Filesystem( self::PATH_TO_TEMPLATE));
                $this->maincontroller = new MainController($twig);
                $this->registerController = new RegisterController($twig);
                }

    public function run(){
                    $action = filter_input(INPUT_GET,'action');
                    if(empty($action)){
                        $action = filter_input(INPUT_POST,'action');
                    }

                    switch($action){
                        case 'about':
                            $this->maincontroller->aboutAction();
                            break;

                        case 'login':
                            $this->maincontroller->loginAction();
                            break;

                        case 'home':
                        default:
                            $this->maincontroller->indexAction();

                    }
    }
}
<?php
namespace Itb;

class RegisterController
{
    private $loginController;

    public function __construct()
    {
        $this->loginController = new LoginController();
    }

    public function adminHomeAction()
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        if ($isLoggedIn){
            $username = $this->loginController->usernameFromSession();
            require_once __DIR__ . '/../templates/admin/index.php';
        } else {
            $message = 'UNAUTHORIZED ACCESS - the Guards are on their way to arrest you ...';
            require_once __DIR__ . '/../templates/message.php';
        }
    }

    public function adminCodesAction()
    {
        $isLoggedIn = $this->loginController->isLoggedInFromSession();
        if ($isLoggedIn){
            $username = $this->loginController->usernameFromSession();
            require_once __DIR__ . '/../templates/admin/codes.php';
        } else {
            $message = 'UNAUTHORIZED ACCESS - the Guards are on their way to arrest you ...';
            require_once __DIR__ . '/../templates/message.php';
        }
    }


}
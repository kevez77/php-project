<?php
namespace Itb;

class LoginController
{

    public function logoutAction()
    {
        // remove 'user' element from SESSION array
        unset($_SESSION['user']);

        // redirect to index action
        $mainController = new MainController();
        $mainController->indexAction();
    }

    public function processLoginAction()
    {
        // default is bad login
        $isLoggedIn = false;

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // search for user with username in repository
        $isLoggedIn = User::canFindMatchingUsernameAndPassword($username, $password);

        // action depending on login success
        if($isLoggedIn){
            // STORE login status SESSION
            $_SESSION['user'] = $username;

            require_once __DIR__ . '/../templates/loginSuccess.php';
        } else {
            $message = 'bad username or password, please try again';
            require_once __DIR__ . '/../templates/message.php';
        }
    }


    //--------- helper functions -------


    public function isLoggedInFromSession()
    {
        $isLoggedIn = false;

        // user is logged in if there is a 'user' entry in the SESSION superglobal
        if(isset($_SESSION['user'])){
            $isLoggedIn = true;
        }

        return $isLoggedIn;
    }

    public function usernameFromSession()
    {
        $username = '';

        // extract username from SESSION superglobal
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user'];
        }

        return $username;
    }



}
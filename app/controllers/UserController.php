<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Task;
use App\Models\User;

/**
 * Class AccountController
 * @package App\Controllers
 */
class UserController extends Controller {
    public static function isAuthorized(){
        if  (isset($_SESSION['valid']) && $_SESSION['valid'] && $_SESSION['username'] == 'admin')
            return true;
        else return false;
    }

    /**
     * Auth user
     *
     * @param array $data
     */
	public function login($data = []) {
        session_start();

	    $user = new User();
        $userNameInput = trim(custom_filter_var($data['username']));
        $passwordInput = trim(custom_filter_var($data['password']));

        $findUser = $user->findOne(['username' => $userNameInput]);

        if ($findUser && !empty($findUser) && md5($passwordInput) == $findUser['password']) {
            $_SESSION['valid'] = true;
            $_SESSION['username'] = $userNameInput;
            $code = 20000;
        } else {
            $code = 50000;
        }
        $_SESSION['code']=$code;
        $this->view->redirect('/task');

	}

    /**
     * Logout auth user
     */
	public function logout() {
        clear_session();
        $this->view->redirect('/');
	}


}
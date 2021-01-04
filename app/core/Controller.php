<?php

namespace App\Core;

/**
 * Class Controller
 * @package App\Core
 */
abstract class Controller {

    /**
     * @var
     */
	public $route;

    /**
     * @var View
     */
	public $view;

    /**
     * @var
     */
	public $acl;

	/**
     * @var
     */
	public $message;

    /**
     * Controller constructor.
     * @param $route
     */
	public function __construct($route) {
	    session_start();
		$this->route = $route;
        $this->view = new View($route);
		if (!$this->checkAcl()) {
		    if($route['controller']=='task' and $route['action']=='update')
                $this->view->response(['message'=>$this->message]);
		    else {
		        $_SESSION['code']=50000;
		        $_SESSION['message']=$this->message;
		        View::redirect('/');
		    }
		}

		$this->model = $this->loadModel($route['controller']);
	}

	public function loadModel($name) {
		$path = 'App\Models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

    /**
     * Check permission
     *
     * @return bool
     */
	public function checkAcl() {
		$this->acl = require 'app/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) {
			return true;
		}
		elseif($this->isAcl('authorize')) {
		    if(isset($_SESSION['username'])) return true; else
		    $this->message='Вам нужно авторизовать';
		}
		elseif ( $this->isAcl('guest')) {
            if(!isset($_SESSION['username'])) return true; else
            $this->message='Это действия запрешено для авторизованных';
		}
		elseif ( $this->isAcl('admin')) {
            if(isset($_SESSION['admin']) ) return true; else
                $this->message='Это действия разрешено только для админстратором';
		}
		return false;
	}

    /**
     * @param $key
     * @return bool
     */
	public function isAcl($key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}
}
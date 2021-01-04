<?php

namespace App\Core;

/**
 * Class View
 * @package App\Core
 */
class View {

    /**
     * @var
     */
	public $path;

    /**
     * @var
     */
	public $route;

    /**
     * @var string
     */
	public $layout = 'default';

    /**
     * View constructor.
     * @param $route
     */
	public function __construct($route) {
		$this->route = $route;
	}

    /**
     * Rendering
     *
     * @param $view
     * @param array $vars
     */
	public function render($view, $vars = []) {
        $this->path = str_replace('.', '/', $view);
		extract($vars);
		$path = 'app/views/'. $this->path .'.php';
		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'app/views/layouts/'.$this->layout.'.php';
		}
	}

    /**
     * Redirect function
     *
     * @param $url
     */
	public static function redirect($url) {
		header('location: '.$url);
		exit;
	}

    /**
     * @param $code
     */
	public static function errorCode($code) {
		http_response_code($code);
		$path = 'app/views/errors/'.$code.'.php';
		if (file_exists($path)) {
			require $path;
		}
		exit;
	}

    /**
     * @param $status
     * @param $message
     */
	public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

    /**
     * @param $url
     */
	public function location($url) {
		exit(json_encode(['url' => $url]));
	}

    /**
     * Response json data
     *
     * @param array $data
     */
	public function response($data = []) {
		echo json_encode($data);
		exit();
	}

}	
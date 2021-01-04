<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Task;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends Controller {

    /**
     * Home page
     */
	public function index() {
        $this->view->redirect('task');
	}

}
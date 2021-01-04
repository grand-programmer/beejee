<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Task;

/**
 * Class TaskController
 * @package App\Controllers
 */
class TaskController extends Controller {

    /**
     * List tasks
     */
    public function index($query = []) {
        $tasks = new Task();
        $this->view->render('main.index', [
            'data'=>$tasks->getTasks($query),
            'count' => count($tasks->findAllWithoutQuery())
        ]);
    }

    /**
     * Create a tasks
     *
     * @param array $data
     */
    public function create($data = [])
    {
        $task = new Task();
        $task->load($data);

        if ($task->validate() and $task->save()) {
            $message = 'Task created';
        } else {
            $message = implode("\n",$task->getErrors());
        }

        $this->view->response([
            'message' => $message,
        ]);
    }

    /**
     * Get one item
     *
     * @param $data
     */
    public function show($data)
    {
        $task = new Task();
        $result = $task->findOne($data);

        if ($result || !empty($result)) {
            $code = 20000;
        } else {
            $code = 50000;
        }

        $this->view->response([
            'code' => $code,
            'message' => 'Task updated',
            'data' => $result
        ]);
    }

    /**
     * Update a tasks
     *
     * @param $data
     */
    public function update($data)
    {
        $task = new Task();
        $olddata=$task->findOne(['id'=>intval($data['id'])]);
        if(!$olddata) {
            $this->view->response([
                'code' => 50000,
                'message' => 'Task not found'
            ]);
            exit();
        }
        $task->load($olddata);
        $task->status = isset($data['status']) && $data['status'] == 'on' ? 1 : 0;
        if(!empty($data['task']) and $data['task']!=$olddata['task'])
        {
            $task->editedbyadmin=1;
        }
        $task->id=$olddata['id'];

        if(isset($data['task']) and !empty($data['task']))
        {
            $task->task=custom_filter_var($data['task']);
        }
        if(!$task->validate()) {
            $this->view->response([
                'code' => 50000,
                'message' => implode("\n",$task->getErrors()),
            ]);
            exit();
        }
        $result = $task->save();
        if ($result)
        {
            $code = 20000;
            $message='Task updated';
        } else
        {
            $code = 50000;
            $message='Error!';
        }
        $this->view->response([
            'code' => $code,
            'message' => $message
        ]);
    }

}
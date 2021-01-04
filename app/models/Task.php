<?php

namespace App\Models;

use App\Core\Model;

/**
 * Class Task
 * @package App\Models
 */
class Task extends Model {

    public $id;
    public $username;
    public $email;
    public $task;
    public $status;
    public $editedbyadmin;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * @var string
     */
    protected $table = 'tasks';

    /**
     * @param array $query
     * @return array
     */
    public function getTasks($query = [])
    {
        $result = $this->findAll($query);

        return $result;
    }
    public function load($data) {
        //you could use the filter_var function to read the values form the $data array. this is just an example

        $this->id =intval($data['id']);
        $this->username =custom_filter_var($data['username']);
        $this->task = custom_filter_var($data['task']);
        $this->email =custom_filter_var( $data['email']);
        $this->status = intval($data['status']);
        $this->editedbyadmin = intval($data['editedbyadmin']);
    }

    //this is where your form validation logic goes
    //return true if all fields are valid or false if a validation fails
    public function validate() {
        $result=true;
        if(empty($this->username)) {
            $this->addError('username', 'Username field is required');
            $result= false;
        }
        if(empty($this->email)) {
            $this->addError('email', 'Email field is required');
            $result= false;
        }
        if(empty($this->task)) {
            $this->addError('task', 'Task text field is required');
            $result= false;
        }
        if(!empty($this->email) and !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->addError('email', 'This is email not a valid email address');
            $result= false;
        }
        return $result;
    }
    public function save($validation=true)
    {
        $data['id']=$this->id;
        $data['username']=$this->username;
        $data['email']=$this->email;
        $data['task']=$this->task;
        $data['status']=$this->status;
        $data['editedbyadmin']=$this->editedbyadmin;
        if($validation and !$this->validate())
            {
                return false;
            }
        return parent::save($data);
    }


}
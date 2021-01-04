<?php

namespace App\Models;

use App\Core\Model;

class User extends Model {

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
    protected $hidden = ['password'];

    /**
     * @var string
     */
    protected $table = 'users';

    public function load($data){

    }
    public function validate(){

    }
}
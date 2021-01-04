<?php

namespace App\Core;

use App\Lib\Db;

/**
 * Class Model
 * @package App\Core
 */
abstract class Model {

    /**
     * @var Db
     */
    public $db;

    /**
     * @var string
     */
    protected $table = '';

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

    protected $_errors = array();

    //add an error for an attribute if the validation fails
    public function addError($attribute, $error) {
        $this->_errors[$attribute] = $error;
    }

    //get the error for an attribute
    public function getError($attribute) {
        return (isset($this->_errors[$attribute])) ? $this->_errors[$attribute] : '';
    }
    //get all errors for all attributes
    public function getErrors() {
        return $this->_errors;
    }

    public abstract function load($data);
    public abstract function validate();

    /**
     * Model constructor.
     */
    public function __construct() {
        $this->db = new Db;
    }

    /**
     * Create a new item
     *
     * @param array $data
     * @return bool
     */
    public function save($data = [])
    {

        $columns = [];
        $values = [];

        if(isset($data['id']) and !empty($data['id'])) {

            foreach ($data as $key => $value) {
                if($key!='id'){
                    array_push($columns, $key . "=:" . $key);
                    array_push($values, $value);
                }
            }
            $listColumns = implode(',', $columns);
            $sql = "UPDATE $this->table SET $listColumns WHERE id=:id";

        }
        else
        {

            foreach ($data as $key => $value) {

                array_push($columns, $key);
                array_push($values, $value);

            }

            $listColumns = implode(',', $columns);

            $columnsForSave = ":" . implode(', :', $columns);

            $sql = "INSERT INTO $this->table ($listColumns) VALUES ($columnsForSave)";

        }

        $stmt = $this->db->save($sql, $data);
        return $stmt;
    }

    /**
     * Get all items
     *
     * @param array $query
     * @return array
     */
    public function findAll($query = [])
    {
        $sort = 'desc';
        $column = 'username';
        $page = 1;
        $limit = 3;
        if (!empty($query)) {

            if (isset($query['column'])) {
                $column = $query['column'];
            }

            if (isset($query['sort'])) {
                $sort = $query['sort'];
            }
            if (isset($query['page'])) {
                $page = $query['page'];
            }
            if (isset($query['limit'])) {
                $limit = $query['limit'];
            }
        }
        // Offset
        $paginationStart = ($page- 1) * $limit;
        $rows= $this->db->row('SELECT * FROM ' . $this->table . ' ORDER BY ' . $column . ' ' . $sort . ' LIMIT ' . $paginationStart .', ' . $limit . ' ');
        $options=[
            'perPage'=>$limit,
            'page'=>$page,
            'sort'=>$sort,
            'column'=>$column
        ];
        return [
            'tasks'=>$rows,
            'options'=>$options,
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public function findOne($data)
    {
        $column = '';
        foreach ($data as $key => $value) {
            $column =  $key . "=:" . $key;
        }

        $sql = "SELECT * FROM $this->table WHERE $column";
        return $this->db->find($sql, $data);
    }

    /**
     * Get all items without query
     *
     * @return array
     */
    public function findAllWithoutQuery()
    {
        return $this->db->row('SELECT * FROM ' . $this->table . ' ');
    }



}
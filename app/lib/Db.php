<?php

namespace App\Lib;

use PDO;

/**
 * Class Db
 * @package App\lib
 */
class Db {

    /**
     * @var PDO
     */
	protected $db;

    /**
     * Db constructor.
     */
	public function __construct() {
		$config = require 'app/config/db.php';
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
	}

    /**
     * @param $sql
     * @param array $params
     * @return bool|\PDOStatement
     */
	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				$stmt->bindValue(':'.$key, $val);
			}
		}
		$stmt->execute();
		return $stmt;
	}

    /**
     * @param $sql
     * @param array $params
     * @return array
     */
	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

    /**
     * @param $sql
     * @param array $data
     * @return mixed
     */
	public function find($sql, $data = []) {

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch();
	}

    /**
     *
     * @param $sql
     * @param array $data
     * @return bool
     */
	public function save($sql, $data = [])
    {
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
	}

    /**
     * @param $sql
     * @param array $params
     * @return mixed
     */
	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}


}
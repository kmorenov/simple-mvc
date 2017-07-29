<?php

namespace Core;

use PDO;

abstract class Model
{
    protected static $conn;
    
    protected $table;

    public function __construct()
    {
        if (!self::$conn) {
            $dns = sprintf("mysql:host=%s;dbname=%s;charset=%s", DB_HOSTNAME, DB_DATABASE, DB_CHARSET);
            self::$conn = new PDO($dns, DB_USERNAME, DB_PASSWORD);
            //self::$conn->exec("SET NAMES utf8");
        }
    }
    
    public function find($id)
    {
		$query = self::$conn->prepare("SELECT * FROM $this->table WHERE id = ?");
        $query->execute([$id]);
		return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findAll()
    {
		$query = self::$conn->prepare("SELECT * FROM $this->table");
        $query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
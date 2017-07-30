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
    
    public function findBy(array $filter, $limit = null, $offset = null)
    {
        $query = $this->selectQuery($filter, $limit, $offset);
		return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function findOneBy(array $filter)
    {
        $query = $this->selectQuery($filter, 1);
		return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findAll()
    {
		$query = $this->selectQuery();
		return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function selectQuery(array $filter = [], $limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM $this->table";
        
        $sql .= empty($filter) ? '' : ' WHERE';
        
        foreach ($filter as $key => $value) {
            
            $sql .= ' ' . $key . ' = :'. $key;
                if ($value !== end($filter)) {
                    $sql .= ' AND ';
                }
        }
        
        $sql .= $limit ? " LIMIT $limit" : '';
        $sql .= $offset ? " OFFSET $offset" : '';
        
		$query = self::$conn->prepare($sql);
        $query->execute($filter);
		return $query;
    }
}
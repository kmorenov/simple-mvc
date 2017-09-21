<?php

namespace Core;

use PDO;

abstract class Model
{
    protected static $conn;
    
    protected static $table;

    public function __construct()
    {
        if (!self::$conn) {
            $dns = sprintf("mysql:host=%s;dbname=%s;charset=%s", DB_HOSTNAME, DB_DATABASE, DB_CHARSET);
            self::$conn = new PDO($dns, DB_USERNAME, DB_PASSWORD);
            //self::$conn->exec("SET NAMES utf8");
        }
    }
    
    public static function find($id)
    {
		$query = self::$conn->prepare("SELECT * FROM " . static::$table . " WHERE id = ?");
        $query->execute([$id]);
		return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function findBy(array $filter, $limit = null, $offset = null)
    {
        $query = self::selectQuery($filter, $limit, $offset);
		return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function findOneBy(array $filter)
    {
        $query = self::selectQuery($filter, 1);
		return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function findAll()
    {
		$query = self::selectQuery();
		return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private static function selectQuery(array $filter = [], $limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM " . static::$table;
        
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
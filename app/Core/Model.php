<?php

namespace Core;

use PDO;

abstract class Model
{
    protected static $conn;
    
    protected static $table;

    public static function getConnect() {
        if (self::$conn) {
            return self::$conn;
        }
        
        $dns = sprintf("mysql:host=%s;dbname=%s;charset=%s", DB_HOSTNAME, DB_DATABASE, DB_CHARSET);

        switch (DB_DRIVER) {
            case 'sqlite':
                self::$conn = new PDO('sqlite:../my_db.sqlite3');
                break;
            case 'mysql':
                self::$conn = new PDO($dns, DB_USERNAME, DB_PASSWORD);
                break;
            default:
                self::$conn = new PDO($dns, DB_USERNAME, DB_PASSWORD);
                break;
        }

        self::$conn->exec("SET NAMES utf8");
        return self::$conn;   
    }
    
    public static function find($id)
    {
		$query = self::getConnect()->prepare("SELECT * FROM " . static::$table . " WHERE id = ? LIMIT 1");
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
        
        $lastElementKey = @array_pop(array_keys($filter));
        foreach ($filter as $key => $value) {
            
            $sql .= ' ' . $key . ' = :'. $key;
                if ($key !== $lastElementKey) {
                    $sql .= ' AND ';
                }
        }
        
        $sql .= $limit ? " LIMIT $limit" : '';
        $sql .= $offset ? " OFFSET $offset" : '';
        
		$query = self::getConnect()->prepare($sql);
        $query->execute($filter);
		return $query;
    }
    
    public static function create(array $data)
    {
        if (empty($data)) {
            return;
        }
        
        $sql = "INSERT INTO " . static::$table . ' (';

        foreach ($data as $key => $value) {
            $sql .= $key;
            if ($value !== end($data)) {
                $sql .= ', ';
            }
        }
        
        $sql .= ') VALUES (';
        
        $lastElementKey = @array_pop(array_keys($data));
        foreach ($data as $key => $value) {
            $sql .= ':' . $key;
            if ($key !== $lastElementKey) {
                $sql .= ', ';
            }
        }
        $sql .= ')';

		$query = self::getConnect()->prepare($sql);
        
        foreach ($data as $key => &$value) {
            $query->bindParam($key, $value);
        }
        var_dump($query->execute()); die;
		return $query->execute();
    }
    
    public static function update($id, array $data)
    {
        if (empty($data)) {
            return;
        }
        
        $sql = "UPDATE " . static::$table . ' SET ';

        $lastElementKey = @array_pop(array_keys($data));
        foreach ($data as $key => $value) {
            $sql .= $key . ' = :' . $key;
            if ($key !== $lastElementKey) {
                $sql .= ', ';
            }
        }
        
        $sql .= ' WHERE id = :id';

		$query = self::getConnect()->prepare($sql);
        
        $query->bindParam('id', $id);
        foreach ($data as $key => &$value) {
            $query->bindParam($key, $value);
        }

        
		return $query->execute();
    }
}

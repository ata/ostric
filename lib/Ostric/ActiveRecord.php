<?php

namespace Ostric;

abstract class ActiveRecord
{
    private static $db;
    private static $config = array();
    private static $columns = array();
    
    // must be writting
    
    // public static $table; 
    // public static $primaryKey;
    
    // ======== Utility method ========
    public static function initialize($func)
    {
        self::$config = $func();
        self::$db = Connection::getInstance(self::$config['connectionString'],
                                            self::$config['user'],
                                            self::$config['password']);
        self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    
    public static function getConnection()
    {
        return self::$db;
    }
    
    public static function getTable()
    {
        if (!isset(static::$table)) {
            $short_class = static::getReflection()->getShortName();
            return strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $short_class));
        }
        return static::$table;
    }
    
    public static function getReflection()
    {
        return new \ReflectionClass(get_called_class());
    }
    
    public static function getPrimaryKey()
    {
        if (!isset(static::$primaryKey)) {
            return 'id';
        } else {
            return static::$primaryKey;
        }
    }
    
    /** return array('id','name','email')
     */
    public static function getColumns()
    {
        if(isset(self::$columns[get_called_class()])) {
            return self::$columns[get_called_class()];
        }
        
        $table = static::getTable();
        $sql = "SHOW COLUMNS FROM $table";
        $statement = self::$db->prepare($sql);
        $statement->execute();
        $dbcolumns = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $columns = array();
        foreach ($dbcolumns as $dc) {
            $columns[] = $dc['Field'];
        }
        return self::$columns[get_called_class()] = $columns;
        
    }
    

    public function __get($property) 
    {
        $primaryKey = static::getPrimaryKey();
        
        if(isset(static::$belongsTo) && array_key_exists($property,static::$belongsTo)) {
            $ref = static::$belongsTo[$property];
            $associationClass = $ref['class'];
            $foreignKey = isset($ref['foreignKey'])?$ref['foreignKey']:$property . '_id';
            return $this->$property = $associationClass::find($this->$foreignKey);
        }
        if(isset(static::$hasOne) && array_key_exists($property,static::$hasOne)) {
            $ref = static::$hasOne[$property];
            $class = $ref['class'];
            $foreignKey = isset($ref['foreignKey'])?$ref['foreignKey']: static::getTable() . '_id';
            $primaryKey = static::getPrimaryKey();
            $table = $class::getTable();
            $result = $class::query("SELECT * FROM $table WHERE $foreignKey = ? ",array($this->$primaryKey));
            return $this->$propery = $result[0];
        }
        
        if(isset(static::$hasMany) && array_key_exists($property,static::$hasMany)) {
            $ref = static::$hasMany[$property];
            $class = $ref['class'];
            $foreignKey = isset($ref['foreignKey'])?$ref['foreignKey']: static::getTable() . '_id';
            $associationTable = $class::getTable();
            $primaryKey = static::getPrimaryKey();
            
            if (isset($ref['joinTable'])) {
                $associationForeignKey = isset($ref['associationForeignKey'])?$ref['associationForeignKey']:$class::getTable() . '_id';
                $associationPrimaryKey = $class::getPrimaryKey();
                $joinTable = $ref['joinTable'];
                
                return $this->$property = $class::query("SELECT * FROM $associationTable 
                                                WHERE $associationPrimaryKey IN (
                                                    SELECT $associationForeignKey 
                                                    FROM $joinTable
                                                    WHERE $foreignKey = ?
                                                )",array($this->$primaryKey));
                                                
                
            } else {
                return $this->$property = $class::query("SELECT * FROM $associationTable 
                                                        WHERE $foreignKey = ? ",
                                                        array($this->$primaryKey));
            }
        }
        
    }
    
    
    public function __set($property,$value)
    {
        if(isset(static::$belongsTo) && array_key_exists($property,static::$belongsTo)) {
            $ref = static::$belongsTo[$property];
            $class = $ref['class'];
            $foreignKey = isset($ref['foreignKey'])?$ref['foreignKey']:$property . '_id';
            $primaryKey = $class::getPrimaryKey();
            //return $this->$property = $class::find($this->$foreignKey);
            $this->$foreignKey = $value->$primaryKey;
            
        }
        $this->$property = $value;
    }
    
    
    
    
    //======Retriving data method========
    
    /**
     * return @type PDOStatement
     */
    public static function query($query, $params = array())
    {
        $class = get_called_class();
        try {
            $statement = self::$db->prepare($query);
            $statement->setFetchMode(\PDO::FETCH_CLASS,$class);
            $statement->execute($params);
            return $statement->fetchAll();
            
            
        } catch (PDOStatement $e) {
            die($e->getMessage());
        }
    }
    /**
     *  $options = array(
     *      'select' => 'name,message',
     *      'where' => '',
     *      'limit' =>
     *      'offset' =>
     *      'order' => ''
     *  );
     */
    public static function all($options = array())
    {
        $select = 'SELECT *';
        $limit = '';
        $offset = '';
        $where = '';
        $order = '';
        
        if (isset($options['select'])) {
            $select = 'SELECT ' . $options['select'];
            if (count(array_keys(array_map(function($v){return trim($v);},
                    explode(',',$options['select'])),static::getPrimaryKey())) === 0) {
                        
                $select .= ', ' . static::getPrimaryKey();
            }
        }
        if (isset($options['where'])) {
            $where = 'where ' .  $options['where'];
        }
        
        if (isset($options['order'])) {
            $offset = 'ORDER BY ' . $options['order'];
        }
        
        if (isset($options['limit'])) {
            $limit = 'LIMIT ' . $options['limit'];
        }
        
        if (isset($options['offset'])) {
            $offset = 'OFFSET ' . $options['offset'];
        }
        
        $table = static::getTable();
        
        return static::query("$select from $table $where $order $limit $offset");

        
    }
    
    /**
     * find(1) --> return single object with id = 1
     * find(1,2) --> return array of object with id = 1 and 2
     * find('name','Ata') --> return array objek with field 'name' is 'Ata'
     */ 
    public static function find()
    {
        $class = get_called_class();
        if (func_num_args() === 1) {
            return static::findByPrimaryKey(func_get_arg(0));
        }
        if (property_exists($class,func_get_arg(0)) && func_num_args() > 1) {
            
        } else {
            return call_user_func_array(array($class,'findByPrimaryKeys'),
                                        func_get_args());
        }
        
    }
    
    public static function findByPrimaryKey($id)
    {
        $table = static::getTable();
        $primaryKey = static::getPrimaryKey();
        $result = static::query("SELECT * FROM $table 
                                    WHERE $primaryKey = :id",
                                    array('id' => $id));
        return $result[0];
        
    }
    
    public static function findByPrimaryKeys()
    {
        $ids = func_get_args();
        $q1 = implode(',',array_map(function($v){return '?';},$ids));
        
        $table = static::getTable();
        $primaryKey = static::getPrimaryKey();
        return static::query("SELECT * FROM $table 
                                        WHERE $primaryKey in ($q1)",$ids);
    }
    
    
    /* ===== Saving data =========*/
    public function save()
    {
        $primaryKey = static::getPrimaryKey();
        $class = get_class($this);
        
        if(isset($this->$primaryKey)){
            if($this->$primaryKey !== null) {
                return static::update($this);
            } else {
                return static::insert($this);
            }
        } else {
            return static::insert($this);
        }
    }
    
    public static function update($object)
    {
        $table = static::getTable();
        $primaryKey = static::getPrimaryKey();
        $sets = array();
        $params = array();
        foreach (static::getColumns() as $c) {
            if(property_exists($object,$c) && $object->$c !== null){
                $sets[] = "$c = :$c ";
                $params[$c] = $object->$c;
            } 
        }
        
        $params['primaryKey'] = $object->$primaryKey;
        $sets = join(',',$sets);
        $statement = self::$db->prepare("UPDATE  $table SET $sets
                                        WHERE $primaryKey = :primaryKey");
        return $statement->execute($params);
    }
    
    public static function insert($object)
    {
        $table = static::getTable();
        $columns = array();
        $values = array();
        $params = array();
        foreach (static::getColumns() as $c) {
            if(property_exists($object,$c) && $object->$c !== null){
                $columns[] = $c;
                $values[] = ':'.$c;
                $params[$c] = $object->$c;
            } 
        }
        
        $sql_columns = join(',',$columns);
        $sql_values = join(',',$values);
        $statement = self::$db->prepare("INSERT INTO $table($sql_columns) VALUES($sql_values)");
        return $statement->execute($params);
    }
    
    
    //====== DESTROYING DATA ==========
    /**
     * destroy(1) -> destroy with primary key = 1
     * destroy(1,2,3) -> destroy with primary is 1,2 and 3
     */
    public static function destroy($id)
    {
        $table = static::getTable();
        $primaryKey = static::getPrimaryKey();
        if(func_num_args() == 1){
            $statement = self::$db->prepare("DELETE from $table WHERE $primaryKey = ?");
            return $statement->execute(array($id));
        } else {
            $ids = func_get_args();
            $q1 = implode(',',array_map(function($v){return '?';},$ids));
            
            $statement = self::$db->prepare("DELETE from $table WHERE $primaryKey IN ($q1)");
            return $statement->execute($ids);
        }
        
        return false;
    }
    
    public function delete()
    {
        $primaryKey = static::getPrimaryKey();
        $class = get_class($this);
        
        if (isset($this->$primaryKey) && $this->$primaryKey !== null) {
            return static::destroy($this->$primaryKey);
        }
        return false;
    }

    
}

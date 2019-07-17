<?php
namespace adamjsmith\guestbook\library;

/**
 * Responsible for respresenting an object in the database, in code.
 *
 * @package adamjsmith\guestbook\library
 */
class Model
{
    /**
     * @var \PDO The injected DB.
     */
    private static $db;
    // The name of the table that stores this object.
    protected static $tableName = "";
    // The primary key of the object.
    protected static $primaryKey;

    // Used as a comparison when saving the object.
    private $originalObject;

    /**
     * Take an array representation of an object and hydrate the model with it's attributes.
     */
    public function __construct($object = null)
    {
        if(!is_null($object)) {
            $this->setAttributes($object);
            $this->originalObject = $object;
        }
    }

    /**
     * Updates or inserts the object into the DB, depending on whether the primary key is set or not.
     *
     * Sets the primary key of the object in the model if an insert is successful.
     *
     * @return bool True if successful, false if not.
     */
    public function save()
    {
        $class = get_called_class();
        $pk = $class::$primaryKey;

        if(isset($this->$pk)) {
            // Update.
            $updates = array();
            foreach($this->originalObject AS $name => $value) {
                if($this->$name != $value)
                    $updates[$name] = $this->$name;
            }

            if(!$updates)
                return true;

            $columns = [];
            $values = [];
            foreach($updates AS $column => $value) {
                 $columns[] = "`$column` = :$column";
                 $values[":".$column] = $value;
            }

            $table = $class::$tableName;
            $sql = "UPDATE `$table` SET ";
            $sql .= implode(", ", $columns);
            $sql .= " WHERE `$pk` = ".$this->$pk;

            $query = self::$db->prepare($sql);
            $result = $query->execute($values);

            if($result === false || $result === 0)
                return false;
        } else {
            // Insert.

            $columnNames = [];
            $columns = [];
            $values = [];
            foreach($this->originalObject AS $column => $value) {
                $columnNames[] = "`$column`";
                $columns[] = "`$column` = :$column";
                $values[":".$column] = $value;
            }

            $table = $class::$tableName;
            $sql = "INSERT INTO `$table` (".implode(", ", $columnNames).") VALUES ";
            $sql .= "(".implode(", ", array_keys($values)).")";

            $query = self::$db->prepare($sql);
            $result = $query->execute($values);
            if($result === false || $result === 0)
                return false;

            $this->$pk = self::$db->lastInsertId();
        }

        return true;
    }

    /**
     * Clean and set all attributes given.
     *
     * @param $attributes array A $key => $value array where key is the name of the attribute and value is the value
     * to set.
     */
    private function setAttributes($attributes)
    {
        foreach($attributes AS $attribute => $value) {
            $this->$attribute = htmlspecialchars($value);
        }
    }

    /**
     * Inject the DB handler for all database interactions
     *
     * @param \PDO $db The injected DB
     */
    public static function setDB(\PDO $db)
    {
        self::$db = $db;
    }

    /**
     * Fetch all of the objects in the database, without discretion.
     *
     * @return array
     */
    public static function getAll()
    {
        $class = get_called_class();
        $dbObjects = self::$db->query("SELECT * FROM `".$class::$tableName."`", \PDO::FETCH_ASSOC);

        foreach($dbObjects AS $object) {
            $objects[] = new $class($object);
        }

        return $objects;
    }

    /**
     * Effectively a select with a where.
     *
     * @param $where array Assoc array of Columns => $values to search for.
     * @return mixed Returns false if query can't execute or an array of objects on success.
     */
    public static function getSome(array $where)
    {
        $class = get_called_class();

        $columns = [];
        $values = [];
        foreach($where AS $column => $value) {
            $columns[] = "`$column` = :$column";
            $values[":".$column] = $value;
        }

        $sql = "SELECT * FROM ".$class::$tableName." WHERE ".implode(" AND ", $columns);
        $query = self::$db->prepare($sql);
        $result = $query->execute($values);

        if(!$result)
            return false;

        $objects = [];
        $dbObjects = $query->fetchAll(\PDO::FETCH_ASSOC);
        foreach($dbObjects AS $row) {
            $objects[] = new $class($row);
        }

        return $objects;
    }
}
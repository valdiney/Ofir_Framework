<?php
/**
* This class is used to work with persistence in database
*/

class persistence
{
    protected $db;
    protected $field = array();
    public    $persistence = null;

    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

    public function __destruct() {
        $this->persistence = " ";
        $this->field = array();
    }

    /**
    * Find an archive in database by field id
    *
    * @param id : int : Id of the archive in the database
    * @return boolean or an array
    */
    public function find(Int $id) {
        $id = (int) $id;
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getArray() {
        $query = $this->db->prepare("SELECT * FROM {$this->table}");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
    * Find an archive in database by field of the archive and compare with value
    *
    * @param field : String : Field of the archive in the database
    * @param value : mixed : Value that i want compare with value in the database
    * @return boolean or an array
    */
    public function findBy(String $field, $value) {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} = ?");
        $query->execute(array($value));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a select statement
     *
     * @param String $columns
     * @return void
     */
    public function select(String $columns='*') {
        $this->persistence = "SELECT ({$columns}) FROM {$this->table}";
        return $this;
    }

    /**
    * Using this method you can write Sql query of way that you want
    *
    * @param query : string : Your query
    * @return typeReturn : string true or false
    * @return Array of Objects or Array of Arrays
    */
    public function query(String $query, $typeReturn='array') {
        $typeReturn = trim(strtolower($typeReturn));
        $sql = $this->db->query($query);
        $sql->execute();
        if ($typeReturn==="array") {
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $sql->fetch(PDO::FETCH_OBJ);
    }

    /**
    * Get all archives from table
    *
    * @return an array of objects
    */
    public function all() {
        $sql = $this->db->prepare($this->persistence);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    /**
    * Get the first archive from table
    *
    * @return an array of objects
    */
    public function first() {
        $this->persistence .= " ORDER BY id ASC LIMIT 1";
        $sql = $this->db->prepare($this->persistence);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_OBJ);
    }

    /**
    * Get the last archive from table
    *
    * @return an array of objects
    */

    public function last() {
        $this->persistence .= " ORDER BY id DESC LIMIT 1";
        $sql = $this->db->prepare($this->persistence);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    /**
    * This method return the last id of a inset in the table
    *
    * @return interger id
    */

    public function lastID() {
        return $this->db->lastInsertId();
    }

    public function limit($limit_numbar = 1) {
        $this->persistence .= " LIMIT {$limit_numbar}";
        return $this;
    }

    /**
    * Save the data in the database
    *
    * @param data : array : Array of the values to be save in database
    * @return boolean true or false
    */

    public function save(Array $data) {
        foreach ($data as $key => $list) {
            $fields[] = $key;
            $values[] = $list;
        }
        $fields = implode(", ", $fields);
        $values = "'" . implode("','", $values) . "'";
        if ($this->db->query("INSERT INTO {$this->table} ({$fields}) VALUES ({$values})")) {
            return true;
        }
        return false;
    }

    /**
    * Update the data in the database
    *
    * @param data : array : Array of the values to be save in database
    * @param id : int : Id of the archive in the table
    * @return boolean true or false
    */
    public function update(Array $data, $id) {
        $id = (int) $id;

        # Prepare the fields
        $set = "set";
        foreach ($data as $key => $item) {
            $set .= " " . $key . " = " . "?" . ", ";
        }

        $set_size = strlen($set);
        $token = substr($set, -$set_size, -2);
        $token .= " WHERE id = " . "?";

        # prepare the values
        $values = "";
        foreach ($data as $item) {
            $values .= $item . ", ";
        }

        $values .= $id;
        $data[] = $id;

        $commaExplode = array();
        foreach ($data as $item) {
            $commaExplode[] = $item;
        }

        # Execute the update
        $edit = $this->db->prepare("UPDATE {$this->table} {$token}");
        return $edit->execute($commaExplode);
    }

    /**
    * Delete the archive in the database
    *
    * @param data : array : Array of the values to be save in database
    * @param id : int : Id of the archive in the table
    * @return boolean true or false
    */
    public function delete($id) {
        $id = (int) $id;
        $delete = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $delete->execute(array($id));
    }

    /**
    * This method is used to create a relationship between two or more tables using INNER JOIN clause
    *
    * @param masterTable : string : Name of the master table of the relationship
    * @param masterTableField : string : Name of the field of the master table
    * @param slaveField : string : Name of the slave table field of the relationship, in other words, the other table of the relationship
    * @param fiels : string : Names of the fields of the tables that you wanna show
    * @return Object
    */

    public function join($masterTable, $masterTableField, $slaveTable, $fkSlave, $fields = false) {
        $this->persistence = "SELECT {$masterTable}.{$masterTableField}, {$fields} FROM {$masterTable} INNER JOIN {$slaveTable} ON {$slaveTable}.{$fkSlave} = {$masterTable}.{$masterTableField}";
        return $this;
    }

    /**
    * This method is used when you need join more than two table in the same query. This method should be used together 'join' method
    *
    * @param masterTable : string : Name of the master table of the relationship
    * @param masterTableField : string : Name of the field of the master table
    * @param slaveField : string : Name of the slave table field of the relationship, in other words, the other table of the relationship
    * @param fiels : string : Names of the fields of the tables that you wanna show
    * @return Object
    */
    public function joinTo($masterTable, $masterTableField, $slaveTable, $fkSlave) {
        $this->persistence .= " AND {$masterTable}.{$masterTableField} INNER JOIN {$slaveTable} ON {$slaveTable}.{$fkSlave} = {$masterTable}.{$masterTableField}";
        return $this;
    }

    public function leftJoin($masterTable, $masterTableField, $slaveTable, $fkSlave, $fields = false) {
        $this->persistence = "SELECT {$masterTable}.{$masterTableField}, {$fields} FROM {$masterTable} LEFT JOIN {$slaveTable} ON {$slaveTable}.{$fkSlave} = {$masterTable}.{$masterTableField}";
        return $this;
    }

    public function leftJoinTo($masterTable, $masterTableField, $slaveTable, $fkSlave) {
        $this->persistence .= " AND {$masterTable}.{$masterTableField} LEFT JOIN {$slaveTable} ON {$slaveTable}.{$fkSlave} = {$masterTable}.{$masterTableField}";
        return $this;
    }
}

<?php 
/**
* This class is used to work with persistence in database
*/

class Persistence
{
	protected $db;
	public $persistence = null;
	protected $field = array();

	public function __construct(PDO $pdo)
	{
		$this->db = $pdo;
	}

	public function __destruct() {
		$this->persistence = " ";
		$fields = array();
	}

    /**
    * Find an archive in database by field id
    *
    * @param id : int : Id of the archive in the database
    * @return boolean or an array
    */
    
	public function find($id = 0)
	{
		$id = (int) $id;
		$query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
		$query->execute(array($id));
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function get_array()
	{
		$query = $this->db->prepare("SELECT * FROM {$this->table}");
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}
    
    /**
    * Find an archive in database by field of the archive and compare with value
    *
    * @param field : mixed : Field of the archive in the database
    * @param value : mixed : Value that i want compare with value in the database
    * @return boolean or an array
    */

	public function findBy($field = null, $value = null)
	{
		$query = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} = ?");
		$query->execute(array($value));
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function select()
	{
		$this->Persistence = "SELECT * FROM {$this->table}";
		return $this;
	}
    
    /**
    * Using this method you can write Sql query of way that you want
    *
    * @param query : string : Your query
    * @return type_return : string true or false
    * @return Array of Objects or Array of Arrays
    */

	public function query($query, $type_return = null)
	{
		$type_return = trim(strtolower($type_return));

		$sql = $this->db->query($query);
		$sql->execute();

		if ($type_return == "array") {
			return $sql->fetch(PDO::FETCH_ASSOC);
		} 

		if ($type_return == "obj") {
			return $sql->fetch(PDO::FETCH_OBJ);
		} 

		return $sql->fetch(PDO::FETCH_OBJ);
	}
    
    /**
    * Get all archives from table
    *
    * @return an array of objects
    */

	public function getAll()
	{
		$sql = $this->db->prepare($this->Persistence);
		$sql->execute();
		return $sql->fetchAll(PDO::FETCH_OBJ);
	}
    
    /**
    * Get the first archive from table
    *
    * @return an array of objects
    */

	public function getFirst()
	{
		$this->Persistence .= " ORDER BY id ASC LIMIT 1";
		$sql = $this->db->prepare($this->Persistence);
		$sql->execute();
		return $sql->fetchAll(PDO::FETCH_OBJ);
	} 

	/**
    * Get the last archive from table
    *
    * @return an array of objects
    */

	public function getLast()
	{
		$this->Persistence .= " ORDER BY id DESC LIMIT 1";
		$sql = $this->db->prepare($this->Persistence);
		$sql->execute();
		return $sql->fetchAll(PDO::FETCH_OBJ);
	}

	/**
    * This method return the last id of a inset in the table
    *
    * @return interger id
    */

	public function getLastID()
	{
		return $this->db->lastInsertId();
	}

	public function limit($limit_numbar = 1) 
	{
		$this->Persistence .= " LIMIT {$limit_numbar}";
		return $this;
	} 

    /**
    * Save the data in the database
    *
    * @param data : array : Array of the values to be save in database
    * @return boolean true or false
    */

	public function save(Array $data)
	{
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

	public function update(Array $data, $id)
	{   
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
       
        $comma_explode = array();
        foreach ($data as $item) {
        	$comma_explode[] = $item;
        }

        # Execute the update
        $edit = $this->db->prepare("UPDATE {$this->table} {$token}");
        return $edit->execute($comma_explode);
	}
    
    /**
    * Delete the archive in the database
    *
    * @param data : array : Array of the values to be save in database
    * @param id : int : Id of the archive in the table
    * @return boolean true or false
    */

	public function delete($id)
	{
		$id = (int) $id;
		$delete = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
		return $delete->execute(array($id));
	}
    
    /**
    * This method is used to create a relationship between two or more tables using INNER JOIN clause
    *
    * @param master_table : string : Name of the master table of the relationship
    * @param master_table_field : string : Name of the field of the master table
    * @param slave_field : string : Name of the slave table field of the relationship, in other words, the other table of the relationship
    * @param fiels : string : Names of the fields of the tables that you wanna show
    * @return Object
    */

	public function join($master_table, $master_table_field, $slave_table, $fk_slave, $fields = false)
	{
		$this->Persistence = "SELECT {$master_table}.{$master_table_field}, {$fields} FROM {$master_table} INNER JOIN {$slave_table} ON {$slave_table}.{$fk_slave} = {$master_table}.{$master_table_field}";
	    return $this;
	}

	/**
	* This method is used when you need join more than two table in the same query. This method should be used together 'join' method
    *
	* @param master_table : string : Name of the master table of the relationship
    * @param master_table_field : string : Name of the field of the master table
    * @param slave_field : string : Name of the slave table field of the relationship, in other words, the other table of the relationship
    * @param fiels : string : Names of the fields of the tables that you wanna show
    * @return Object
	*/

	public function joinToo($master_table, $master_table_field, $slave_table, $fk_slave)
	{
		$this->Persistence .= " AND {$master_table}.{$master_table_field} INNER JOIN {$slave_table} ON {$slave_table}.{$fk_slave} = {$master_table}.{$master_table_field}";
		return $this;
	}

	public function leftJoin($master_table, $master_table_field, $slave_table, $fk_slave, $fields = false)
	{
		$this->Persistence = "SELECT {$master_table}.{$master_table_field}, {$fields} FROM {$master_table} LEFT JOIN {$slave_table} ON {$slave_table}.{$fk_slave} = {$master_table}.{$master_table_field}";
	    return $this;
	}

	public function leftJoinToo($master_table, $master_table_field, $slave_table, $fk_slave)
	{
		$this->Persistence .= " AND {$master_table}.{$master_table_field} LEFT JOIN {$slave_table} ON {$slave_table}.{$fk_slave} = {$master_table}.{$master_table_field}";
		return $this;
	}
}
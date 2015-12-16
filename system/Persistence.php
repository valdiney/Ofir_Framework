<?php 
/**
* This class is used to work with persistence in database
*/

class Persistence
{
	protected $db;
	public $Persistence = null;
	protected $field = array();

	public function __construct(PDO $pdo)
	{
		$this->db = $pdo;
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
    
    /**
    * Find an archive in database by field of the archive and compare with value
    *
    * @param field : mixed : Field of the archive in the database
    * @param value : mixed : Value that i want compare with value in the database
    * @return boolean or an array
    */

	public function find_by($field = null, $value = null)
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

	public function where($field = false, $operator = false, $value = false)
	{
		$this->Persistence .= " WHERE {$field} {$operator} ?"; 
		$this->field[] = $value;
		return $this;
	}

	public function and_too($field = false, $operator = false, $value = false)
	{
		$this->Persistence .= " AND {$field} {$operator} ?";
		$this->field[] = $value;
		return $this;
	}
    
    /**
    * Get all archives from table
    *
    * @return an array of objects
    */

	public function get_all()
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

	public function get_first()
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

	public function get_last()
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

	public function get_last_id()
	{
		return $this->db->lastInsertId();
	}

	public function limit($limit_numbar = 1) 
	{
		$this->Persistence .= " LIMIT {$limit_numbar}";
		return $this;
	} 

	public function prepare($sql = false)
	{
		$values = null;
		foreach ($this->field as $itens) {
			$values .= "{$itens}, ";
		}
        
        $values_size = strlen($values);
		$token = substr($values, -$values_size, -2);
        
        $real_values = array();
		foreach ($this->field as $key => $itens) {
			$comma = explode(', ', $values);
			$real_values[] = $comma[$key];
		}

		$sql = $this->db->prepare($this->Persistence);
        
		if ( ! empty($this->field)) {
			$sql->execute($real_values);
		} else {
			$sql->execute();
		}
		
		return $sql->fetchAll(PDO::FETCH_OBJ);
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
}
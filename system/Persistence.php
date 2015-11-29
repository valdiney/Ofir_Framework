<?php 
class Persistence
{
	protected $db;
	public $Persistence = null;
	protected $field = array();

	public function __construct(PDO $pdo)
	{
		$this->db = $pdo;
	}

	public function find($id = 0)
	{
		$id = (int) $id;
		$query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
		$query->execute(array($id));
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
}
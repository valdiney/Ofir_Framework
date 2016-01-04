<?php 
class Class_Loader
{
	public $directory;
	public $dir_name;
	public $class_name = array();

	public function set_dir_class($dir)
	{
		$this->dir_name = trim($dir);
		$this->directory = dir($dir);
	}

	public function read_class_name()
	{
		while ($archives = $this->directory->read()) {
			if ($archives != '.' AND $archives != '..') {
				$archives = explode('.php', $archives);
				$this->class_name[] = trim($archives[0]);
			}
		}
	}

	public function class_loader()
	{
		foreach ($this->class_name as $class) {
			require_once("{$this->dir_name}{$class}.php");
		}
	}

	public function prepare_class_to_instantiate()
	{
		$this->read_class_name();
		$this->class_loader();
	
        $objects = array();
		foreach ($this->class_name as $class_name) {
			$objects[$class_name] = new $class_name(Database::connect());
		}

		return $objects;
	}
}
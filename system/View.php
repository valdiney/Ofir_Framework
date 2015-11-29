<?php 
class View
{
	protected $data = array();

	public function set($name = false, $data = false)
	{
		$this->data[$name] = $data;
	}

	protected function get_data()
	{
		return $this->data;
	}

	public function make($view_name)
	{
		$view_name = str_replace('.', '/', $view_name);

		foreach ($this->get_data() as $key => $itens) {
			$$key = $itens;
		}

		if (file_exists("views/{$view_name}.php")) {
			# Inlcude the view files
			require_once("views/{$view_name}.php");
		} else {
			echo 'This View not Exist in this folder';
		}
	}
}
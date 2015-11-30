<?php 
require_once('traits/String_helper.php');

class View
{
	use String_helper;

	# to receive the values passed to view
	protected $data = array();

	# to receive the name of the layout that will be used in the controller
	protected $layout_name = false;

	# to receive the name of the views that will be used into the layout
	public $content = null;

	public function set($name = false, $data = false)
	{
		$this->data[$name] = $data;
	}
    
    # Return the array of the values that will be used in the views
	protected function get_data()
	{
		return $this->data;
	}
    
    # Receive the name and the path of the layout
	public function layout_name($layout_name = false)
	{
		$this->layout_name = $layout_name;
	}
    
    # Render the view used in the controller
	public function make($view_name)
	{   
		# Transforming the operator '.' in operator '='
		$view_name = self::to_slash($view_name);
        
        # Passing the values to be used into the views
		foreach ($this->get_data() as $key => $itens) {
			$$key = $itens;
		}
        
        # Verify if exist the view file
		if (file_exists("views/{$view_name}.php")) {

			# Passing the name and path of the views files
            $this->content = "views/{$view_name}.php";
            
            # Verify if the layout exist in the layout folder
			if (file_exists("layouts/{$this->layout_name}.php")) {

				# Include the layout 
				require_once("layouts/{$this->layout_name}.php");

			} else {
				echo 'This layout not exist in the layout folder';
			}

		} else {
			echo 'This View not Exist in this folder';
		}
	}
}
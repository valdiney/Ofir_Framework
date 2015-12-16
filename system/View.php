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

	protected $include_files = array();

	public function import_files($name)
	{
		if (array_key_exists($name, $this->include_files)) {
			return include($this->include_files[$name]);
		} else {
			echo "<b>(In View) {$name}</b>: <font color='red'> This file not exist, you should verify the name and path of the file.";
			exit;
		}
	}

    # Return the array of the values that will be used in the views
	protected function get_data()
	{
		return $this->data;
	}
    
    # Receive the name and the path of the layout
	public function layout($layout_name = false)
	{
		$this->layout_name = $layout_name;
	}
    
    /**
    * Render the view used in the controller
    * 
    * @param view_name : string : Name of view and the name of the folder of the view
    * @param data : mixed : Values that will be passed to the view
    */

	public function make($view_name, $data = false)
	{   
		# Set in array the values passed to view
		foreach ($data as $key => $items) {
			$this->data[$key] = $items;
		}

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
            
            # Verify if the method are using a layout
            if ( ! $this->layout_name == null) {

                # Verify if the layout exist in the layout folder
			    if (file_exists("layouts/{$this->layout_name}.php")) {

				    # Include the layout 
				    require_once("layouts/{$this->layout_name}.php");

			    } else {
				    echo 'This layout not exist in the layout folder';
			    }
			    
		    } else {
		    	require_once("views/{$view_name}.php");
		    }

		} else {
			echo 'This View not Exist in this folder';
		}
	}

	public function with_files($key_word, $name)
	{
		$name = str_replace('.', '/', $name);
		if (file_exists("{$name}.php")) {
			$this->include_files[$key_word] = "{$name}.php";
		} else {
			echo "<b>(In Controller) {$name}</b>: <font color='red'> This file not exist, you should verify the name and path of the file";
			exit;
		}
	}
}
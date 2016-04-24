<?php 
trait Pagination
{
	# Total items of the tadabase results
	protected static $total_rows = null;

	# Max number of items you want shown per page
	protected static $per_page = null;

    # Result of the calculate of the total number of page
	protected static $num_page = null;

	# Items from database
	protected static $query = null;

	protected static $next_link = null;

	protected static $after_link = null;

    # Calculate the total of the rows
	private static function total_rows()
	{
		self::$total_rows = count(self::$query);
		return self::$total_rows;
	}
    
    /**
    * Make the pagination
    *
    * @param per_page : int : Number of items per page
    * @param db_query : array : Query from database
    * @return Array of the object
    */

	public static function paginator($per_page, $db_query)
	{
		if (isset($_GET['p'])) {
			# Get the value from HTTP-GET
		    $get_page = (int) $_GET['p'];
		}
		
		if (empty($get_page)) {
			$get_page = 1;
		}

        self::$query = $db_query;
        
        # Array separator
		$result = array_chunk($db_query, $per_page);
		self::$num_page = count($result);

		# Result of items
		return $result[$get_page -1];
	}
    
    # Create of the nex link of pagination
	public static function next_link()
	{
		if (isset($_GET['p'])) {
			# Get the value from HTTP-GET
		    $get_page = (int) $_GET['p'];
		}
		
		if (empty($get_page)) {
			$get_page = 1;
		}

		if (isset($get_page)) {
			self::$next_link = $get_page + 1;
		}

		$next = self::$next_link;

		if ($next > self::$num_page) {
			$next = self::$num_page;
		}

		$controller = Get_url::get_url('controller');
		$method = Get_url::get_url('method');
        
        $url = null;
        
        if ( ! isset($_GET['p'])) {
        	$url = "?{$controller}={$method}&p={$next}";
        } else {
            $url = "?{$controller}={$method}={$next}";
        }

		echo "href='{$url}'>";
	}
    
    # Create of the after link of pagination
	public static function after_link()
	{
		if (isset($_GET['p'])) {
			# Get the value from HTTP-GET
		    $get_page = (int) $_GET['p'];
		}
		
		if (empty($get_page)) {
			$get_page = 1;
		}

		if (isset($get_page)) {
			self::$next_link = $get_page + 1;
		}

		$after = self::$after_link;
		$min = $get_page - 1;

		if ($min < 1) {
			$min = 1;
		}

		$controller = Get_url::get_url('controller');
		$method = Get_url::get_url('method');

		$url = "?{$controller}={$method}={$min}";
		echo "href='{$url}'>";
	}

	public static function paginate_information()
	{
		$page = $_GET['p'];
		if ($page >= self::$num_page) {
			$page = self::$num_page;
		} 

		return $page . " de " . self::$num_page;
	}
}
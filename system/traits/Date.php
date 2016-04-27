<?php 
/**
* This trait is working with conversion of date
*/

trait Date
{
	public static function date_format($date = null)
	{
        # Converting date to USA standard
		if (strpos($date, "/")) {
		    $date = explode("/", $date);
			return $date[2] . "-" . $date[1] . "-" . $date[0];
		} 
        
        # Converting date to BR standard
        if (strpos($date, "-")) {
		    $date = explode("-", $date);
			return $date[2] . "/" . $date[1] . "/" . $date[0];
		}
    }

    public static function date_now($format = null)
    {
    	$format = trim(strtolower($format));
        $format = strtoupper($format);

    	if ($format == 'BR') {
    		return Date('d/m/Y');
    	}

    	if ($format == 'USA' or 'EUA') {
    		return Date('Y-m-d');
    	}
    }

    # This method is used to return a date time, the parameters represent 'continent' and 'city'
    # to be put in time zone
    public static function date_time($format = false, $continent = 'America', $city = 'Araguaina')
    {
        date_default_timezone_set("{$continent}/{$city}");
        $date = date("Y-m-d H:i:s");

        if ($format == null) {
            return $date;
        }

        return date($format, strtotime($date));
    }
    
    # This method is used to return the time, the parameters represent 'continent' and 'city'
    # to be put in time zone
    public static function Hour($continent = 'America', $city = 'Araguaina')
	{
        date_default_timezone_set("{$continent}/{$city}");
        return date("H:i:s");
	}
}
<?php
/**
* This trait is working with conversion of date
*/

trait Date
{
    public static function dateFormat($date = null)
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

    public static function dateNow($format = null)
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
    public static function dateTime($format = false, $your_date = false, $continent = 'America', $city = 'Araguaina')
    {
        date_default_timezone_set("{$continent}/{$city}");
        $date = date("Y-m-d H:i:s");

        if ($format == null) {
            return $date;
        }

        if ($your_date != null) {
            return date($format, strtotime($your_date));
        }

        return date($format, strtotime($date));
    }

    # This method is used to return the time, the parameters represent 'continent' and 'city'
    # to be put in time zone
    public static function hour($continent = 'America', $city = 'Araguaina')
    {
        date_default_timezone_set("{$continent}/{$city}");
        return date("H:i:s");
    }
}

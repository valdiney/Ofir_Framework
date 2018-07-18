<?php
/**
* This class is working with conversion of date
*/

class Date
{
    protected $date = null;
    protected $type = null;

    /**
     * Initialize with two optionals params
     * @param String $date
     * @param String $type
     */
    public function __construct(String $date=null, String $type='br') {
        $date = $date? $date: time();
        $this->date = new DateTime($date);
        $this->type = strtoupper($type);
    }

    /**
     * Get the date formated
     * @param String $format
     * @return void
     */
    public function format(String $format=null) {
        $format = $format? $format: ($type=='BR'? 'm/d/Y': 'm-d-Y');
        return $this->date->format($format);
    }

    public function now() {
        return $format==='BR'? date('d/m/Y'): date('m-d-Y');
    }

    /**
     * Configure a new timezone
     *
     * @param String $continent
     * @param String $city
     * @return $this
     */
    public function timezone(String $continent, String $city) {
        $timezone = "{$continent}/{$city}";
        $this->date = new Datetime($this->date, new DateTimeZone($timezone));
        return $this;
    }

    /**
     * This method is used to return the time, the parameters represent 'continent' and 'city'
     * to be put in timezone
     * @param String $continent
     * @param String $city
     * @return String
     */
    public function hour(String $continent, String $city) {
        $timezone = "{$continent}/{$city}";
        $this->date = new Datetime($this->date, new DateTimeZone($timezone));
        return $this->date->format('H:i:s');
    }
}

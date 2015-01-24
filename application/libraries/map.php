<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__).'/googlemaps/googlemaps.php';

class Map extends Googlemaps{
    function __construct(){
        parent::__construct();
    }
}

/* End of file map.php */
/* Location: ./application/libraries/map.php */
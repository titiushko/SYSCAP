<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__).'/mobile_detect/Mobile_Detect.php';

class Mobile extends Mobile_Detect{
    function __construct(){
        parent::__construct();
    }
}

/* End of file mobile.php */
/* Location: ./application/libraries/mobile.php */
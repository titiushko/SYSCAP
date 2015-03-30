<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('bold')){
	function bold($cadena){
		return '<b>'.$cadena.'</b>';
	}
}

if ( ! function_exists('tag') ) {
	function tag($tag_name, $data = '', $attributes = '') {
		$attributes = ($attributes != '') ? ' '.$attributes : $attributes;
		return "<".$tag_name.$attributes.">".$data."</".$tag_name.">";
	}
}

/* End of file MY_html_helper.php */
/* Location: ./application/helpers/MY_html_helper.php */
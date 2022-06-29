<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class Duitku {
	// protected $role = ''; 

	function __construct() {
        
        /** 
         * Check PHP version.
         */
        if (version_compare(PHP_VERSION, '5.6', '<')) {
            throw new Exception('PHP version >= 5.6 required');
        }

        // Check PHP Curl & 
        if (!function_exists('curl_init') || !function_exists('curl_exec')) {
            throw new Exception('Duitku::cURL library is required');
        }

        // Json decode capabilities.
        if (!function_exists('json_decode')) {
            throw new Exception('Duitku::JSON PHP extension is required');
        }

        // Configuration Duitku Config
        require_once 'duitku/Config.php';
        // Duitku Sanitizer Parameter
        require_once 'duitku/Sanitizer.php';
        // Duitku Request Curl
        require_once 'duitku/Request.php';
        // General Duitku-Pop Request
        require_once 'duitku/Pop.php';
        // General Duitku-API Request
        require_once 'duitku/Api.php';
	} 
}

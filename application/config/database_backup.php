<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'   => '', 
    
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'luna',
    
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
); 

$sql_conf = array(
    'dsn'   => '',  

    'hostname' => '.\SQLEXPRESS',
    'username' => 'username1',//username SQL
    'password' => 'pass1',//password SQL
    'database' => 'LUNA_MEMBERDB',
    'dbdriver' => 'sqlsrv',  

    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => TRUE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'autoinit' => TRUE,
    'stricton' => FALSE,
); 

$db['LUNA_MEMBERDB'] = $sql_conf; 

$sql_conf['database'] = 'LUNA_GAMEDB';

$db['LUNA_GAMEDB'] = $sql_conf;
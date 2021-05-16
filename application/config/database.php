<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'star_luna',
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
	'dsn'	=> '', 
	'hostname' => 'Driver={SQL Server};Server=.\NS525896;Database=LUNA_MEMBERDB;',
	'username' => 'sa',//username SQL
	'password' => 'luna',//password SQL
	'database' => '',
	'dbdriver' => 'odbc',
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
// $db['LUNA_MEMBERDB'] = array(
// 	'dsn'	=> '',
// 	// 'hostname' => 'Driver={SQL Server};Server=NS525896\SQLEXPRESS;Database=LUNA_MEMBERDB;',
// 	// 'username' => 'GameSrv',//username SQL
// 	// 'password' => 'luna',//password SQL
// 	'hostname' => 'Driver={SQL Server};Server=NS525896\SQLEXPRESS;Database=LUNA_MEMBERDB;',
// 	'username' => 'sa',//username SQL
// 	'password' => 'luna',//password SQL
// 	'database' => '',
// 	'dbdriver' => 'odbc',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => TRUE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'autoinit' => TRUE,
// 	'stricton' => FALSE,
// );

$db['LUNA_MEMBERDB'] = $sql_conf;
$sql_conf['hostname'] = 'Driver={SQL Server};Server=.\NS525896;Database=LUNA_GAMEDB;';
$db['LUNA_GAMEDB'] = $sql_conf;

//Buat username password di SQL Server 2014
/*
* BUAT ODBC CONNECTION
- Buka ODBC
- add
- Pilih SQL Server > Finish
- name (nama user SQL) > Server (nama server SQL) > next
- SQL Verify with aunthentication ( Masukan id pass user SQL Server) > next
- next > next > finish
- Test data source > juka TESTS COMPLETED SUCCESSFULLY! berarti berhasil
- OK
*/
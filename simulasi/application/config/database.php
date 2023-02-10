<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/


/*


connection string di aplikasi :
	IP-SCAN:
	(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.3.8)(PORT = 1521))(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.3.9)(PORT = 1521))(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.3.10)(PORT = 1521))(CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = AGENCY)))

	IP-VIP:
	(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.3.61)(PORT = 1521))(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.3.62)(PORT = 1521))(CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = AGENCY))) 


	DNS:
	(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP) (HOST = database.jiwasraya.co.id)(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = AGENCY)))



*/




	$active_group = 'default';
	$active_record = TRUE;

	$db['default']['hostname'] = '(DESCRIPTION = 
(ADDRESS = (PROTOCOL = TCP)(HOST = database.ifg-life.id)(PORT = 1521))
(CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = IFGAGENCY)))';
	$db['default']['username'] = 'JAIM';
	$db['default']['password'] = 'ifg#dbs#jaim#2020';
	$db['default']['database'] = '';
	$db['default']['dbdriver'] = 'oci8';
	$db['default']['dbprefix'] = '';
	$db['default']['pconnect'] = TRUE;
	$db['default']['db_debug'] = TRUE;
	$db['default']['cache_on'] = FALSE;
	$db['default']['cachedir'] = '/opt/bitnami/apps/jaim_ifglife/htdocs/simulasi/application/cache';
	$db['default']['char_set'] = 'utf8';
	$db['default']['dbcollat'] = 'utf8_general_ci';
	$db['default']['swap_pre'] = '';
	$db['default']['autoinit'] = TRUE;
	$db['default']['stricton'] = FALSE;

/*	$db['default']['hostname'] = 'localhost';
	$db['default']['username'] = 'root';
	$db['default']['password'] = 'Rg=Feyrug?4LC_X';
	$db['default']['database'] = 'simulasi';
	$db['default']['dbdriver'] = 'mysql';
	$db['default']['dbprefix'] = '';
	$db['default']['pconnect'] = FALSE;
	$db['default']['db_debug'] = TRUE;
	$db['default']['cache_on'] = FALSE;
	$db['default']['cachedir'] = '';
	$db['default']['char_set'] = 'utf8';
	$db['default']['dbcollat'] = 'utf8_general_ci';
	$db['default']['swap_pre'] = '';
	$db['default']['autoinit'] = TRUE;
	$db['default']['stricton'] = FALSE;

	$db['jaim']['hostname'] = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP) (HOST = 192.168.2.7)(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = JSDEPLOY)))';
	$db['jaim']['username'] = 'JAIM';
	$db['jaim']['password'] = 'JAIM';
	$db['jaim']['database'] = '';
	$db['jaim']['dbdriver'] = 'oci8';
	$db['jaim']['dbprefix'] = '';
	$db['jaim']['pconnect'] = TRUE;
	$db['jaim']['db_debug'] = TRUE;
	$db['jaim']['cache_on'] = FALSE;
	$db['jaim']['cachedir'] = '';
	$db['jaim']['char_set'] = 'utf8';
	$db['jaim']['dbcollat'] = 'utf8_general_ci';
	$db['jaim']['swap_pre'] = '';
	$db['jaim']['autoinit'] = TRUE;
	$db['jaim']['stricton'] = FALSE;
*/


/* End of file database.php */
/* Location: ./application/config/database.php */
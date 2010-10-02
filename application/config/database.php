<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the "Database Connection"
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
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the "default" group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/
$active_group = strtolower(ENVIRONMENT);
$active_record = TRUE;
// PRODUCTION ENVIRONMENT
$db['production']['hostname'] = "localhost";
$db['production']['username'] = "root";
$db['production']['password'] = "5f@u1T53rv3r";
$db['production']['database'] = "guillotinet";
$db['production']['dbdriver'] = "mysql";
$db['production']['dbprefix'] = "";
$db['production']['pconnect'] = TRUE;
$db['production']['db_debug'] = FALSE;
$db['production']['cache_on'] = TRUE;
$db['production']['cachedir'] = "";
$db['production']['char_set'] = "utf8";
$db['production']['dbcollat'] = "utf8_general_ci";

// STAGING ENVIRONMENT
$db['staging']['hostname'] = "localhost";
$db['staging']['username'] = "";
$db['staging']['password'] = "";
$db['staging']['database'] = "guillotinet";
$db['staging']['dbdriver'] = "mysql";
$db['staging']['dbprefix'] = "";
$db['staging']['pconnect'] = TRUE;
$db['staging']['db_debug'] = TRUE;
$db['staging']['cache_on'] = FALSE;
$db['staging']['cachedir'] = "";
$db['staging']['char_set'] = "utf8";
$db['staging']['dbcollat'] = "utf8_general_ci";

// DEVELOPMENT ENVIRONMENT
$db['development']['hostname'] = "localhost";
$db['development']['username'] = "root";
$db['development']['password'] = "";
$db['development']['database'] = "guillotinet";
$db['development']['dbdriver'] = "mysql";
$db['development']['dbprefix'] = "";
$db['development']['pconnect'] = TRUE;
$db['development']['db_debug'] = TRUE;
$db['development']['cache_on'] = FALSE;
$db['development']['cachedir'] = "";
$db['development']['char_set'] = "utf8";
$db['development']['dbcollat'] = "utf8_general_ci";
/* End of file database.php */
/* Location: ./system/application/config/database.php */

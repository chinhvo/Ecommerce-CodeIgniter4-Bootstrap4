<?php
namespace Config;
use CodeIgniter\Database\Config;
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
 |	['dsn']      The full DSN string describe a connection to the database.
 |	['hostname'] The hostname of your database server.
 |	['username'] The username used to connect to the database
 |	['password'] The password used to connect to the database
 |	['database'] The name of the database you want to connect to
 |	['dbdriver'] The database driver. e.g.: mysqli.
 |			Currently supported:
 |				 cubrid, ibase, mssql, mysql, mysqli, oci8,
 |				 odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
 |	['dbprefix'] You can add an optional prefix, which will be added
 |				 to the table name when using the  Query Builder class
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
 |	['encrypt']  Whether or not to use an encrypted connection.
 |
 |			'mysql' (deprecated), 'sqlsrv' and 'pdo/sqlsrv' drivers accept TRUE/FALSE
 |			'mysqli' and 'pdo/mysql' drivers accept an array with the following options:
 |
 |				'ssl_key'    - Path to the private key file
 |				'ssl_cert'   - Path to the public key certificate file
 |				'ssl_ca'     - Path to the certificate authority file
 |				'ssl_capath' - Path to a directory containing trusted CA certificats in PEM format
 |				'ssl_cipher' - List of *allowed* ciphers to be used for the encryption, separated by colons (':')
 |				'ssl_verify' - TRUE/FALSE; Whether verify the server certificate or not ('mysqli' only)
 |
 |	['compress'] Whether or not to use client compression (MySQL only)
 |	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
 |							- good for ensuring strict SQL while developing
 |	['ssl_options']	Used to set various SSL options that can be used when making SSL connections.
 |	['failover'] array - A array with 0 or more data for connections if the main should fail.
 |	['save_queries'] TRUE/FALSE - Whether to "save" all executed queries.
 | 				NOTE: Disabling this will also effectively disable both
 | 				$this->db->last_query() and profiling of DB queries.
 | 				When you run a query, with this setting set to TRUE (default),
 | 				CodeIgniter will store the SQL statement for debugging purposes.
 | 				However, this may cause high memory usage, especially if you run
 | 				a lot of SQL queries ... disable this to avoid that problem.
 |
 | The $active_group variable lets you choose which connection group to
 | make active.  By default there is only one group (the 'default' group).
 |
 | The $query_builder variables lets you determine whether or not to load
 | the query builder class.
 */
/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    
    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';
    
    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'root',
        'password'     => 'root',
        'database'     => 'usfetyhp_wovegreendb',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
        'foundRows'    => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];
    
    //    /**
    //     * Sample database connection for SQLite3.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'database'    => 'database.db',
    //        'DBDriver'    => 'SQLite3',
    //        'DBPrefix'    => '',
    //        'DBDebug'     => true,
    //        'swapPre'     => '',
    //        'failover'    => [],
    //        'foreignKeys' => true,
    //        'busyTimeout' => 1000,
    //        'synchronous' => null,
    //        'dateFormat'  => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];
    
    //    /**
    //     * Sample database connection for Postgre.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => '',
    //        'hostname'   => 'localhost',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'database'   => 'ci4',
    //        'schema'     => 'public',
    //        'DBDriver'   => 'Postgre',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'utf8',
    //        'swapPre'    => '',
    //        'failover'   => [],
    //        'port'       => 5432,
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];
    
    //    /**
    //     * Sample database connection for SQLSRV.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => '',
    //        'hostname'   => 'localhost',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'database'   => 'ci4',
    //        'schema'     => 'dbo',
    //        'DBDriver'   => 'SQLSRV',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'utf8',
    //        'swapPre'    => '',
    //        'encrypt'    => false,
    //        'failover'   => [],
    //        'port'       => 1433,
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];
    
    //    /**
    //     * Sample database connection for OCI8.
    //     *
    //     * You may need the following environment variables:
    //     *   NLS_LANG                = 'AMERICAN_AMERICA.UTF8'
    //     *   NLS_DATE_FORMAT         = 'YYYY-MM-DD HH24:MI:SS'
    //     *   NLS_TIMESTAMP_FORMAT    = 'YYYY-MM-DD HH24:MI:SS'
    //     *   NLS_TIMESTAMP_TZ_FORMAT = 'YYYY-MM-DD HH24:MI:SS'
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => 'localhost:1521/XEPDB1',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'DBDriver'   => 'OCI8',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'AL32UTF8',
    //        'swapPre'    => '',
    //        'failover'   => [],
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];
    
    /**
     * This database connection is used when running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];   

    
    public function __construct()
    {
        parent::__construct();
        
        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}



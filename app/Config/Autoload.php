<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

/**
 * -------------------------------------------------------------------
 * AUTOLOADER CONFIGURATION
 * -------------------------------------------------------------------
 *
 * This file defines the namespaces and class maps so the Autoloader
 * can find the files as needed.
 *
 * NOTE: If you use an identical key in $psr4 or $classmap, then
 *       the values in this file will overwrite the framework's values.
 *
 * NOTE: This class is required prior to Autoloader instantiation,
 *       and does not extend BaseConfig.
 */
class Autoload extends AutoloadConfig
{
    /**
     * -------------------------------------------------------------------
     * Namespaces
     * -------------------------------------------------------------------
     * This maps the locations of any namespaces in your application to
     * their location on the file system. These are used by the autoloader
     * to locate files the first time they have been instantiated.
     *
     * The 'Config' (APPPATH . 'Config') and 'CodeIgniter' (SYSTEMPATH) are
     * already mapped for you.
     *
     * You may change the name of the 'App' namespace if you wish,
     * but this should be done prior to creating any namespaced classes,
     * else you will need to modify all of those classes for this to work.
     *
     * @var array<string, list<string>|string>
     */
    public $psr4 = [
        APP_NAMESPACE => APPPATH,
        'Modules\\Admin' => APPPATH . 'Modules/Admin',
        'Modules\\Vendor' => APPPATH . 'Modules/Vendor',
    ];

    /**
     * -------------------------------------------------------------------
     * Class Map
     * -------------------------------------------------------------------
     * The class map provides a map of class names and their exact
     * location on the drive. Classes loaded in this manner will have
     * slightly faster performance because they will not have to be
     * searched for within one or more directories as they would if they
     * were being autoloaded through a namespace.
     *
     * Prototype:
     *   $classmap = [
     *       'MyClass'   => '/path/to/class/file.php'
     *   ];
     *
     * @var array<string, string>
     */
    public $classmap = [];

    /**
     * -------------------------------------------------------------------
     * Files
     * -------------------------------------------------------------------
     * The files array provides a list of paths to __non-class__ files
     * that will be autoloaded. This can be useful for bootstrap operations
     * or for loading functions.
     *
     * Prototype:
     *   $files = [
     *       '/path/to/my/file.php',
     *   ];
     *
     * @var list<string>
     */
    public $files = [];

    /**
     * -------------------------------------------------------------------
     * Helpers
     * -------------------------------------------------------------------
     * Prototype:
     *   $helpers = [
     *       'form',
     *   ];
     *
     * @var list<string>
     */
    public $helpers = [
        'overwrite_functions',
        'url',
        'language',
        'text',
        'cookie',
        'getTextualPages',
        'mb_ucfirst',
        'purchase_steps',
        'cleanreferral',
        'request_method',
        'except_letters',
        'file',
        'pagination',
        'currencies',
        'rcopy',
        'rrmdir',
        'rreadDir',
        'savefile',
        'vnToStr',
    ];

    /*
     | -------------------------------------------------------------------
     | AUTO-LOADER
     | -------------------------------------------------------------------
     | This file specifies which systems should be loaded by default.
     |
     | In order to keep the framework as light-weight as possible only the
     | absolute minimal resources are loaded by default. For example,
     | the database is not connected to automatically since no assumption
     | is made regarding whether you intend to use it.  This file lets
     | you globally define which systems you would like loaded with every
     | request.
     |
     | -------------------------------------------------------------------
     | Instructions
     | -------------------------------------------------------------------
     |
     | These are the things you can load automatically:
     |
     | 1. Packages
     | 2. Libraries
     | 3. Drivers
     | 4. Helper files
     | 5. Custom config files
     | 6. Language files
     | 7. Models
     |
     */

    /*
     | -------------------------------------------------------------------
     |  Auto-load Packages
     | -------------------------------------------------------------------
     | Prototype:
     |
     |  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
     |
     */
    public $packages = array();

    /*
     | -------------------------------------------------------------------
     |  Auto-load Libraries
     | -------------------------------------------------------------------
     | These are the classes located in system/libraries/ or your
     | application/libraries/ directory, with the addition of the
     | 'database' library, which is somewhat of a special case.
     |
     | Prototype:
     |
     |	$autoload['libraries'] = array('database', 'email', 'session');
     |
     | You can also supply an alternative library name to be assigned
     | in the controller:
     |
     |	$autoload['libraries'] = array('user_agent' => 'ua');
     */
    public $libraries = array(
        'database',
        'session',
        'loop',
        'ShoppingCart',
        'Language',
        'SendMail'
    );

    /*
     | -------------------------------------------------------------------
     |  Auto-load Drivers
     | -------------------------------------------------------------------
     | These classes are located in system/libraries/ or in your
     | application/libraries/ directory, but are also placed inside their
     | own subdirectory and they extend the CI_Driver_Library class. They
     | offer multiple interchangeable driver options.
     |
     | Prototype:
     |
     |	$autoload['drivers'] = array('cache');
     */
    public $drivers = array();

    /*
     | -------------------------------------------------------------------
     |  Auto-load Config files
     | -------------------------------------------------------------------
     | Prototype:
     |
     |	$autoload['config'] = array('config1', 'config2');
     |
     | NOTE: This item is intended for use ONLY if you have created custom
     | config files.  Otherwise, leave it blank.
     |
     */
    public $config = array();

    /*
     | -------------------------------------------------------------------
     |  Auto-load Language files
     | -------------------------------------------------------------------
     | Prototype:
     |
     |	$autoload['language'] = array('lang1', 'lang2');
     |
     | NOTE: Do not include the "_lang" part of your file.  For example
     | "codeigniter_lang.php" would be referenced as array('codeigniter');
     |
     */
    public $language = array();

    /*
     | -------------------------------------------------------------------
     |  Auto-load Models
     | -------------------------------------------------------------------
     | Prototype:
     |
     |	$autoload['model'] = array('first_model', 'second_model');
     |
     | You can also supply an alternative model name to be assigned
     | in the controller:
     |
     |	$autoload['model'] = array('first_model' => 'first');
     */
    public $model = array('PublicModel', 'HomeAdminModel');
}

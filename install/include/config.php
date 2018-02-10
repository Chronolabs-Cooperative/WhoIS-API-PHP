<?php
/**
 * WhoIS REST Services API
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://syd.au.snails.email
 * @license         ACADEMIC APL 2 (https://sourceforge.net/u/chronolabscoop/wiki/Academic%20Public%20License%2C%20version%202.0/)
 * @license         GNU GPL 3 (http://www.gnu.org/licenses/gpl.html)
 * @package         whois-api
 * @since           2.2.13
 * @author          Dr. Simon Antony Roberts <simon@snails.email>
 * @version         2.2.14
 * @description		A REST API Interface which retrieves IPv4, IPv6, TLD, gLTD Whois Data
 * @link            http://internetfounder.wordpress.com
 * @link            https://github.com/Chronolabs-Cooperative/WhoIS-API-PHP
 * @link            https://sourceforge.net/p/chronolabs-cooperative
 * @link            https://facebook.com/ChronolabsCoop
 * @link            https://twitter.com/ChronolabsCoop
 * 
 */


if (!defined('API_INSTALL')) {
    die('API Custom Installation die');
}

$configs = array();

// setup config site info
$configs['db_types'] = array('mysql' => 'mysqli');

// setup config site info
$configs['conf_names'] = array(
);

// languages config files
$configs['language_files'] = array(
    'global');

// extension_loaded
$configs['extensions'] = array(
);

// Writable files and directories
$configs['writable'] = array(
    'uploads/',
    'data/',
    'include/',
    'mainfile.php',
    'include/license.php',
    'include/dbconfig.php',
    );

// GeoIP Resource data files default paths
$configs['apiurl'] = array(
    'strata' => 'http://strata.snails.email'
);

// Modules to be installed by default
$configs['modules'] = array();

// api_lib, api_tmp directories
$configs['apiPathDefault'] = array(
    'lib'  => 'data');

// writable api_lib, api_tmp directories
$configs['tmpPath'] = array(
    'caches'  => __DIR__ . '/caches',
    'includes' => __DIR__ . '/include',
    'tmp'    => '/tmp');

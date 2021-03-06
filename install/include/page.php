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

$pages = array(
    'langselect'      => array(
        'name'  => LANGUAGE_SELECTION,
        'title' => LANGUAGE_SELECTION_TITLE,
        'icon'  => 'fa fa-fw fa-language'
    ),
    'start'           => array(
        'name'  => INTRODUCTION,
        'title' => INTRODUCTION_TITLE,
        'icon'  => 'fa fa-fw fa-exclamation-circle'
    ),
    'modcheck'        => array(
        'name'  => CONFIGURATION_CHECK,
        'title' => CONFIGURATION_CHECK_TITLE,
        'icon'  => 'fa fa-fw fa-server'
    ),
    'pathsettings'    => array(
        'name'  => PATHS_SETTINGS,
        'title' => PATHS_SETTINGS_TITLE,
        'icon'  => 'fa fa-fw fa-folder-open'
    ),
    'extrasettings'    => array(
        'name'  => PATHS_EXTRA,
        'title' => PATHS_EXTRA_TITLE,
        'icon'  => 'fa fa-fw fa-folder-open'
    ),
    'dbconnection'    => array(
        'name'  => DATABASE_CONNECTION,
        'title' => DATABASE_CONNECTION_TITLE,
        'icon'  => 'fa fa-fw fa-exchange'
    ),
    'dbsettings'      => array(
        'name'  => DATABASE_CONFIG,
        'title' => DATABASE_CONFIG_TITLE,
        'icon'  => 'fa fa-fw fa-tmpbase'
    ),
    'configsave'      => array(
        'name'  => CONFIG_SAVE,
        'title' => CONFIG_SAVE_TITLE,
        'icon'  => 'fa fa-fw fa-download'
    ),
    'tablescreate'    => array(
        'name'  => TABLES_CREATION,
        'title' => TABLES_CREATION_TITLE,
        'icon'  => 'fa fa-fw fa-sitemap'
    ),
    'siteinit'        => array(
        'name'  => INITIAL_SETTINGS,
        'title' => INITIAL_SETTINGS_TITLE,
        'icon'  => 'fa fa-fw fa-sliders'
    ),
    'tablesfill'      => array(
        'name'  => TMP_INSERTION,
        'title' => TMP_INSERTION_TITLE,
        'icon'  => 'fa fa-fw fa-cloud-upload'
    ),
    'end'             => array(
        'name'  => WELCOME,
        'title' => WELCOME_TITLE,
        'icon'  => 'fa fa-fw fa-thumbs-o-up'
    )
);

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


/**
 * API preload implemented in API is different from methods defined in this class, thus module developers are advised to be careful if you use current preload methods
 */

defined('API_ROOT_PATH') || exit('Restricted access');

APILoad::load('APILists');
APILoad::load('APICache');

/**
 * Class for handling events
 *
 * @copyright       (c) 2000-2016 API Project (www.api.org)
 * @license             GNU GPL 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package             kernel
 * @subpackage          class
 * @author              trabis <lusopoemas@gmail.com>
 */
class APIPreload
{
    /**
     * @var array $_preloads array containing information about the event observers
     */
    public $_preloads = array();

    /**
     * @var array $_events array containing the events that are being observed
     */
    public $_events = array();

    /**
     * Constructor
     *
     */
    protected function __construct()
    {
        $this->setPreloads();
        $this->setEvents();
    }

    /**
     * Allow one instance only!
     *
     * @return object
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new APIPreload();
        }

        return $instance;
    }

    /**
     * Get available preloads information and set them to go!
     *
     * @return void
     */
    public function setPreloads()
    {
        //$modules_list = APILists::getDirListAsArray(API_ROOT_PATH . "/modules/");
        if ($modules_list = APICache::read('system_modules_active')) {
            $i = 0;
            foreach ($modules_list as $module) {
                if (is_dir($dir = API_ROOT_PATH . "/modules/{$module}/preloads/")) {
                    $file_list = APILists::getFileListAsArray($dir);
                    foreach ($file_list as $file) {
                        if (preg_match('/(\.php)$/i', $file)) {
                            $file                          = substr($file, 0, -4);
                            $this->_preloads[$i]['module'] = $module;
                            $this->_preloads[$i]['file']   = $file;
                            ++$i;
                        }
                    }
                }
            }
        }
    }

    /**
     * Get available events and set them to go!
     *
     * @return void
     */
    public function setEvents()
    {
        foreach ($this->_preloads as $preload) {
            include_once API_ROOT_PATH . '/modules/' . $preload['module'] . '/preloads/' . $preload['file'] . '.php';
            $class_name = ucfirst($preload['module']) . ucfirst($preload['file']) . 'Preload';
            if (!class_exists($class_name)) {
                continue;
            }
            $class_methods = get_class_methods($class_name);
            foreach ($class_methods as $method) {
                if (strpos($method, 'event') === 0) {
                    $event_name                   = strtolower(str_replace('event', '', $method));
                    $event                        = array('class_name' => $class_name, 'method' => $method);
                    $this->_events[$event_name][] = $event;
                }
            }
        }
    }

    /**
     * Triggers a specific event
     *
     * @param $event_name string Name of the event to trigger
     * @param $args       array Method arguments
     *
     * @return void
     */
    public function triggerEvent($event_name, $args = array())
    {
        $event_name = strtolower(str_replace('.', '', $event_name));
        if (isset($this->_events[$event_name])) {
            foreach ($this->_events[$event_name] as $event) {
                call_user_func(array($event['class_name'], $event['method']), $args);
            }
        }
    }
}

/**
 * APIPreloadItem
 *
 * Class which is extended by any preload item.
 *
 * @copyright       (c) 2000-2016 API Project (www.api.org)
 * @license             GNU GPL 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package             kernel
 * @subpackage          class
 * @author              trabis <lusopoemas@gmail.com>
 */
class APIPreloadItem
{
    /**
     * APIPreloadItem constructor.
     */
    public function __construct()
    {
    }
}

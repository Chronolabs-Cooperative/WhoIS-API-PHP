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

defined('API_ROOT_PATH') || exit('Restricted access');

api_load('APILists');
api_load('APIFormSelect');

/**
 * A select box with available themes
 */
class APIFormSelectTheme extends APIFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption
     * @param string $name
     * @param mixed  $value             Pre-selected value (or array of them).
     * @param int    $size              Number or rows. "1" makes a drop-down-list
     * @param bool   $theme_set_allowed Flag to use only selectable theme
     */
    public function __construct($caption, $name, $value = null, $size = 1, $theme_set_allowed = false)
    {
        parent::__construct($caption, $name, $value, $size);
        if ($theme_set_allowed === false) {
            $this->addOptionArray(APILists::getThemesList());
        } else {
            $theme_arr = $GLOBALS['apiConfig']['theme_set_allowed'];
            foreach (array_keys($theme_arr) as $i) {
                $this->addOption($theme_arr[$i], $theme_arr[$i]);
            }
        }
    }
}

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

defined('API_ROOT_PATH') || exit('API root path not defined');

api_load('APIFormElement');

/**
 *
 *
 * @package             kernel
 * @subpackage          form
 *
 * @author              Kazumi Ono    <onokazu@api.org>
 * @copyright       (c) 2000-2016 API Project (www.api.org)
 */

/**
 * A button
 *
 * @author              Kazumi Ono    <onokazu@api.org>
 * @copyright       (c) 2000-2016 API Project (www.api.org)
 *
 * @package             kernel
 * @subpackage          form
 */
class APIFormButton extends APIFormElement
{
    /**
     * Value
     * @var string
     * @access    private
     */
    public $_value;

    /**
     * Type of the button. This could be either "button", "submit", or "reset"
     * @var string
     * @access    private
     */
    public $_type;

    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name
     * @param string $value
     * @param string $type    Type of the button. Potential values: "button", "submit", or "reset"
     */
    public function __construct($caption, $name, $value = '', $type = 'button')
    {
        $this->setCaption($caption);
        $this->setName($name);
        $this->_type = $type;
        $this->setValue($value);
    }

    /**
     * Get the initial value
     *
     * @param  bool $encode To sanitizer the text?
     * @return string
     */
    public function getValue($encode = false)
    {
        return $encode ? htmlspecialchars($this->_value, ENT_QUOTES) : $this->_value;
    }

    /**
     * Set the initial value
     *
     * @param $value
     *
     * @return string
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }

    /**
     * Get the type
     *
     * @return string
     */
    public function getType()
    {
        return in_array(strtolower($this->_type), array('button', 'submit', 'reset')) ? $this->_type : 'button';
    }

    /**
     * prepare HTML for output
     *
     * @return string
     */
    public function render()
    {
        return APIFormRenderer::getInstance()->get()->renderFormButton($this);
    }
}

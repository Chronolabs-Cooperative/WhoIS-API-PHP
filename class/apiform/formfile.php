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

/**
 * A file upload field
 */
class APIFormFile extends APIFormElement
{
    /**
     * Maximum size for an uploaded file
     *
     * @var int
     * @access private
     */
    public $_maxFileSize;

    /**
     * Constructor
     *
     * @param string $caption     Caption
     * @param string $name        "name" attribute
     * @param int    $maxfilesize Maximum size for an uploaded file
     */
    public function __construct($caption, $name, $maxfilesize)
    {
        $this->setCaption($caption);
        $this->setName($name);
        $this->_maxFileSize = (int)$maxfilesize;
    }

    /**
     * Get the maximum filesize
     *
     * @return int
     */
    public function getMaxFileSize()
    {
        return $this->_maxFileSize;
    }

    /**
     * prepare HTML for output
     *
     * @return string HTML
     */
    public function render()
    {
        return APIFormRenderer::getInstance()->get()->renderFormFile($this);
    }
}

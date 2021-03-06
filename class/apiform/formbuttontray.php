<?php
/**
 * API Form Class Elements
 *
 * @copyright       (c) 2000-2017 API Project (www.api.org)
 * @license             GNU GPL 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package             kernel
 * @subpackage          form
 * @since               2.4.0
 * @author              John Neill <catzwolf@api.org>
 *
 */
defined('API_ROOT_PATH') || exit('Restricted access');

/**
 * APIFormButtonTray
 *
 * @author         John Neill <catzwolf@api.org>
 * @package        kernel
 * @subpackage     form
 * @access         public
 */
class APIFormButtonTray extends APIFormElement
{
    /**
     * Value
     *
     * @var string
     * @access private
     */
    public $_value;

    /**
     * Type of the button. This could be either "button", "submit", or "reset"
     *
     * @var string
     * @access private
     */
    public $_type;

    public $_showDelete;

    /**
     * Constructor
     *
     * @param mixed  $name
     * @param string $value
     * @param string $type
     * @param string $onclick
     * @param bool   $showDelete
     */
    public function __construct($name, $value = '', $type = '', $onclick = '', $showDelete = false)
    {
        $this->setName($name);
        $this->setValue($value);
        $this->_type       = (!empty($type)) ? $type : 'submit';
        $this->_showDelete = $showDelete;
        if ($onclick) {
            $this->setExtra($onclick);
        } else {
            $this->setExtra('');
        }
    }

    /**
     * APIFormButtonTray::getValue()
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * APIFormButtonTray::setValue()
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }

    /**
     * APIFormButtonTray::getType()
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * APIFormButtonTray::render()
     *
     * @return string|void
     */
    public function render()
    {
        return APIFormRenderer::getInstance()->get()->renderFormButtonTray($this);
    }
}

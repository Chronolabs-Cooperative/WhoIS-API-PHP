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

interface APIFormRendererInterface
{
    /**
     * Render support for APIFormButton
     *
     * @param APIFormButton $element form element
     *
     * @return string rendered form element
     */
    public function renderFormButton(APIFormButton $element);

    /**
     * Render support for APIFormButtonTray
     *
     * @param APIFormButtonTray $element form element
     *
     * @return string rendered form element
     */
    public function renderFormButtonTray(APIFormButtonTray $element);

    /**
     * Render support for APIFormCheckBox
     *
     * @param APIFormCheckBox $element form element
     *
     * @return string rendered form element
     */
    public function renderFormCheckBox(APIFormCheckBox $element);

    /**
     * Render support for APIFormColorPicker
     *
     * @param APIFormColorPicker $element form element
     *
     * @return string rendered form element
     */
    public function renderFormColorPicker(APIFormColorPicker $element);

    /**
     * Render support for APIFormDhtmlTextArea
     *
     * @param APIFormDhtmlTextArea $element form element
     *
     * @return string rendered form element
     */
    public function renderFormDhtmlTextArea(APIFormDhtmlTextArea $element);

    /**
     * Render support for APIFormElementTray
     *
     * @param APIFormElementTray $element form element
     *
     * @return string rendered form element
     */
    public function renderFormElementTray(APIFormElementTray $element);

    /**
     * Render support for APIFormFile
     *
     * @param APIFormFile $element form element
     *
     * @return string rendered form element
     */
    public function renderFormFile(APIFormFile $element);

    /**
     * Render support for APIFormLabel
     *
     * @param APIFormLabel $element form element
     *
     * @return string rendered form element
     */
    public function renderFormLabel(APIFormLabel $element);

    /**
     * Render support for APIFormPassword
     *
     * @param APIFormPassword $element form element
     *
     * @return string rendered form element
     */
    public function renderFormPassword(APIFormPassword $element);

    /**
     * Render support for APIFormRadio
     *
     * @param APIFormRadio $element form element
     *
     * @return string rendered form element
     */
    public function renderFormRadio(APIFormRadio $element);

    /**
     * Render support for APIFormSelect
     *
     * @param APIFormSelect $element form element
     *
     * @return string rendered form element
     */
    public function renderFormSelect(APIFormSelect $element);

    /**
     * Render support for APIFormText
     *
     * @param APIFormText $element form element
     *
     * @return string rendered form element
     */
    public function renderFormText(APIFormText $element);

    /**
     * Render support for APIFormTextArea
     *
     * @param APIFormTextArea $element form element
     *
     * @return string rendered form element
     */
    public function renderFormTextArea(APIFormTextArea $element);

    /**
     * Render support for APIFormTextDateSelect
     *
     * @param APIFormTextDateSelect $element form element
     *
     * @return string rendered form element
     */
    public function renderFormTextDateSelect(APIFormTextDateSelect $element);

    /**
     * Render support for APIThemeForm
     *
     * @param APIThemeForm $form form to render
     *
     * @return string rendered form
     */
    public function renderThemeForm(APIThemeForm $form);

    /**
     * Support for themed addBreak
     *
     * @param APIThemeForm $form  form
     * @param string         $extra pre-rendered content for break row
     * @param string         $class class for row
     *
     * @return void
     */
    public function addThemeFormBreak(APIThemeForm $form, $extra, $class);
}

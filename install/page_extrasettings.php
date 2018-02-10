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


require_once './include/common.inc.php';
defined('API_INSTALL') || die('API Installation wizard die');

$wizard->loadLangFile('extras');

include_once './include/functions.php';

$pageHasForm = true;
$pageHasHelp = true;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && @$_GET['var'] && @$_GET['action'] === 'checkfile') {
    $file                   = $_GET['var'];
    echo genPathCheckHtml($file, is_file($file));
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enabled = array();
    foreach($wizard->configs['apiurl'] as $setting => $values)
    {
        $_SESSION['constants'][$setting]['api_url'] = $_POST[$setting];
    }
    $wizard->redirectToPage('+1');
    return 302;
}
ob_start();
?>
    <div class="panel panel-info">
        <div class="panel-heading"><?php echo API_EXTRAS; ?></div>
        <div class="panel-body">
        <div class="form-group">
            <?php 
            foreach($wizard->configs['apiurl'] as $setting => $default)
            {?>
            <label for="<?php echo $setting; ?>"><?php echo constant("API_".strtoupper($setting) . "_API_URL_LABEL"); ?></label>
                <div class="xoform-help alert alert-info"><?php echo constant("API_".strtoupper($setting) . "_API_URL_HELP"); ?></div>
                <input type="text" class="form-control" name="<?php echo $setting; ?>" id="<?php echo $setting; ?>" value="<?php echo $default; ?>"/>
            <?php }
            ?>
       </div>
   </div>

<?php
$content = ob_get_contents();
ob_end_clean();

include './include/install_tpl.php';

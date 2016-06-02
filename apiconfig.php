<?php
/**
 * Chronolabs REST Blowfish Salts Repository API
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         salty
 * @since           2.0.1
 * @author          Simon Roberts <wishcraft@users.sourceforge.net>
 * @version         $Id: apiconfig.php 1000 2015-06-16 23:11:55Z wishcraft $
 * @subpackage		api
 * @description		Blowfish Salts Repository API
 * @link			http://cipher.labs.coop
 * @link			http://sourceoforge.net/projects/chronolabsapis
 */

/**
 * Opens Access Origin Via networking Route NPN
 */
header('Access-Control-Allow-Origin: *');
header('Origin: *');

/**
 * Turns of GZ Lib Compression for Document Incompatibility
 */
ini_set("zlib.output_compression", 'Off');
ini_set("zlib.output_compression_level", -1);

/**
 * 
 * @var constants
 */
define("API_FILE_IO_PEERS", __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'peers.diz');
define("API_FILE_IO_DOMAINS", __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'domains.diz');
define("API_FILE_IO_FOOTER", __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'api-localhost.html');
define("API_HISTORY_TLDS", __DIR__ . DIRECTORY_SEPARATOR . 'history' . DIRECTORY_SEPARATOR . 'domain');
define("API_HISTORY_IPV4", __DIR__ . DIRECTORY_SEPARATOR . 'history' . DIRECTORY_SEPARATOR . 'ipv4');
define("API_HISTORY_IPV6", __DIR__ . DIRECTORY_SEPARATOR . 'history' . DIRECTORY_SEPARATOR . 'ipv6');

error_reporting(0);
ini_set('display_errors', false);
ini_set('log_errors', false);


if (!function_exists("getDomainSupportism")) {

	/* function getDomainSupportism()
	 *
	 * 	Get a supporting domain system for the API
	 * @author 		Simon Roberts (Chronolabs) simon@labs.coop
	 *
	 * @return 		string
	 */
	function getDomainSupportism($variable = 'array', $realm = '')
	{
		static $ret = array();
		if (empty($ret))
		{
			$supporters = file(API_FILE_IO_DOMAINS);
			foreach($supporters as $supporter)
			{
				$parts = explode("||", $supporter);
				if (strpos(' '.strtolower($realm), strtolower($parts[0]))>0)
				{
					$ret['domain'] = $parts[0];
					$ret['protocol'] = $parts[1];
					$ret['business'] = $parts[2];
					$ret['entity'] = $parts[3];
					$ret['contact'] = $parts[4];
					$ret['referee'] = $parts[5];
					continue;
				}
			}
		}
		if (isset($ret[$variable]))
			return $ret[$variable];
		return $ret;
	}
}


if (!function_exists("getPingTiming")) {

	/* function getPingTiming()
	 *
	 * 	Get a ping timing for a URL
	 * @author 		Simon Roberts (Chronolabs) simon@labs.coop
	 *
	 * @return 		float()
	 */
	function getPingTiming($uri = '', $timeout = 7, $connectout = 8)
	{
		ob_start();
		$start = microtime(true);
		if (!function_exists("curl_init"))
		{
			if (strlen(file_get_contents($uri))>0) {
				ob_end_clean();
				return microtime(true)-$start*1000;
			}
		} else {
			if (!$btt = curl_init($uri)) {
				ob_end_clean();
				return false;
			}
			curl_setopt($btt, CURLOPT_HEADER, 0);
			curl_setopt($btt, CURLOPT_POST, 0);
			curl_setopt($btt, CURLOPT_CONNECTTIMEOUT, $connectout);
			curl_setopt($btt, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($btt, CURLOPT_RETURNTRANSFER, false); 
			curl_setopt($btt, CURLOPT_VERBOSE, false);
			curl_setopt($btt, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($btt, CURLOPT_SSL_VERIFYPEER, false);
			@curl_exec($btt);
			$httpcode = curl_getinfo($btt, CURLINFO_HTTP_CODE);
			curl_close($btt);
			if($httpcode>=200 && $httpcode<300){
				ob_end_clean();
	  			return microtime(true)-$start*1000;
			} 
		}
		ob_end_clean();
		return false;
	}
}


if (!function_exists("getURIData")) {

	/* function getURIData()
	 *
	* 	Get a supporting domain system for the API
	* @author 		Simon Roberts (Chronolabs) simon@labs.coop
	*
	* @return 		float()
	*/
	function getURIData($uri = '', $timeout = 25, $connectout = 25)
	{
		if (!function_exists("curl_init"))
		{
			return file_get_contents($uri);
		}
		if (!$btt = curl_init($uri)) {
			return false;
		}
		curl_setopt($btt, CURLOPT_HEADER, 0);
		curl_setopt($btt, CURLOPT_POST, 0);
		curl_setopt($btt, CURLOPT_CONNECTTIMEOUT, $connectout);
		curl_setopt($btt, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($btt, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($btt, CURLOPT_VERBOSE, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($btt);
		curl_close($btt);
		return $data;
	}
}


if (!function_exists("getPeersSupporting")) {

	/* function getPeersSupporting()
	 *
	* 	Get a supporting domain system for the API
	* @author 		Simon Roberts (Chronolabs) simon@labs.coop
	*
	* @return 		array()
	*/
	function getPeersSupporting()
	{
		if (filectime(API_FILE_IO_PEERS) + 3600 * 24 * 3.75 <= time())
		{
			if (getPingTiming("http://peers.labs.coop/v2/" . basename(__DIR__) . "/json.api")>1 
				&& $peerise = json_decode(getURIData("http://peers.labs.coop/v2/" . basename(__DIR__) . "/json.api"), true))
			{
				$ioout = array();
				foreach($peerise as $ll => $values)
					$ioout[] = implode("||", $values);
				if (count($ioout)>1)
					writeRawFile(API_FILE_IO_PEERS, implode("\n", $ioout));
			}
		}
		static $ret = array();
		if (empty($ret))
		{
			$peerings = file(API_FILE_IO_PEERS);
			foreach($peerings as $peer)
			{
				$parts = explode("||", $peer);
				$realm = $parts[0];
				$ret[$realm]['domain'] = $parts[0];
				$ret[$realm]['protocol'] = $parts[1];
				$ret[$realm]['business'] = $parts[2];
				$ret[$realm]['search'] = $parts[3];
				$ret[$realm]['mirror'] = $parts[4];
				$ret[$realm]['contact'] = $parts[5];
				$ret[$realm]['ping'] = getPingTiming($parts[1].$parts[0]);
			}
		}
		return $ret;
	}
}


if (!function_exists("writeRawFile")) {
	/**
	 * 
	 * @param string $file
	 * @param string $data
	 */
	function writeRawFile($file = '', $data = '')
	{
		$lineBreak = "\n";
		if (substr(PHP_OS, 0, 3) == 'WIN') {
			$lineBreak = "\r\n";
		}
		if (!is_dir(dirname($file)))
			mkdir(dirname($file), 0777, true);
		if (is_file($file))
			unlink($file);
		$data = str_replace("\n", $lineBreak, $data);
		$ff = fopen($file, 'w');
		fwrite($ff, $data, strlen($data));
		fclose($ff);
	}
}


?>
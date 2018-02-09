<?php
/**
 * Chronolabs REST Whois API
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
 * @package         whois
 * @since           1.0.2
 * @author          Simon Roberts <meshy@labs.coop>
 * @version         $Id: whois.php 1000 2013-06-07 01:20:22Z mynamesnot $
 * @subpackage		api
 * @description		Whois API Service REST
 */

require_once __DIR__ . DS . 'apiserver.php';
require_once __DIR__ . DS . 'cache' . DS . 'apicache.php';

/**
 * API Server Class Factory
 *
 * @author     Simon Roberts <meshy@labs.coop>
 * @package    whois
 * @subpackage api
 */
class whois extends apiserver {
	
	/**
	 * @var array $_ip_whois				IP Address Whois Buffer
	 */
	var $_ip_whois = array();
	
	/**
	 * @var array $_ip_whoisservers			Whois Services for IPv4 & IPv6 Addresses
	 */
	var $_ip_whoisservers = array(
			"whois.afrinic.net",
			"whois.lacnic.net",
			"whois.apnic.net",
			"whois.arin.net",
			"whois.ripe.net"
	);
	
	/**
	 * @var array $_domain_whois			Domain Name Whois Buffer
	 */
	var $_domain_whois = array();
	
	/**
	 * @var array $_domain_whoisservers		Whois Services for TLDs
	 */
	var $_domain_whoisservers = array(
			"ac" =>"whois.nic.ac",
			"ae" =>"whois.nic.ae",
			"aero"=>"whois.aero",
			"af" =>"whois.nic.af",
			"ag" =>"whois.nic.ag",
			"al" =>"whois.ripe.net",
			"am" =>"whois.amnic.net",
			"arpa" =>"whois.iana.org",
			"as" =>"whois.nic.as",
			"asia" =>"whois.nic.asia",
			"at" =>"whois.nic.at",
			"au" =>"whois.aunic.net",
			"az" =>"whois.ripe.net",
			"ba" =>"whois.ripe.net",
			"be" =>"whois.dns.be",
			"bg" =>"whois.register.bg",
			"bi" =>"whois.nic.bi",
			"biz" =>"whois.biz",
			"bj" =>"whois.nic.bj",
			"br" =>"whois.registro.br",
			"bt" =>"whois.netnames.net",
			"by" =>"whois.ripe.net",
			"bz" =>"whois.belizenic.bz",
			"ca" =>"whois.cira.ca",
			"cat" =>"whois.cat",
			"cc" =>"whois.nic.cc",
			"cd" =>"whois.nic.cd",
			"ch" =>"whois.nic.ch",
			"ci" =>"whois.nic.ci",
			"ck" =>"whois.nic.ck",
			"cl" =>"whois.nic.cl",
			"cn" =>"whois.cnnic.net.cn",
			"com" =>"whois.verisign-grs.com",
			"coop" =>"whois.nic.coop",
			"cx" =>"whois.nic.cx",
			"cy" =>"whois.ripe.net",
			"cz" =>"whois.nic.cz",
			"de" =>"whois.denic.de",
			"dk" =>"whois.dk-hostmaster.dk",
			"dm" =>"whois.nic.cx",
			"dz" =>"whois.ripe.net",
			"edu" =>"whois.educause.edu",
			"ee" =>"whois.eenet.ee",
			"eg" =>"whois.ripe.net",
			"es" =>"whois.ripe.net",
			"eu" =>"whois.eu",
			"fi" =>"whois.ficora.fi",
			"fo" =>"whois.ripe.net",
			"fr" =>"whois.nic.fr",
			"gb" =>"whois.ripe.net",
			"gd" =>"whois.adamsnames.com",
			"ge" =>"whois.ripe.net",
			"gg" =>"whois.channelisles.net",
			"gi" =>"whois2.afilias-grs.net",
			"gl" =>"whois.ripe.net",
			"gm" =>"whois.ripe.net",
			"gov" =>"whois.nic.gov",
			"gr" =>"whois.ripe.net",
			"gs" =>"whois.nic.gs",
			"gw" =>"whois.nic.gw",
			"gy" =>"whois.registry.gy",
			"hk" =>"whois.hkirc.hk",
			"hm" =>"whois.registry.hm",
			"hn" =>"whois2.afilias-grs.net",
			"hr" =>"whois.ripe.net",
			"hu" =>"whois.nic.hu",
			"ie" =>"whois.domainregistry.ie",
			"il" =>"whois.isoc.org.il",
			"in" =>"whois.inregistry.net",
			"info" =>"whois.afilias.net",
			"int" =>"whois.iana.org",
			"io" =>"whois.nic.io",
			"iq" =>"vrx.net",
			"ir" =>"whois.nic.ir",
			"is" =>"whois.isnic.is",
			"it" =>"whois.nic.it",
			"je" =>"whois.channelisles.net",
			"jobs" =>"jobswhois.verisign-grs.com",
			"jp" =>"whois.jprs.jp",
			"ke" =>"whois.kenic.or.ke",
			"kg" =>"www.domain.kg",
			"ki" =>"whois.nic.ki",
			"kr" =>"whois.nic.or.kr",
			"kz" =>"whois.nic.kz",
			"la" =>"whois.nic.la",
			"li" =>"whois.nic.li",
			"lt" =>"whois.domreg.lt",
			"lu" =>"whois.dns.lu",
			"lv" =>"whois.nic.lv",
			"ly" =>"whois.nic.ly",
			"ma" =>"whois.iam.net.ma",
			"mc" =>"whois.ripe.net",
			"md" =>"whois.ripe.net",
			"me" =>"whois.meregistry.net",
			"mg" =>"whois.nic.mg",
			"mil" =>"whois.nic.mil",
			"mn" =>"whois.nic.mn",
			"mobi" =>"whois.dotmobiregistry.net",
			"ms" =>"whois.adamsnames.tc",
			"mt" =>"whois.ripe.net",
			"mu" =>"whois.nic.mu",
			"museum" =>"whois.museum",
			"mx" =>"whois.nic.mx",
			"my" =>"whois.mynic.net.my",
			"na" =>"whois.na-nic.com.na",
			"name" =>"whois.nic.name",
			"net" =>"whois.verisign-grs.net",
			"nf" =>"whois.nic.nf",
			"nl" =>"whois.domain-registry.nl",
			"no" =>"whois.norid.no",
			"nu" =>"whois.nic.nu",
			"nz" =>"whois.srs.net.nz",
			"org" =>"whois.pir.org",
			"pl" =>"whois.dns.pl",
			"pm" =>"whois.nic.pm",
			"pr" =>"whois.uprr.pr",
			"pro" =>"whois.registrypro.pro",
			"pt" =>"whois.dns.pt",
			"re" =>"whois.nic.re",
			"ro" =>"whois.rotld.ro",
			"ru" =>"whois.ripn.net",
			"sa" =>"whois.nic.net.sa",
			"sb" =>"whois.nic.net.sb",
			"sc" =>"whois2.afilias-grs.net",
			"se" =>"whois.iis.se",
			"sg" =>"whois.nic.net.sg",
			"sh" =>"whois.nic.sh",
			"si" =>"whois.arnes.si",
			"sk" =>"whois.ripe.net",
			"sm" =>"whois.ripe.net",
			"st" =>"whois.nic.st",
			"su" =>"whois.ripn.net",
			"tc" =>"whois.adamsnames.tc",
			"tel" =>"whois.nic.tel",
			"tf" =>"whois.nic.tf",
			"th" =>"whois.thnic.net",
			"tj" =>"whois.nic.tj",
			"tk" =>"whois.dot.tk",
			"tl" =>"whois.nic.tl",
			"tm" =>"whois.nic.tm",
			"tn" =>"whois.ripe.net",
			"to" =>"whois.tonic.to",
			"tp" =>"whois.nic.tl",
			"tr" =>"whois.nic.tr",
			"travel" =>"whois.nic.travel",
			"tv" => "tvwhois.verisign-grs.com",
			"tw" =>"whois.twnic.net.tw",
			"ua" =>"whois.net.ua",
			"ug" =>"whois.co.ug",
			"uk" =>"whois.nic.uk",
			"us" =>"whois.nic.us",
			"uy" =>"nic.uy",
			"uz" =>"whois.cctld.uz",
			"va" =>"whois.ripe.net",
			"vc" =>"whois2.afilias-grs.net",
			"ve" =>"whois.nic.ve",
			"vg" =>"whois.adamsnames.tc",
			"wf" =>"whois.nic.wf",
			"ws" =>"whois.website.ws",
			"yt" =>"whois.nic.yt",
			"yu" =>"whois.ripe.net"
	);
	
	/**
	 * @var array $g_tld				TLD's Sub-main Nodes Buffer
	 */
	var	$g_tld = array();
	
	/**
	 * @var array $c_tld				TLD's Country Nodes Buffer
	 */
	var	$c_tld = array();
	
	/**
	 *  __construct()
	 *  Constructor
	 */
	function __construct() {
		if (isset($_SESSION['whois'])) {
			$this->_ip_whois = $_SESSION['whois']['ip'];
			$this->_domain_whois = $_SESSION['whois']['domain'];
		}
		if (!is_array($_SESSION['whois']))
			$_SESSION['whois'] = array();
		if (isset($_SESSION['whois']['queries']['time'])) {
			if ($_SESSION['whois']['queries']['time']>time()) {
				$_SESSION['whois']['queries']['number'] = 0;
				$_SESSION['whois']['queries']['time'] = time()+3600;
			}
		} elseif (!isset($_SESSION['whois']['queries']['time'])) {
			$_SESSION['whois']['queries']['number'] = 0;
			$_SESSION['whois']['queries']['time'] = time()+3600;
		}
		
		if (!is_array($this->c_tld = APICache::read('networking-fallout-nodes')) || count($this->c_tld) == 0)
		{
		    $this->c_tld = array_keys(eval('?>'.getURIData(API_STRATA_API_URL."/v2/fallout/raw.api", 120, 120).'<?php'));
		    APICache::write('networking-fallout-nodes', $this->c_tld, 3600 * 24 * 7 * mt_rand(2, 9) * mt_rand(2, 9));
		}
		
		if (!is_array($this->g_tld = APICache::read('networking-strata-nodes')) || count($this->g_tld) == 0)
		{
		    $this->g_tld = array_keys(eval('?>'.getURIData(API_STRATA_API_URL."/v2/strata/raw.api", 120, 120).'<?php'));
		    APICache::write('networking-strata-nodes', $this->g_tld, 3600 * 24 * 7 * mt_rand(2, 9) * mt_rand(2, 9));
		}
		
		$services = $this->_domain_whoisservers;
		if (!is_array($this->_domain_whoisservers = APICache::read('networking-whois-servers')) || count($this->_domain_whoisservers) == 0)
		{
		    set_time_limit(3600 * 4.75);
		    foreach(APICache::read('networking-whois-servers-buffer') as $realm => $service)
		        $services[$realm] = $service;
		    
		    foreach($this->c_tld as $ctld)
		    {
		        if (!isset($services[$ctld]))
		            if ($service = $this->findWhoisService($ctld))
		                $services[$ctld] = $service;
		    }
		    foreach($this->g_tld as $gtld)
		    {
		        if (!isset($services[$gtld]))
		            if ($service = $this->findWhoisService($gtld))
		                $services[$gtld] = $service;
                foreach($this->c_tld as $ctld)
                {
                    if (!isset($services[$gtld.'.'.$ctld]))
                        if ($service = $this->findWhoisService($gtld.'.'.$ctld))
                            $services[$gtld.'.'.$ctld] = $service;
                }
		    }
		    APICache::write('networking-whois-servers', $this->_domain_whoisservers = $services, 3600 * 24 * 7 * mt_rand(2, 9) * mt_rand(2, 9));
		    APICache::write('networking-whois-servers-buffer', $this->_domain_whoisservers = $services, 3600 * 24 * 7 * mt_rand(2, 9) * mt_rand(2, 9) * mt_rand(2, 9));
		}
		die(print_r($this->_domain_whoisservers, true));
	}
	
	/**
	 *  __destruct()
	 *  Destructor
	 */	
	function __destruct() {
		$_SESSION['whois']['ip'] = $this->_ip_whois;
		$_SESSION['whois']['domain'] = $this->_domain_whois;
		if ($_SESSION['whois']['queries']['time']>time()) {
			$_SESSION['whois']['queries']['number'] = 0;
			$_SESSION['whois']['queries']['time'] = time()+3600;
		} elseif (!isset($_SESSION['whois']['queries']['time'])) {
			$_SESSION['whois']['queries']['number'] = 0;
			$_SESSION['whois']['queries']['time'] = time()+3600;
		}
		session_commit();
	}
	
	/**
	 * Locates Whois Service with resource
	 * 
	 * @param string $tld
	 * @return string|boolean
	 */
	private function findWhoisService($tld = '')
	{
	    $uris = array('whois.nic.'.$tld, 'whois.'.$tld.'nic.'.$tld, 'whois.'.$tld.'nic.net.'.$tld);
	    foreach($uris as $uri)
	    {
	        if ($this->validateIPv4(gethostbyname($uri)))
	            return $uri;
	    }
	    return false;
	}
	
	/**
	 * lookupIP()
	 * Looks Up IPv4 or IPv6 Address by Queries Whois Services via sockets
	 *
	 * @param string $ip
	 * @param string $output
	 * @return string
	 */	
	private function lookupIP($ip,$output='html') {
		if (!is_array($this->_ip_whois))
			$this->_ip_whois = array();
		if (!isset($this->_ip_whois[$ip])) {
			foreach($this->_ip_whoisservers as $whoisserver) {
				if (!isset($this->_ip_whois[$ip])||!is_array($this->_ip_whois[$ip]))
					$this->_ip_whois[$ip] = array();
				$result = $this->queryWhoisServer($whoisserver, $ip);
				if (!isset($this->_ip_whois[$ip][$whoisserver])&&$result) {
					$this->_ip_whois[$ip][$whoisserver]= $result;
				} elseif($result && !in_array($result, $this->_ip_whois[$ip])) {
					$this->_ip_whois[$ip][$whoisserver]= $result;
				}
			}
		}

		/**
		 * Records whois history file when required and has changed!
		 */
		if (parent::validateIPv4($ip))
		{
			$channel = 'ipv4';
		} elseif(parent::validateIPv6($ip)) {
			$channel = 'ipv6';
		}
		
		$whois = $emails = array();
		$return = '%s';
		foreach($this->_ip_whois[$ip] as $whoisserver=>$result) {
		    
		    $whois[$whoisserver][$ip] = parent::parseToArray($result, $ip, __FUNCTION__, __CLASS__, $output);;
		    $emails[$whoisserver][$ip] = (parent::cleanEmails(parent::extractEmails($result, $ret)));
		}
		$md5 = md5(json_encode(($whois)));
		$emailmd5 = md5(json_encode(($whois)));
		$sql = "SELECT count(*) FROM `" . $GLOBALS['APIDB']->prefix('history') . "` WHERE `md5` LIKE '$md5' AND `email-md5` LIKE '$emailmd5'";
		list($count) = $GLOBALS['APIDB']->fetchRow($GLOBALS['APIDB']->queryF($sql));
		if ($count==0)
		{
		    $sql = "INSERT INTO `" . $GLOBALS['APIDB']->prefix('history') . "` (`stored`, `value`, `typal`, `md5`, `email-md5`, `email`, `history`) VALUES(UNIX_TIMESTAMP(), md5('$ip'), '$channel', '$md5', '$emailmd5', '" . sprintf($return, mysqli_real_escape_string($GLOBALS['APIDB']->conn, json_encode(is_array($emails)?$emails:array(), true))) . "', '" . sprintf($return, mysqli_real_escape_string($GLOBALS['APIDB']->conn, json_encode(is_array($whois)?$whois:array(), true))) . "')";
		    if (!$GLOBALS['APIDB']->queryF($sql))
		        die("SQL Failed: $sql;");
		}
		
		
		switch($output) {
			default:
			case 'html':
			    $ret = "RESULTS FOUNd: " . count($this->_ip_whois[$ip]);
			    foreach($this->_ip_whois[$ip] as $whoisserver=>$result) {
			        $ret .= "\n\n-------------\nLookup results for $ip from $whoisserver server:\n\n$result";
			    }
			    $ret = array('html' => $ret);
			    break;
			case 'raw':
			case 'json':
			case 'xml':
			case 'serial':
				$ret = array();
				foreach($this->_ip_whois[$ip] as $whoisserver=>$result) {
				    $ret[$ip][$whoisserver]['whois'] = parent::parseToArray($result, $ip, __FUNCTION__, __CLASS__, $output);
				    $ret[$ip][$whoisserver]['emails'] = parent::cleanEmails(parent::extractEmails($result, $ret));
				    $ret[$ip][$whoisserver]['urls'] = parent::extractURLS($result, $ret);
				}
				break;
		}
		return $ret;
	}
	
	/**
	 * lookupDomain()
	 * Looks Up Domain by Queries Whois Services via sockets
	 *
	 * @param string $domain
	 * @param string $output
	 * @return string
	 */
	 private function lookupDomain($domain,$output='html') {
		if (!is_array($this->_domain_whois))
			$this->_domain_whois = array();
		if (parent::validateDomain($domain)==true) {
			if (!is_array($this->_domain_whois[$domain]))
				$this->_domain_whois[$domain] = array();
			$domain_parts = explode(".", $domain);
			$tld = strtolower(array_pop($domain_parts));
			$whoisserver = $this->_domain_whoisservers[$tld];
			if (!isset($this->_domain_whois[$domain][$whoisserver])) {
				if(!$whoisserver) {
					$this->_domain_whois[$domain][$whoisserver] = "Error: No appropriate Whois server found for $domain domain!";
				}
				$result = $this->queryWhoisServer($whoisserver, $domain);
				if(!$result) {
					$this->_domain_whois[$domain][$whoisserver] = "Error: No results retrieved from $whoisserver server for $domain domain!";
				} else {
					while(strpos($result, "Whois Server:") !== FALSE){
						preg_match("/Whois Server: (.*)/", $result, $matches);
						$secondary = $matches[1];
						if($secondary) {
							$result = $this->queryWhoisServer($secondary, $domain);
							$whoisserver = $secondary;
						}
					}
				}
				if (isset($this->_domain_whois)) {
					if (!in_array($result, $this->_domain_whois)) {
						$this->_domain_whois[$domain][$whoisserver] = $result;
					} else {
						$this->_domain_whois[$domain][$whoisserver] = "Error: IP Address Provided for Network Netbios Address!";
					}
				} elseif (strlen($result)>0) {
					$this->_domain_whois = array(); 
					$this->_domain_whois[$domain][$whoisserver] = $result;
				} else {
					$this->_domain_whois[$domain][$whoisserver] = "Error: IP Address Provided for Network Netbios Address!";
				}
			}
			
			$return = '%s';
			$md5 = md5(json_encode($whois = (parent::parseToArray($this->_domain_whois[$domain][$whoisserver], $domain, __FUNCTION__, __CLASS__, $output))));
			$emailmd5 = md5(json_encode($emails = (parent::cleanEmails(parent::extractEmails($this->_domain_whois[$domain][$whoisserver], $ret)))));	
			$sql = "SELECT count(*) FROM `" . $GLOBALS['APIDB']->prefix('history') . "` WHERE `md5` LIKE '$md5' AND `email-md5` LIKE '$emailmd5'";
			list($count) = $GLOBALS['APIDB']->fetchRow($GLOBALS['APIDB']->queryF($sql));
			if ($count==0)
			{
			    $sql = "INSERT INTO `" . $GLOBALS['APIDB']->prefix('history') . "` (`stored`, `value`, `typal`, `md5`, `email-md5`, `email`, `history`) VALUES(UNIX_TIMESTAMP(), md5('$domain'), 'realm', '$md5', '$emailmd5', '" . sprintf($return, mysqli_real_escape_string($GLOBALS['APIDB']->conn, json_encode(is_array($emails)?$emails:array(), true))) . "', '" . sprintf($return, mysqli_real_escape_string($GLOBALS['APIDB']->conn, json_encode(is_array($whois)?$whois:array(), true))) . "')";
			    if (!$GLOBALS['APIDB']->queryF($sql))
			        die("SQL Failed: $sql;");
			}
			
			switch($output) {
				default:
				case 'html':
				    $ret = array('html'=>"$domain domain lookup results from $whoisserver server:\n\n" .  $this->_domain_whois[$domain][$whoisserver]);
					break;
				case 'raw':
				case 'json':
				case 'xml':
				case 'serial':
				    $ret = array();
				    $ret[$domain][$whoisserver]['whois'] = parent::parseToArray($this->_domain_whois[$domain][$whoisserver], $domain, __FUNCTION__, __CLASS__, $output);
				    $ret[$domain][$whoisserver]['emails'] = parent::cleanEmails(parent::extractEmails($this->_domain_whois[$domain][$whoisserver], $ret));
				    $ret[$domain][$whoisserver]['urls'] = parent::extractURLS($this->_domain_whois[$domain][$whoisserver], $ret);
					break;
			}
			
		} else {
		switch($output) {
				default:
				case 'html':
				    return array('html'=>"Error: $domain could not be validated!");
				    break;
				case 'raw':
				case 'json':
				case 'xml':
				case 'serial':
					return array("error"=> "$domain could not be validated!");
					break;
			}
		}
		return $ret;
	}
	
	/**
	 * queryWhoisServer()
	 * Queries Whois Services via sockets
	 *
	 * @param string $whoisserver
	 * @param string $domain
	 * @return string
	 */
	 private function queryWhoisServer($whoisserver, $domain) {
		$port = 43;
		$timeout = 10;
		if ($fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout)) {
			if($whoisserver == "whois.verisign-grs.com") $domain = "=".$domain; // whois.verisign-grs.com requires the equals sign ("=") or it returns any result containing the searched string.
			fputs($fp, $domain . "\r\n");
			$out = "";
			while(!feof($fp)){
				$out .= fgets($fp);
			}
			fclose($fp);
		
			$res = "";
			if((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
				$rows = explode("\n", $out);
				foreach($rows as $row) {
					$row = trim($row);
					if(($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
						$res .= $row."\n";
					}
				}
			}
			return $res;
		}
		return $error = "Socket Error " . $errno . " - " . $errstr;
	}
	
	/**
	 * query()
	 * Queries Whois Services
	 *
	 * @param string $data
	 * @param string $output
	 * @return mixed
	 */	
	function query($data, $output = 'html') {
		if ($_SESSION['whois']['queries']['number']>MAXIMUM_QUERIES) {
			header("HTTP/1.0 404 Not Found");
			exit;
		}
		$_SESSION['whois']['queries']['number']++;
		if (parent::validateDomain(parent::getBaseDomain((substr($data,0,4)!='http'?'http://':'').$data))) {
			return $this->lookupDomain(parent::getBaseDomain((substr($data,0,4)!='http'?'http://':'').$data), $output);
		} elseif (parent::validateIPv4($data)||parent::validateIPv6($data)) {
			return $this->lookupIP($data, $output);
		} else {
			return 'Error: Could not validate data as either a domain name or IPv4 or IPv6 address!';
		}
	}
}
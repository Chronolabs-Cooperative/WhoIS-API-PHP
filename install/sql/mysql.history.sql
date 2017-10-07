
# Table structure for table `history`
#

CREATE TABLE `history` (
  `hid` mediumint(64) unsigned NOT NULL auto_increment,
  `uid` mediumint(8) unsigned NOT NULL default 0,
  `typal` enum('ipv4','ipv6','realm','unknown') NOT NULL default 'unknown',
  `value` varchar(32) NOT NULL default '',
  `md5` varchar(32) NOT NULL default '',
  `email` mediumtext,
  `email-md5` varchar(32) NOT NULL default '',
  `history` longtext,
  `stored` int(13) NOT NULL default 0,
  PRIMARY KEY  (`hid`),
  KEY typalstored (`typal`,`stored`),
  KEY md5emailmd5stored (`md5`,`email-md5`,`stored`)
) ENGINE=INNODB;

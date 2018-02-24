## Chronolabs Cooperative presents

# Internet WhoIS REST API Services

## Version: 2.2.14 (final major)

### Author: Dr. Simon Antony Roberts <simon@snails.email>

#### Demo: http://whois.snails.email

This is an API Service for conducting a whois on both IPv4, IPv6 and domain names. It provides a range of document standards for you to access the API inclusing JSON, XML, Serialisation, HTML and RAW outputs.

You can access the API currently without a key or system it is an open api and was written in response to the many API Services that charge ridiculous amounts for querying such a simple base. The following instructions are how to access the api I hope you enjoy this api as I have writting it with the help of net registry. 

# Apache Mod Rewrite (SEO Friendly URLS)

The follow lines go in your API_ROOT_PATH/.htaccess

    php_value memory_limit 16M
    php_value upload_max_filesize 1M
    php_value post_max_size 1M
    php_value error_reporting 0
    php_value display_errors 0
    
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    
    RewriteRule ^v([0-9]{1,2})/(.*?)/(json|xml|serial|raw|html).api$ ./index.php?version=$1&whois=$2&output=$3 [L,NC,QSA]

## Scheduled Cron Job Details.,
    
There is one or more cron jobs that is scheduled task that need to be added to your system kernel when installing this API, the following command is before you install the chronological jobs with crontab in debain/ubuntu
    
    Execute:-
    $ sudo crontab -e

### CronTab Entry:
    
    * */12 */20 * * /usr/bin/php -q /path/to/crons/find-whois-services.php

## Licensing

 * This is released under General Public License 3 - GPL3 - Only!

# Installation

Copy the contents of this archive/repository to the run time environment, configue apache2, ngix or iis to resolve the path of this repository and run the HTML Installer.

# Implementing in PHP

This is the example on how to implement this API in PHP

## Raw Output Implementation

The following code implements the _raw.api_ call for strata importing the implemented array:

    $gtld = eval("?>".file_get_contents("http://whois.localhost/v2/snails.email/raw.api")."<?php");

The following code implements the _raw.api_ call for fallout importing the implemented array:

    $ipv4 = eval("?>".file_get_contents("http://whois.localhost/v2/125.23.45.111/raw.api")."<?php");

The following code implements the _raw.api_ call for fallout importing the implemented array:

    $ipv6 = eval("?>".file_get_contents("http://whois.localhost/v2/2001:0:9d38:953c:1052:39d8:8355:2880/raw.api")."<?php");

## JSON Output Implementation

The following code implements the _json.api_ call for strata importing the implemented array:

    $gtld = json_decode(file_get_contents("http://whois.localhost/v2/snails.email/json.api"), true);

The following code implements the _json.api_ call for fallout importing the implemented array:

    $ipv4 = json_decode(file_get_contents("http://whois.localhost/v2/125.23.45.111/json.api"), true);

The following code implements the _json.api_ call for fallout importing the implemented array:

    $ipv6 = json_decode(file_get_contents("http://whois.localhost/v2/2001:0:9d38:953c:1052:39d8:8355:2880/json.api"), true);

## SERIAL Output Implementation

The following code implements the _serial.api_ call for strata importing the implemented array:

    $gtld = unserialize(file_get_contents("http://whois.localhost/v2/snails.email/serial.api"));

The following code implements the _serial.api_ call for fallout importing the implemented array:

    $ipv4 = unserialize(file_get_contents("http://whois.localhost/v2/125.23.45.111/serial.api"));

The following code implements the _serial.api_ call for fallout importing the implemented array:

    $ipv6 = unserialize(file_get_contents("http://whois.localhost/v2/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api"));

## XML Output Implementation

The following code implements the _xml.api_ call for strata importing the implemented array:

    $gtld = new SimpleXMLElement(file_get_contents("http://whois.localhost/v2/snails.email/xml.api"));

The following code implements the _xml.api_ call for fallout importing the implemented array:

    $ipv4 = new SimpleXMLElement(file_get_contents("http://whois.localhost/v2/125.23.45.111/xml.api"));

The following code implements the _xml.api_ call for fallout importing the implemented array:

    $ipv6 = new SimpleXMLElement(file_get_contents("http://whois.localhost/v2/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api"));

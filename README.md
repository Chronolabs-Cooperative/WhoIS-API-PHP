## Chronolabs Cooperative presents

# Internet WhoIS REST API Services

## Version: 2.2.11

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

# Installation

Copy the contents of this archive/repository to the run time environment, configue apache2, ngix or iis to resolve the path of this repository and run the HTML Installer.

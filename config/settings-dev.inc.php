<?php

define('BASE_URI', 		'/');
define('SITE_DOMAIN', 	'http://netlead.creditconseil');
define('THEME_NAME', 	'credit_conseil');
define('BLOG_URL', 		'http://netlead.creditconseilblog');

define('DEV_ENVIRONMENT', 0);

define('DB_NAME', 		'nl_dev_assurances');
define('DB_HOST', 		'localhost');
define('DB_USER', 		'root');
define('DB_PASSWORD', 	'root');
define('DB_TYPE', 		'mysql');

// enabled or disabled
// define('SMTP_MODE', 	'enabled');
// define('SMTP_SECURE', 	'tls'); // tls ou ssl
// define('SMTP_HOST',		'mail.creditsconseils.ch');
// define('SMTP_PORT', 	465);
// define('SMTP_USERNAME', 'demande@creditsconseils.ch');
// define('SMTP_PASSWORD', 'barcelone');
// define('SEND_TO', 		'demande@creditsconseils.ch');
// define('REPLY_TO', 		'infos@creditsconseils.ch');

// define('SMTP_MODE', 	'enabled');
// define('SMTP_SECURE', 	'tls'); // tls ou ssl
// define('SMTP_HOST',		'smtp.gmail.com');
// define('SMTP_PORT', 	465);
// define('SMTP_USERNAME', 'sam.baptista@gmail.com');
// define('SMTP_PASSWORD', '567777');
// define('SEND_TO', 		'sam.baptista@gmail.com');
// define('REPLY_TO', 		'sam.baptista@gmail.com');

define('SMTP_MODE', 	'enabled');
define('SMTP_SECURE', 	'ssl'); // tls ou ssl
define('SMTP_HOST',		'mail.infomaniak.ch');
define('SMTP_PORT', 	587);
define('SMTP_USERNAME', 'info@credit-conseil.ch');
define('SMTP_PASSWORD', 'cc2011');
define('SEND_TO', 		'info@credit-conseil.ch');
define('REPLY_TO', 		'info@credit-conseil.ch');


global $config_mail;
$config_mail = array(
				'auth' => 'login',
                'username' => SMTP_USERNAME,
                'password' => SMTP_PASSWORD,
				//'ssl' => SMTP_SECURE,
				//'port' => SMTP_PORT
			);

?>
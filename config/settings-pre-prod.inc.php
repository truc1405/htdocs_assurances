<?php

define('BASE_URI', 		'/');
define('SITE_DOMAIN', 	'http://creditconseil.netlead.ch');
define('THEME_NAME', 	'credit_conseil');
define('BLOG_URL', 		'http://creditconseilblog.netlead.ch');

define('DEV_ENVIRONMENT', 1);

define('DB_NAME', 		'netleadch12');
define('DB_HOST', 		'mysql.netlead.ch');
define('DB_USER', 		'netlead');
define('DB_PASSWORD', 	'strange');
define('DB_TYPE', 		'mysql');

//enabled or disabled
// define('SMTP_MODE', 	'enabled');
// define('SMTP_SECURE', 	'ssl'); // tls ou ssl
// define('SMTP_HOST',		'mail.netlead.ch');
// define('SMTP_PORT', 	587);
// define('SMTP_USERNAME', 'info@net-lead.ch');
// define('SMTP_PASSWORD', 'strange');
// define('SEND_TO', 		'info@net-lead.ch');
// define('REPLY_TO', 		'info@net-lead.ch');

define('SMTP_MODE', 	'enabled');
define('SMTP_SECURE', 	'ssl'); // tls ou ssl
define('SMTP_HOST',		'mail.infomaniak.ch');
define('SMTP_PORT', 	587);
define('SMTP_USERNAME', 'info@credit-conseil.ch');
define('SMTP_PASSWORD', 'cc2011');
define('SEND_TO', 		'info@credit-conseil.ch');
define('REPLY_TO', 		'info@credit-conseil.ch');

// define('SMTP_MODE', 	'enabled');
// define('SMTP_SECURE', 	'tls'); // tls ou ssl
// define('SMTP_HOST',		'mail.creditsconseils.ch');
// define('SMTP_PORT', 	465);
// define('SMTP_USERNAME', 'demande@creditsconseils.ch');
// define('SMTP_PASSWORD', 'barcelone');
// define('SEND_TO', 		'demande@creditsconseils.ch');
// define('REPLY_TO', 		'infos@creditsconseils.ch');


global $config_mail;
$config_mail = array(
				'auth' => 'login',
                'username' => SMTP_USERNAME,
                'password' => SMTP_PASSWORD,
				//'ssl' => SMTP_SECURE,
				//'port' => SMTP_PORT
			);
?>


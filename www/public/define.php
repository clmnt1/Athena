<?php

/** APPLI **/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . DS . 'application');
define('VIEW_PATH', APP_PATH . DS . 'view');
define('LIB_PATH', ROOT_PATH . DS . 'library');
define('MOD_PATH', APP_PATH . DS . 'model');
define('PUB_PATH', __DIR__);

/** Bibliothèque **/
define('DIR_VENDOR' ,'include/initializr/js/vendor');
define('BOOTSTRAP'	,DIR_VENDOR.'/bootstrap.min.js');
define('JQUERY'		,DIR_VENDOR.'/jquery-1.9.1.min.js');
define('MODERNIZR'	,DIR_VENDOR.'/modernizr-2.6.2-respond-1.1.0.min.js');

/** CSS **/
define('DIR_CSS'						,'include/initializr/css');
define('MAIN_CSS'						,DIR_CSS.'/main.css');
define('BOOTSTRAP_CSS'					,DIR_CSS.'/bootstrap.min.css');
define('BOOTSTRAP_RESPONSIVE_CSS'		,DIR_CSS.'/bootstrap-responsive.min.css');

/** Class **/


/** Table **/

define('CONVERSATION'	,'conversation');
define('MESSAGE'	    ,'message');
define('USER'        	,'users');
define('USER_MESSAGE'	,'users_conversation');

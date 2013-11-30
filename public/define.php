<?php

/** Architecture application **/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH. DS .'application');
define('VIEW_PATH', APP_PATH. DS .'view');
define('MOD_PATH', APP_PATH. DS .'model');
define('LIB_PATH', ROOT_PATH. DS .'library');
define('PUB_PATH', __DIR__);

/** JS **/
define('DIR_JS'	,'js');
define('TCHAT'  , DIR_JS. DS .'tchat.js');
		
/** CSS **/
define('DIR_CSS'                        ,'css');
define('MAIN_CSS'                       ,DIR_CSS .'/main.css');
define('BOOTSTRAP_CSS'                  ,DIR_CSS .'/bootstrap.css');
define('BOOTSTRAP_RESPONSIVE_CSS'       ,DIR_CSS .'/bootstrap-responsive.css');
define('BOOTSTRAP_THEME_CSS'      		,DIR_CSS .'/bootstrap-theme.css');
define('ATHENA_CSS'      				,DIR_CSS .'/athena.css');
define('CSS_PLUGINS'					,DIR_CSS. DS .'plugins');
define('GLYPHICONS_CSS'					,DIR_CSS. DS .'plugins');

/** Bibliothèque **/
define('DIR_VENDOR' , DIR_JS. DS .'vendor');
define('BOOTSTRAP'  ,DIR_VENDOR. DS .'bootstrap.min.js');
define('JQUERY'     ,DIR_VENDOR. DS .'jquery-1.9.1.min.js');
define('MODERNIZR'  ,DIR_VENDOR. DS .'modernizr-2.6.2-respond-1.1.0.min.js');

define('JS_PLUGINS'  , DIR_JS. DS .'plugins');

/** Class **/
  
  
/** Table **/
  
define('CONVERSATION'   ,'conversation');
define('MESSAGE'        ,'message');
define('USER'           ,'users');
define('USER_MESSAGE'   ,'users_conversation'); 
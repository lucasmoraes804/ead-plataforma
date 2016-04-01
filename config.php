<?php

include_once 'core.php';
include_once 'controller/Controller.php';
//include_once 'controller/Model.php';

//Essential constants
define( "URL_SITE",  get_home_url()             );
define( "PATH_SITE", dirname(__FILE__) . '/'    );

//constants db
define( "DB_HOST",      'localhost'         );
define( "DB_BASE",      'ead_plataforma'    );
define( "DB_USER",      'root'              );
define( "DB_PASSWORD",  ''                  );

//Default timezone
date_default_timezone_set( 'America/Sao_Paulo' );

$module = get_module();
if ( !$module )
    $module = 'Controller';
$controller = new $module();
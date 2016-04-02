<?php

include_once 'core.php';
include_once 'controller/controller.php';
include_once 'model/connect.php';
include_once 'model/model.php';

//Essential constants
define( 'URL_SITE',  get_home_url()             );
define( 'PATH_SITE', dirname(__FILE__) . '/'    );

//constants db
define( 'DB_HOST',      'localhost'         );
define( 'DB_NAME',      'ead_plataforma'    );
define( 'DB_USER',      'root'              );
define( 'DB_PASSWORD',  ''                  );
define( 'DB_PREFIX',    'ead_' );

//Default timezone
date_default_timezone_set( 'America/Sao_Paulo' );

session_start();

if ( !get_module() )
    $controller = new Controller();
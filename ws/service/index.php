<?php
define( 'PATH_MODULE', dirname(__FILE__) . '/'    );
include_once '../../config.php';
include_once PATH_SITE . 'service/model/model-service.php';
include_once PATH_SITE . 'ws/ws-server.php';
include_once PATH_MODULE . 'ws-service.php';
$controller = new WS_Service();
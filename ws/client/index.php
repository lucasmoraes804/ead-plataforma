<?php
define( 'PATH_MODULE', dirname(__FILE__) . '/'    );
include_once '../../config.php';
include_once PATH_SITE . 'client/model/model-client.php';
include_once PATH_SITE . 'ws/ws-server.php';
include_once PATH_MODULE . 'ws-client.php';
$controller = new WS_Client();
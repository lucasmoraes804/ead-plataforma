<?php
define( 'PATH_MODULE', dirname(__FILE__) . '/'    );
include_once '../../config.php';
include_once PATH_SITE . 'demand/model/model-demand.php';
include_once PATH_SITE . 'ws/ws-server.php';
include_once PATH_MODULE . 'ws-demand.php';
$controller = new WS_Demand();
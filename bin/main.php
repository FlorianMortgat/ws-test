<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use BZ\BzhuClass;

require_once dirname(__DIR__) . '/vendor/autoload.php';


$server = IoServer::factory(
	new HttpServer(
		new WsServer(
			new BzhuClass()
		)
	),
	8080
);

$server->run();


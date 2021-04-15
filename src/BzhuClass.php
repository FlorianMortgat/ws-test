<?php
namespace BZ;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class BzhuClass implements MessageComponentInterface {
	protected $clients;

	public function __construct() {
		$this->clients = new \SplObjectStorage;
	}

	public function onOpen(ConnectionInterface $conn) {
		$this->clients->attach($conn);
		echo 'New connection: ', $conn->resourceId, "\n";
	}

	public function onMessage(ConnectionInterface $from, $msg) {
		echo "New message: $msg\n\n";
		foreach ($this->clients as $client) {
			if ($from !== $client) {
			// $client->send($msg);
			}
		}
	}

	public function onClose(ConnectionInterface $conn) {
		$this->clients->detach($conn);
		echo "Client disconnect:", $conn->resourceId, "\n";
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
		echo $e->getMessage(), "\n";
		$conn->close();
	}
}


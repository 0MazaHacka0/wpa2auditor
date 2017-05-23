<?php

include( 'db.php' );

class Task {

	private $server_path;
	private $site_path;
	private $task_name;
	private $user_id;

	//Handshake
	private $essid;
	private $station_mac;
	private $type;
	private $task_hash;

	//NTLM
	private $username;
	private $challenge;
	private $response;

	private $uniq_hash;
	private $uniq;

	private $status;
	private $net_key;
	private $id;

	function __construct() {

	}

	static function create_task_from_db( $task_id ) {

		//vars
		global $mysqli;
		$instance = new self();

		//Get all info from DB
		$sql = "SELECT * FROM tasks WHERE id='" . $task_id . "'";
		$result = $mysqli->query( $sql )->fetch_object();

		$instance->server_path = $result->server_path;
		$instance->site_path = $result->site_path;
		$instance->task_name = $result->task_name;
		$instance->user_id = $result->user_id;
		$instance->essid = $result->essid;
		$instance->station_mac = $result->station_mac;
		$instance->type = $result->type;
		$instance->task_hash = $result->task_hash;
		$instance->uniq_hash = $result->uniq_hash;
		$instance->status = $result->status;
		$instance->net_key = $result->net_key;
		$instance->id = $result->id;

		return $instance;

	}

	static function create_task_from_file( $Handshake, $task_name, $user_id ) {

		//vars
		global $mysqli;
		$instance = new self();

		$instance->task_name = $task_name;
		$instance->user_id = $user_id;
		$instance->get_information_from_handshake( $Handshake );

		if ( !( $instance->check_uniq( $mysqli, $instance->uniq_hash ) ) )
			throw new Exception( "Hash is not uniq.", 14 );

		$instance->add_task_to_db( $mysqli );

		return $instance;

	}

	function get_all_info() {

		$info[ 'server_path' ] = $this->server_path;
		$info[ 'site_path' ] = $this->site_path;
		$info[ 'task_name' ] = $this->task_name;
		$info[ 'user_id' ] = $this->user_id;
		$info[ 'essid' ] = $this->essid;
		$info[ 'station_mac' ] = $this->station_mac;
		$info[ 'type' ] = $this->type;
		$info[ 'status' ] = $this->status;
		$info[ 'net_key' ] = $this->net_key;
		$info[ 'id' ] = $this->id;

		return $info;
	}

	function check_uniq( $mysqli, $hash ) {
		$sql = "SELECT * FROM tasks WHERE uniq_hash=UNHEX('" . $hash . "')";
		$result = $mysqli->query( $sql )->num_rows;
		if ( $result != 0 )
			return false;
		return true;
	}

	function get_network_key( $mysqli, $id ) {
		$sql = "SELECT net_key FROM tasks WHERE id='" . $id . "'";
		$net_key = $mysqli->query( $sql )->fetch_object()->net_key;
		if ( $net_key == 0 )
			return false;
		else return $net_key;
	}

	function deleteTask() {

		global $mysqli;

		unlink( $this->server_path );

		//Delete task from tasks
		$sql = "DELETE FROM tasks WHERE id='" . $id . "'";
		$mysqli->query( $sql );
	}

	function get_information_from_handshake( $handshake ) {

		$type = $handshake[ 'type' ];

		$this->type = $type;
		$this->task_hash = $handshake[ 'task_hash' ];
		$this->uniq_hash = $handshake[ 'uniq_hash' ];
		$this->server_path = $handshake[ 'server_path' ];
		$this->site_path = $handshake[ 'site_path' ];

		switch ( $type ) {
			case 0:
				$this->essid = $handshake[ 'structure' ][ 'essid' ];
				$this->station_mac = bin2hex( $handshake[ 'structure' ][ 'mac_ap' ] );
				break;
			case 1:
				$this->username = $handshake[ 'username' ];
				$this->challenge = $handshake[ 'challenge' ];
				$this->response = $handshake[ 'response' ];
				break;
		}
	}

	function add_task_to_db( $mysqli ) {

		switch ( $this->type ) {
			case 0:
				$sql = "INSERT INTO tasks(task_name, user_id, server_path, site_path, essid, station_mac, type, task_hash, uniq_hash) VALUES('" . $this->user_id . "', '" . $this->task_name . "', '" . $this->server_path . "', '" . $this->site_path . "', '" . $this->essid . "', '" . $this->station_mac . "', '" . $this->type . "', UNHEX('" . $this->task_hash . "'), UNHEX('" . $this->uniq_hash . "'))";
				break;
			case 1:
				$sql = "INSERT INTO tasks(task_name, user_id, server_path, site_path, type, task_hash, uniq_hash, username, challenge, response) VALUES('" . $this->user_id . "', '" . $this->task_name . "', '" . $this->server_path . "', '" . $this->site_path . "', '1', UNHEX('" . $this->task_hash . "'), UNHEX('" . $this->uniq_hash . "'), '" . $this->username . "', '" . $this->challenge . "', '" . $this->response . "')";
				break;
		}

		//Add task to DB
		$mysqli->query( $sql );
	}
}




?>
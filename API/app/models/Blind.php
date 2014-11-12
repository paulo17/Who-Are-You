<?php

require_once 'Model.php';

class Blind extends Model{

	public $table = 'blinds';

	function __construct() {
		parent::__construct();
	}

	public function create($blind){
		$insert = $this->db->prepare('INSERT INTO ' . $this->table . '(status, type, user_id, friend_id, created)
			VALUES(:status, :type, :user_id, :friend_id, :created)');
		$blind = $insert->execute(array(
			'status' => 'CREATED',
			'type' => $blind['type'],
			'user_id' => $blind['user_id'],
			'friend_id' => (!empty($blind['friend_id'])) ? $blind['friend_id'] : null,
			'created' => $this->datetime()
			));
		return (!empty($blind)) ? $this->db->lastInsertId() : false;
	}

	public function updateStatus($blind_id, $status){
		$update = $this->db->prepare('UPDATE ' . $this->table . ' SET status = :status WHERE id = :blind_id');
		$blind = $update->execute(array(
			'status' => strtoupper($status),
			'blind_id' => $blind_id
			));
		return ($blind) ? true : false;

	}

	public function validate($blind){
		$validate = true;

		if(empty($blind['type'])){ return false; }
		if(empty($blind['user_id'])){ return false; }
		// if(isset($blind['friend_id'])){ return false; }

		return $validate;
	}

}

 ?>
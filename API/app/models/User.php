<?php
require_once 'Model.php';

class User extends Model{

	public $table = 'users';

	function __construct() {
		parent::__construct();
	}

	public function get($id = null){
		if(empty($id)){
			$user = $this->db->exec('SELECT * FROM users');
		}else{
			$user = $this->db->exec('SELECT * FROM users WHERE id = :id', array('id' => $id));
		}
		return $this->encode('users', $user);
	}

	public function exist($id){
		$user = $this->db->exec('SELECT facebook_id, firstname, lastname, picture, sex FROM ' . $this->table . ' WHERE facebook_id = :id',
			array('id' => $id));
		return (count($user) == 1) ? $user[0] : false;
	}

	public function register($f3){
		$this->db->exec('INSERT INTO users(facebook_id, firstname, lastname, created)
			VALUES (:fb_id, :fname, :lname, :created',
				array(
					'fb_id' => $f3->get('POST.facebook_id'),
					'fname' => $f3->get('POST.firstname'),
					'lname' => $f3->get('POST.lastname'),
					'created' => $this->datetime()
					)
				);
		echo $this->db->log();
	}

}

 ?>
<?php
 class User extends Model
 {		
	public function select_all()
	{
		$query = "SELECT *
							 FROM `users`, `userroles`
							 WHERE `users`.`userrole` = `userroles`.`userrole_id`";
		return $this->query($query);
	}

	public function select_all_optredens()
	{
		$query = "SELECT * FROM `optreden`";
		return $this->query($query);
	}

	public function select_optreden_by_id($id)
	{
		$query = "SELECT * FROM `optreden`
						   WHERE `optreden_id` = '".$id."'";
		return $this->query($query);
	}

	public function insert_into_bestelling($post)
	{
		$query = "INSERT INTO `bestelling` ( `bestelling_id`,
									     `user`,
									     `optreden`,
									     `aantal`)
							VALUES      ( NULL,
										  '".$_SESSION['user_id']."',
										  '".$post['optreden_id']."',
										  '".$post['amount']."')";
		// echo $query; exit();
		$this->query($query);

	}
 }
?>
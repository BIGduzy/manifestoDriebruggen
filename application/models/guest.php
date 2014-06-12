<?php
 class Guest extends Model
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

	public function select_user_from_login($post)
	{
		$query = "SELECT *
				  FROM   `userroles`, `users`
				  WHERE  `userroles`.`userrole_id` = `users`.`user_id`
				  AND    `users`.`email` = '".$post['email']."'
				  AND	 `users`.`wachtwoord` = '".$post['password']."'";
		return $this->query($query);

	}
 }
?>
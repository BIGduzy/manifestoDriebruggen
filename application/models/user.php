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
 }
?>
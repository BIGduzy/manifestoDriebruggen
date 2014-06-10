<?php
 class User extends Model
 {		
	public function select_all()
	{
		return $this->query("SELECT *
							 FROM `users`, `userroles`
							 WHERE `users`.`userrole` = `userroles`.`userrole_id`");
	}
 }
?>
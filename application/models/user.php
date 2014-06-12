<?php
 class User extends Model
 {		
	public function select_all_users()
	{
		$query = "SELECT *
							 FROM `users`, `userroles`
							 WHERE `users`.`userrole` = `userroles`.`userrole_id`";
		return $this->query($query);
	}

	public function select_user_by_id($id)
	{
		$query = "SELECT * FROM `users`, `userroles`
							 WHERE `users`.`userrole` = `userroles`.`userrole_id`
							 and `users`.`user_id` = '".$id."'";
		// echo $query; exit();
		return $this->query($query);
	}

	public function set_korting($id,$boolean){
		if($boolean == 0){
			date_default_timezone_set("Europe/Amsterdam");
			$date = Date("Y-m-d H:i:s");
			$query = "UPDATE `users` SET `heeft_korting` = '".$boolean."',
									 `korting_sinds` = '".$date."' 
								WHERE `user_id` = '".$_SESSION['user_id']."'";
		}
		else{
			$query = "UPDATE `users` SET `heeft_korting` = '".$boolean."'
								WHERE `user_id` = '".$_SESSION['user_id']."'";
		}

		// echo $query; exit();
		$this->query($query);
	}

	public function set_totaal($id,$value){
		$query = "UPDATE `users` SET `totaal_deze_periode` = '".$value."' 
								WHERE `user_id` = '".$_SESSION['user_id']."'";
		// echo $query; exit();
		$this->query($query);
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

	public function add_bestelling($post,$prijs,$old_prijs)
	{
		date_default_timezone_set("Europe/Amsterdam");
		$date = Date("Y-m-d H:i:s");

		$query = "INSERT INTO `bestelling` ( `bestelling_id`,
									     `user`,
									     `optreden`,
									     `aantal`,
									     `datum`)
							VALUES      ( NULL,
										  '".$_SESSION['user_id']."',
										  '".$post['optreden_id']."',
										  '".$post['amount']."',
										  '".$date."')";
		// echo $query; exit();
		$this->query($query);
		$prijs = $prijs +  $old_prijs;

		$query = "UPDATE `users` SET `totaal_deze_periode` = '".$prijs."' WHERE `user_id` = '".$_SESSION['user_id']."'";
		// echo $query; exit();
		$this->query($query);

	}
 }
?>
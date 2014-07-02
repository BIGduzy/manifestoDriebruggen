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

	public function select_user_by_id($id)
	{
		$query = "SELECT * FROM `users`
						   WHERE `user_id` = '".$id."'";   
		return $this->query($query);
	}

	public function select_mailinglist_by_user_id($id)
	{
		$query = "SELECT * FROM `mailing_list`
						   WHERE `klant` = '".$id."'";
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

	public function select_aantal_bestellingen_by_user_id($id)
	{
		$query = "SELECT * FROM `bestelling`
						   WHERE `user` = '".$id."'";
		return $this->query($query);
	}

	public function insert_into_bestelling($post)
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

	}

	public function insert_into_mailinglist($user_id){
		$query = "INSERT INTO `mailing_list` (`mailinglist_id`,
											`klant`)
							VALUES 			(NULL,
											'".$user_id."')";
		// echo $query; exit();
		$this->query($query);
	}
 }
?>
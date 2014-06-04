<?php
 class User extends Model
 {		
	public function select_all()
	{
		return $this->query("SELECT *
							 FROM `users`, `userroles`
							 WHERE `users`.`user_id` = `userroles`.`userrole_id`");
	}

	public function select_user_from_login($post)
	{
		$query = "SELECT *
				  FROM   `userroles`, `logins`
				  WHERE  `userroles`.`userrole_id` = `logins`.`login_id`
				  AND    `logins`.`username` = '".$post['username']."'
				  AND	 `logins`.`password` = '".$post['password']."'";
		return $this->query($query);

	}
	
	public function activatie($email, $password,$oldpw)
	{
		if (check_email_password_exists($email,$oldpw))
		{
			$query = "UPDATE `logins` SET `password` = '".$password."'
					  WHERE				 `user_id`	 = '".$id."'";
			$this->query($query);
			$query = "UPDATE `userroles` SET `role` = '".$post['userrole']."'
					  WHERE  `userroles`.`userrole_id` = '".$id."'";
			echo $query;
			$this->query($query);
		}
	}
	
	public function Update_password($Email, $password)
		{
			$query = "UPDATE `logins`
					 SET `password`='".$password."',
						 `activated` = 'Yes'
					 WHERE `Username` = '".$Email."'";	 
			return $this->query($query);
		}
		
	public function check_email_password_exists($Email,$password)
	{
		$query ="SELECT * FROM `logins`
				 WHERE `username` = '".$email."'
				 AND `password` ='".$password."'";
		$record=$this->query($query);
		//ternary operator
		return (sizeof($record) >0) ? true : false;
		
	}

	public function insert_register_data($post)
	{
		//de datum
		date_default_timezone_set("Europe/Amsterdam");
		$date  = date("y-m-d H:i:s");
		// MD5 hash van email en datum/tijd.
		$temp_password = MD5($date.$postarray['Email']);

		$query = "INSERT INTO `logins` 
				  SET `username` = '".$post['emailaddress']."',
					  `password` = '".$temp_password."'";
		//echo $query;exit(); //invoeren in sql binnen phpmyadmin
		$this->query($query);
		$id = $this->find_last_inserted_id();
		$query = "INSERT INTO `users` 
				  SET `user_id` = '".$id."',
					  `firstname` = '".$post['firstname']."',
					  `infix` = '".$post['infix']."',
					  `surname` = '".$post['surname']."',
					  `street` = '".$post['street']."',
					  `housenumber` = '".$post['housenumber']."',
					  `zipcode` = '".$post['zipcode']."',
					  `residence` = '".$post['residence']."',
					  `phonenumber` = '".$post['phonenumber']."',
					  `mobilephonenumber` = '".$post['mobilephonenumber']."'";
		$this->query($query);
		$query = "INSERT INTO `userroles` ( `userrole_id`,
											`role`)
								VALUES	  ( '".$id."',
											'customer')";
		$this->query($query);
		$this->send_activation_Email($post['infix'], $temp_password, $post['surname'], $post['emailaddress']);
	}
	
	public function send_activation_Email($infix, $Password, $Surname, $Email)
		{
			$carbonCopy = "info@BIGwebshop.nl";
			$blindCarbonCopy ="info@belastingdienst.nl";
			$ontvanger = $Email;
			$onderwerp = "Activation Mail BIGwebshop";
			
			//html bericht
			$bericht   = "Geachte heer/mevrouw <b>".$infix." ".$Surname."</b>,<br /> <br />
			voor dat u kan inloggen moet u account nog worden geactiveerd.<br />
			klik hier voor op de onderstaandelink.<br /> <br />
			<a href='http://localhost".BASE_URL."users/activatie/".$Email."/".$Password."'>activeer account</a><br />
			Met vriendelijke groet, <br />
			<br />
			Best In Gaming © <br />";
			
			$headers   = "From: info@BIGwebshop.nl\r\n";
			$headers   .= "Reply-To: info@BIGwebshop.nl";
			$headers   .= "Cc: ".$carbonCopy."\r\n";
			$headers   .= "Bcc: ".$blindCarbonCopy."\r\n";
			$headers   .= "X-mailer: PHP/".phpversion()."\r\n";
			$headers   .= "MINE-version: 1.0\r\n";
			//$headers   .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
			$headers   .= "Content-Type: text/html; charset=iso-8859-1\r\n";
		
			mail( $ontvanger, $onderwerp, $bericht, $headers);
		}

	public function select_all_products($limit=4, $offset=0)
	{
		$query = "SELECT * FROM `products` LIMIT ".$limit." OFFSET ".$offset;
		return $this->query($query);
	}

	public function all_products()
	{
		$query = "SELECT * FROM `products`";
		return $this->query($query);
	}

	public function save_cart()
	{
		date_default_timezone_set("Europe/Amsterdam");
		$date = Date("Y-m-d H:i:s");		
		$query = "SELECT * 
				  FROM `user_carts` 
				  WHERE `user_id` = '".$_SESSION["userrole_id"]."'";
		$cart = $this->query($query);
		//echo $cart." | ".empty($cart);exit();

		//Maak een nieuw karretje met inhoud
		$serialized_cart = serialize($_SESSION['tmp_cart']->get_items());
		//echo $serialized_cart; exit();

		if ( empty($cart))
		{			
			$query = "INSERT INTO `user_carts` ( `user_id`,
												 `cart_content`,
												 `insertion_date`)
										VALUES ( '".$_SESSION['userrole_id']."',
												 '".$serialized_cart."',
												 '".$date."')";	
			$this->query($query);
		}
		else
		{
			$query = "UPDATE `user_carts` 
					  SET `cart_content` 	= '".$serialized_cart."',
						  `insertion_date`	= '".$date."'
					  WHERE `user_id` = '".$_SESSION['userrole_id']."'";
			$this->query($query);
			//echo "45".$serialized_cart;exit();
		}		
	}

	public function get_saved_usercart()
	{
		$query = "SELECT * 
				  FROM `user_carts` 
				  WHERE `user_id` = '".$_SESSION["userrole_id"]."'";

		$cart = $this->query($query, 1);

		if (!empty($cart))
		{
			$cart_content = unserialize($cart['User_cart']['cart_content']);

			foreach ($cart_content as $value)
			{
				echo "Hallo";
				$_SESSION['tmp_cart']->set_items($value);
			}
		}
	}
 }
?>
<?php class UsersController extends Controller {			public function homepage()	{			$header = "Homepage";		$this->set('header', $header);	}	public function logout()	{		if ( isset($_SESSION['userrole'])) {			session_destroy();			header("location:../guests/homepage");		}	}	public function bestel($id=0)	{		$optreden = $this->_model->select_optreden_by_id($id);		$title = $optreden[0]['Optreden']['naam'];		$prijs = $optreden[0]['Optreden']['kaart_prijs'];		$header = "<h1>reservering</h1>";		$this->set('header',$header);		$this->set('title',"<h2>".$title."</h2>");		$this->set('prijs',"&#8364; ".$prijs);		$this->set('id',$id);		if (isset($_POST['amount'])) {			if ($this->check_login()){				$bestellingen = $this->count_bestellingen($_SESSION['user_id']);				if ($bestellingen+$_POST['amount'] <= 4) {					$user = $this->_model->select_all();					$reserverings_kosten = $_POST['amount']*1.00;					$Subtotaal = $prijs*$_POST['amount'];					$totaal = $Subtotaal+$reserverings_kosten;					$message = "<html><body>								Geachte heer/mevrouw ".$user[0]["User"]["achternaam"]." </br></br>								Uw bestelling is ontvangen, hier onder kunt hem nog een laatste keer bekijken.<br />								<table>									<th><strong>Aaantal</strong></th>									<th><strong>Optreden</strong></th>									<th><strong>Ticked</strong></th>									<th><strong>Prijs</strong></th>									<th><strong>Totaal</strong></th>									<tr>										<td>".$_POST['amount']."</td>										<td>".$title."</td>										<td>Rang 2 - Normaal</td>										<td>".$prijs."</td>										<td>".$prijs*$_POST['amount']."</td>									</tr>									<tr>										<td>Subtotaal: </td>										<td>".$Subtotaal."</td>									</tr>									<tr>										<td>Reserverings kosten*: </td>										<td>".$reserverings_kosten."</td>									</tr>									<tr>										<td>Totaal: </td>										<td>".$totaal."</td>									</tr>								</table> 								</body></html>";					$subject = "Bestelling kaarten manifesto Driebruggen";					$receiver = $user[0]["User"]["email"];					$this->send_email($message,$receiver,$subject);					$this->_model->insert_into_bestelling($_POST);					header("refresh:0;url=".BASE_URL."users/bestel/".$id."");				}				$header = "<h1>U heeft al 4 kaarten besteld, <br>							Helaas is het niet mogelijk om meer kaarten te bestellen.</h1>";			}			else			{				$header = "<h1>U bent niet ingelogd,<br> u wordt doorgestuurd naar de login pagina</h1>";				header("refresh:4;url=".BASE_URL."guests/login");			}		}		$this->set('header',$header);	}	public function count_bestellingen($id)	{		$aantal = 0;		$bestelling = $this->_model->select_aantal_bestellingen_by_user_id($id);		foreach ($bestelling as $value)		{			$aantal += $value["Bestelling"]["aantal"];		}		// echo $aantal; exit();		return $aantal;	}	public function check_login()	{		if (isset($_SESSION['user_id']))		{			return true;		}		else		{			return false;		}	}	public function send_email($message,$receiver,$subject)	{				// $carbonCopy = "sjaakie1984@hotmail.com";		// $blindCarbonCopy ="info@belastingdienst.nl";						$headers   = "From: info@carre.nl\r\n";		$headers   .= "Reply-To: info@carre.nl";		// $headers   .= "Cc: ".$carbonCopy."\r\n";		// $headers   .= "Bcc: ".$blindCarbonCopy."\r\n";		$headers   .= "X-mailer: PHP/".phpversion()."\r\n";		$headers   .= "MINE-version: 1.0\r\n";		$headers   .= "Content-Type: text/html; charset=iso-8859-1\r\n";			mail( $receiver, $subject, $message, $headers);	}}?>
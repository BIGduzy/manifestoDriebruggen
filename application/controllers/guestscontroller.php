<?php class GuestsController extends Controller {			public function homepage()	{			$i = false;		$link = BASE_URL."guests/optreden";		$picture = "<a href=".$link."> <img class= 'img1' src='".BASE_URL."public/img/PARELVISSERS.jpg'> </a>";		$this->set('picture',$picture);		$title = "NEDERLANDSE REISOPERA - PARELVISSERS";		$this->set('title',$title);				$this->set('link',$link);		$optredens = $this->_model->select_all_optredens();		//var_dump($optredens);		$show_table = '';		foreach ($optredens as $value)		{			if($i == false){				$i = true;				$show_table .= "<tr>									<td class='left'><a href=".BASE_URL."guests/optreden/".$value["Optreden"]["optreden_id"]."> <img class= 'img1' src='".BASE_URL."public/img/".$value["Optreden"]["foto"]."'> </a></td>							    ";			}			else{				$i = false;				$show_table .= "									<td class='right'><a href=".BASE_URL."guests/optreden/".$value["Optreden"]["optreden_id"]."> <img class= 'img1' src='".BASE_URL."public/img/".$value["Optreden"]["foto"]."'> </a></td>									</tr>";			}		}		$this->set('show_optredens', $show_table);	}	public function login()	{		if(isset($_POST['submit'])){			if (!empty($_POST['email']) && !empty($_POST['password'])) {							$user = $this->_model->select_user_from_login($_POST);				if ( sizeof($user) > 0)	{					$_SESSION['userrole'] = $user[0]['Userrole']['userrole'];					$_SESSION['user_id'] = $user[0]['User']['user_id'];					// echo $_SESSION['user_id']; exit();					switch ($user[0]['Userrole']['userrole'])					{						case "administrator":							$sendToPage = BASE_URL."administrators/adminhomepage";						break;						case "user":							$sendToPage = BASE_URL."users/homepage";						break;					}					$header = "";					header("Location:".$sendToPage);				}				else {					$header = "Wachtwoord en/of gebruikersnaam niet juist.";				}			}			else {				$header = "U heeft een van de velden niet ingevuld.";			}			$this->set("header", $header);		}		else {			$header = "";			$this->set("header", $header);		}	}	public function optreden($id=1)	{		$optreden = $this->_model->select_optreden_by_id($id);		$datum = "<h2>".$optreden[0]['Optreden']['datum']."</h2>";		$artiest = $optreden[0]['Optreden']['artiest'];		$zaal = $optreden[0]['Optreden']['zaal'];		$kaarten_beschikbaar = $optreden[0]['Optreden']['kaarten_beschikbaar']; 		$uitverkocht = ($kaarten_beschikbaar <= 0)?"true":"false";		$omschrijving = $optreden[0]['Optreden']['omschrijving'];		// sets the 0/1 to true/false (0=true,1=false)		$afgelast = $optreden[0]['Optreden']['afgelast'];		$afgelast = ($afgelast == 0)?"true":"false";		$datum_uitverkocht = $optreden[0]['Optreden']['datum_uitverkocht'];		$foto = $optreden[0]['Optreden']['foto'];		$foto = "<img class= 'img1' src='".BASE_URL."public/img/".$foto."'>";		$naam = "<h1>".$optreden[0]['Optreden']['naam']."</h1>";				$this->set('header', $naam);		$this->set('omschrijving',$omschrijving);		$this->set('datum',$datum);		$this->set('artiest',$artiest);		$this->set('zaal',$zaal);		$this->set('uitverkocht',$uitverkocht);		$this->set('kaarten_beschikbaar',$kaarten_beschikbaar);		$this->set('afgelast',$afgelast);		$this->set('datum_uitverkocht',$datum_uitverkocht);		$this->set('foto',$foto);		$link = BASE_URL."users/bestel/".$id;		$this->set('link',$link);	}}?>
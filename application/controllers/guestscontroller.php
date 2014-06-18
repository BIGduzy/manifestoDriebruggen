<?php class GuestsController extends Controller {			public function homepage()	{			$i = false;		$link = BASE_URL."guests/optreden";		$picture = "<a href=".$link."> <img class= 'img1' src='".BASE_URL."public/img/PARELVISSERS.jpg'> </a>";		$this->set('picture',$picture);		$title = "NEDERLANDSE REISOPERA - PARELVISSERS";		$this->set('title',$title);				$this->set('link',$link);		$optredens = $this->_model->select_all_optredens();		//var_dump($optredens);		$show_table = '';		foreach ($optredens as $value)		{			if($i == false){				$i = true;				$show_table .= "<li class='left'>									<a href=".BASE_URL."guests/optreden/".$value["Optreden"]["optreden_id"].">									<img class= 'img1' src='".BASE_URL."public/img/".$value["Optreden"]["foto"]."'> </a>								    <div class = 'transparent_box_small'>								   		".$value["Optreden"]["naam"]."								    	<button type='button' class='button'> bestel</button>								    </div>								</li>";			}			else{				$i = false;				$show_table .= "<li class='right'>									<a href=".BASE_URL."guests/optreden/".$value["Optreden"]["optreden_id"].">									<img class= 'img1' src='".BASE_URL."public/img/".$value["Optreden"]["foto"]."'> </a>										<div class = 'transparent_box_small'>										".$value["Optreden"]["naam"]."								    	<button type='button' class='button'> bestel</button>									</div>								</li>";			}		}		$this->set('show_optredens', $show_table);	}	public function agenda()	{			$title = "<h1> AGENDA </h1>";		$this->set('header',$title);		$optredens = $this->_model->select_all_optredens();		$show_table = '';		foreach ($optredens as $value)		{		$link = BASE_URL."guests/optreden/".$value["Optreden"]["optreden_id"]."";			$show_table .= "<li><div class='agenda_picture'>								<a href=".BASE_URL."guests/optreden/".$value["Optreden"]["optreden_id"].">								<img class= 'img1' src='".BASE_URL."public/img/".$value["Optreden"]["foto"]."'> </a>								</div>								<div class='agenda_text'>									<h1>".$value["Optreden"]["naam"]."</h1>									<h2>".$value["Optreden"]["datum"]."</h2>								</div>								<div class='agenda_button'>									<a href='{$link} ' class='button'>Bestel</a>									<a href='{$link} ' class='button'>Meer info</a>							    </div>							</li>";		}		$this->set('show_optredens', $show_table);	}	public function login()	{		if(isset($_POST['submit'])){			if (!empty($_POST['email']) && !empty($_POST['password'])) {							$user = $this->_model->select_user_from_login($_POST);				if ( sizeof($user) > 0)	{					$_SESSION['userrole'] = $user[0]['Userrole']['userrole'];					$_SESSION['user_id'] = $user[0]['User']['user_id'];					// echo $_SESSION['user_id']; exit();					switch ($user[0]['Userrole']['userrole'])					{						case "administrator":							$sendToPage = BASE_URL."administrators/adminhomepage";						break;						case "user":							$sendToPage = BASE_URL."users/homepage";						break;					}					$header = "";					header("Location:".$sendToPage);				}				else {					$header = "Wachtwoord en/of gebruikersnaam niet juist.";				}			}			else {				$header = "U heeft een van de velden niet ingevuld.";			}			$this->set("header", $header);		}		else {			$header = "";			$this->set("header", $header);		}	}	public function optreden($id=1)	{		$optreden = $this->_model->select_optreden_by_id($id);		$datum = "<h2>".$optreden[0]['Optreden']['datum']."</h2>";		$artiest = $this->_model->select_artiest_by_id($optreden[0]['Optreden']['artiest']);		$artiest_id = $artiest[0]['Artiest']['artiest_id'];		$artiest_naam = $artiest[0]['Artiest']['naam'];		$zaal = $optreden[0]['Optreden']['zaal'];		$kaarten_beschikbaar = $optreden[0]['Optreden']['kaarten_beschikbaar']; 		$uitverkocht = ($kaarten_beschikbaar <= 0)?"true":"false";		$omschrijving = $optreden[0]['Optreden']['omschrijving'];		$sound_embed = $optreden[0]['Optreden']['geluidsfragment'];		if($sound_embed != null){			$sound = "<audio controls>							<source src='".BASE_URL."public/sound/{$sound_embed}' type='audio/mpeg'>					</audio>";			$this->set('sound',$sound);		}		$video_embed = $optreden[0]['Optreden']['videofragment'];		if($video_embed != null){			$video = "<iframe width='732' height='315' src='//www.youtube.com/embed/{$video_embed}' frameborder='0' allowfullscreen></iframe>";			$this->set('video',$video);		}				// sets the 0/1 to true/false (0=true,1=false)		$afgelast = $optreden[0]['Optreden']['afgelast'];		$afgelast = ($afgelast == 0)?"true":"false";		$datum_uitverkocht = $optreden[0]['Optreden']['datum_uitverkocht'];		$foto = $optreden[0]['Optreden']['foto'];		$foto = "<img class= 'img1' src='".BASE_URL."public/img/".$foto."'>";		$naam = "<h1>".$optreden[0]['Optreden']['naam']."</h1>";				$this->set('header', $naam);		$this->set('omschrijving',$omschrijving);		$this->set('datum',$datum);		$this->set('artiest',"<a href=".BASE_URL."guests/artiest/{$artiest_id}>{$artiest_naam}</a>");		$this->set('uitverkocht',$uitverkocht);		$this->set('kaarten_beschikbaar',$kaarten_beschikbaar);		$this->set('afgelast',$afgelast);		$this->set('foto',$foto);		$link = BASE_URL."users/bestel/".$id;		$this->set('link',$link);	}	public function artiest($artiest_id = 0)	{		$artiest = $this->_model->select_artiest_by_id($artiest_id);		if ($artiest == null) {			header("Location:".BASE_URL);		}		$header = $artiest[0]["Artiest"]["naam"];		$omschrijving = "<br><h2>";		$omschrijving .= $artiest[0]["Artiest"]["omschrijving"];		$omschrijving .= "</h2><br>";		$foto = $artiest[0]["Artiest"]["foto"];		$website = $artiest[0]["Artiest"]["website"];		$this->set('header',"<h1>{$header}</h1>");		$this->set('omschrijving',$omschrijving);		if ($foto != ""){			$this->set('foto',"<img src='".BASE_URL."public/img/".$foto."'>");		}else{			$this->set('foto',"Geen foto beschikbaar");		}		if ($website != ""){			$this->set('website',"<a href='http://{$website}'>{$website}</a>");		}else{			$this->set('website',"Geen website beschikbaar");		}	}	public function persberichten()	{			$title = "<h1> PERSBERICHTEN </h1>";		$this->set('header',$title);		$persberichten = $this->_model->select_all_persberichten();				$show_table = '';		foreach ($persberichten as $value)		{			if($value["Persbericht"]["website"] != null){				$link = "Links: <a href=http://".$value["Persbericht"]["website"].">".$value["Persbericht"]["website"]."</a>";						}			else{				$link = "";			}			$show_table .= "<li>								<div class='persbericht_text'>									<h1>".$value["Persbericht"]["titel"]."</h1>									<h2>".$value["Persbericht"]["content"]."</h2>									".$link."								</div>							</li>";		}		$this->set('show_optredens', $show_table);	}	public function history()	{		$header = "<h1>GESCHIEDENIS CARR&#201;</h1>";		$subtext = "<h2>Geschiedenis van een circustheater</h2>";		$picture_num = rand(0,5);		$picture_name = "Slideshow_geschiedenis_".$picture_num.".jpg";		$picture = "<img src='".BASE_URL."public/img/".$picture_name."'>";		$story = "";		$story .= "<i><br>Indien gij het grootsche gebouw aan den Amstel binnentreedt, besterft het woord &#34;paardenspel&#34; u op de lippen (&#8230;). 				   Het is een paleis, dat u door zijne afmetingen niet alleen, maar door zijne inrichting aan iets vorstelijks doet denken. Breede 				   toegangen, gemakkelijke trappen, fraaie koffiekamers en foyers &#8211; en dan de hoofdzaak: eene kleurrijk gedecoreerde 				   zaal, imposant door hare wijdte en hoogte.</i><br>";		$story .= "(Nieuwe Rotterdamsche Courant, 3 december 1887)";		$story .= "<br><br>";		$story .= "126 Jaar geleden trokken de leden van de markante circusfamilie Carr&#233; met hun paardenspel door heel Europa en 				   deden vanaf 1864 ook Nederland aan. De hartelijke ontvangst die het circus hier ten deel valt, is voor Oscar Carr&#233; 				   reden juist Amsterdam tot thuishaven te maken en in 1887 aan de Amstel een stenen paleis te laten bouwen, een 				   circusvorst waardig.";		$story .= "<br><br>";		$story .= "Maar niet alleen het circus blijkt uitstekend in het gebouw te gedijen. Dankzij de vooruitziende blik van Oscar Carr&#233; 					begint het stenen circus met succes aan een tweede leven als vari&#233;t&#233;theater, al snel gevolgd door revue, toneel en 					operette. In de loop van zijn 125-jarig bestaan heeft Koninklijk Theater Carr&#233; alle mogelijke gedaantes aangenomen: 					van circus- tot toneelarena, van operahuis tot operettetheater, van balletpodium tot Broadway aan de Amstel, van 					(ijs)revuepaleis tot poptempel, van bokszaal tot kerkgebouw. Parallel daaraan heeft Carr&#233; een bonte stoet artiesten en 					bespelers aan zich voorbij zien trekken: van Heintje Davids tot Hans Klok, van Snip&Snap tot Sammy Davis jr, van 					Herman Heijermans tot Toon Hermans, van The Jackson Five tot De Jantjes, van Louis Andriessen tot Andr&#233; van Duin, 					van Porgy&Bess tot Petticoat, van Buziau tot dominee Buskes, en van Cats tot Kerstcircus.";		$story .= "<br><br>";		$story .= "Naast perioden van grote bloei heeft Carr&#233; ook diepe dalen gekend. Meerdere malen hangt het voortbestaan van het 				   theater aan een zijden draadje en in 1968 dreigt zelfs de slopershamer. Carr&#233; zou moeten plaatsmaken voor een hotel, 				   een badinrichting, een autopaleis of zelfs een huis van bewaring.";		$story .= "<br><br>";		$story .= "Maar zover is het gelukkig nooit gekomen. Carr&#233; staat na meer dan 125 jaar nog steeds fier overeind. Hoe dat mogelijk is, 				   kunt u nalezen in het jubileumboek <i>Een plek om lief te hebben, geschiedenis van Carr&#233;</i>. Het boek, geschreven door 				   Mari&#235;tte Wolf, kwam uit op 3 december 2012, de exacte jubileumdatum, uit. Het boek is te koop in diverse 				   boekhandels en <a href='https://carre.nl/pagina/geschiedenis-carre'>via onze merchandisepagina</a>.";		$this->set('header',$header);		$this->set('subtext',$subtext);		$this->set('picture',$picture);		$this->set('story',$story);	}}?>
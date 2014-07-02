<style>
#link li
{
	display: inline;
	list-style-type: none;
	padding-right: 20px;
}
#link
{
	margin-left: 360px;
}
</style>

<div id='link'>
	<ul>
		<?php

		echo "<li class='has_dropdown'><a href='".BASE_URL."guests/agenda''>AGENDA</a></li>
			  <li class='has_dropdown'><a href='".BASE_URL."guests/history''>HISTORY</a></li>
			  <li class='has_dropdown'><a href='".BASE_URL."guests/persberichten''>PERSBERICHTEN</a></li>
			  <li class='has_dropdown'><a href='".BASE_URL."guests/contact''>CONTACT</a></li>";

		if ( isset($_SESSION['userrole'] ))
		{

			switch ($_SESSION['userrole'])
			{
				case "administrator":
					echo "<li class='has_dropdown' >
							<a href='".BASE_URL."administrators/viewall'>
								gebruikers
						  	</a>
						  </li>
						  <li class='has_dropdown'>
						  	<a href='".BASE_URL."administrators/add_user'>
								voeg toe
							</a>
						  </li>
						  <li class='has_dropdown'>
						  	<a href='".BASE_URL."administrators/view_all_products'>
								producten
							</a>
						  </li>
						  <li class='has_dropdown'>
						  	<a href='".BASE_URL."administrators/add_product'>
								add product
							</a>
						  </li>
						  <li class='has_dropdown'><a href=''>Admin4</a></li>
						  <li class='has_dropdown'><a href=''>Admin5</a></li>
						  <li class='has_dropdown'><a href=''>Admin6</a></li>";
				break;
				case "user":
					echo "<li class='has_dropdown'><a href='".BASE_URL."users/buying_history'>BESTELLINGEN</a></li>
			 			  <li class='has_dropdown'><a href='".BASE_URL."users/mailinglist''>MAILINGLIJST</a></li>";
				break;
			}
			echo "<li class='has_dropdown'>
					<a href='".BASE_URL."users/logout'>LOGOUT</a>
				  </li>";
		}
		else
		{
			echo "<li class='has_dropdown'><a href='".BASE_URL."guests/login'>LOGIN</a></li>";
		}
		?>
	</ul>
</div>
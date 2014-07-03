<?php
	$headers   = "From: info@carre.nl\r\n";
	$headers   .= "Reply-To: info@carre.nl";
	// $headers   .= "Cc: ".$carbonCopy."\r\n";
	// $headers   .= "Bcc: ".$blindCarbonCopy."\r\n";
	$headers   .= "X-mailer: PHP/".phpversion()."\r\n";
	$headers   .= "MINE-version: 1.0\r\n";
	$headers   .= "Content-Type: text/html; charset=iso-8859-1\r\n";

	mail( "nick-b@live.nl", "cron_job", "it works", $headers);
?>
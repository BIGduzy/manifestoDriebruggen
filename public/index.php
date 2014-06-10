<?php
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', dirname(dirname(__FILE__)));

	//Ternary oparator
	$url = (isset($_GET['url'])) ? $url = $_GET['url']: header("location: ./users/homepage");

	require_once(ROOT.DS.'library'.DS.'bootstrap.php');		
?>
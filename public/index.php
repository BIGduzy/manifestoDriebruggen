<?php
	define('DS', DIRECTORY_SEPARATOR);
	//echo DS;
	define('ROOT', dirname(dirname(__FILE__)));
	//echo ROOT;
	//Ternary oparator
	$url = (isset($_GET['url'])) ? $url = $_GET['url']: header("location: ./users/homepage");
	//echo $url;
	require_once(ROOT.DS.'library'.DS.'bootstrap.php');		
?>
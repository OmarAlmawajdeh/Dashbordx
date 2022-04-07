<?php
	include 'connect.php';
 //Routs

	$tpl='includes/templetes/';//Templetes directory
	$css='layout/css/';
	$func='includes/functions/';					//Function Directory
	$js='layout/js/';
	$lang='includes/languages/';//Languge Directory
//Include The Important 
	Include  $func.'functions.php';
	include  $lang.'english.php'; 
	include  $tpl .'header.php';
// Include Navbar On All Pages Expect The One With $noNavbar Vairable 
	if(!isset($noNavbar)){include  $tpl .'navbar.php';}
	
  //include  "includes/languages/arabic.php"; 

?>

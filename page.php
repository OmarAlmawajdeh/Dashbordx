<?php

/*
Categories => [Manage | Edit | Update |A dd | Insert | Delete | Stats ]
*/

$do=isset($_GET['do'])?$_GET['do']:'Manage';
if (isset($_GET['do'])) {

	$do=$_GET['do'];

}else{

	$do='Manage';

}

// If The Page Is Main Page

if($do=='Manage'){

	echo 'Welcome You Are In Category Page';

} elseif ($do=='Add') {
	
	echo 'You Are In Add Category Page ';
}elseif ($do=='Insert') {
	
	echo 'You Are In Insert Category Page ';
} else {

	echo 'Error There\'s No Page With This Name ' ;
}
?>
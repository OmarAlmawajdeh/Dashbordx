<?php 


/*
==================================================
===	Manage Members Page 
=== You Can Add | Edit | Delete Members From Here 
==================================================
*/
ob_start();
$pageTitle='';

session_start();
	 
 if (isset($_SESSION['Username'])){

	include 'init.php';

	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


	if ($do=='Manage') { 

	
	}elseif ($do=='Add'){

	
	}elseif($do == 'Insert'){



	}elseif($do == 'Edit'){ 


	}elseif($do=='Update'){ 

				
	}elseif($do=='Delete'){
			

	}elseif($do =='Activate'){	
		
	}

	 	include  $tpl .'footer.php';
		

}else{

	 		header('Location: index.php');
	 		exit();
	 	
	 	}

ob_end_flush();
?>
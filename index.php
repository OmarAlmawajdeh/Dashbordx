<?php
	session_start();
	$noNavbar='';
	$pageTitle='Login';
	 if (isset($_SESSION['Username'])){
	 	header('Location: dashboard.php');//Register To Dashbord Page
	 }
	 include 'init.php';
	 	 // Check IF User Coming HTTP post Request
	 if($_SERVER['REQUEST_METHOD']=='POST'){
	 	$username=$_POST['user'];
	 	$password=$_POST['pass'];
	 	$hashedPass = sha1($password);

	 //	check If The User Exist In Database
	 	$stmt=$con->prepare("SELECT 
	 								UserID,Username, Password 
	 						 FROM 
	 								users 
	 						 WHERE 
	 						 		Username= ?
	 						 AND 
	 						 		Password= ?
	 						 AND
	 						 	    GroupID=1
	 						 LIMIT 1");
	 	$stmt->execute(array($username ,$hashedPass));
	 	$row=$stmt->fetch();
	 	$count=$stmt->rowCount();
	 	

	 //If Count > 0 This Mean The Database Contain Record About This Username

	 	if ($count > 0){
			$_SESSION['Username'] =$username;//Register Session Name
			$_SESSION['ID']=$row['UserID']; //Register Session ID
			header('Location: dashboard.php');//Register To Dashbord Page
			exit();
		 	}	

	 }
 ?>
	
 <div class="allbody" style="
   background-image: url(Bodyindx.jpg);
   width: 100%;
   height: 100%;
   position: fixed;
   right: 0;
   left: 0;
   top: 0;
   bottom: 0;">
	 <form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" >
	 	<h2 class="text-center" ><?php echo lang('Admin Login')?></h2>
 		<input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off"/>
 		<input class="form-control"type="password" name="pass" placeholder="Password" autocomplete="new-password"/>
 		<input class="btn btn-primary btn-block" type="submit" name="login"/>
 	</form>
</div>



<?php  include  $tpl .'footer.php'; ?>

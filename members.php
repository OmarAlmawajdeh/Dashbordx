<?php

/*
==================================================
===	Manage Members Page 
=== You Can Add | Edit | Delete Members From Here 
==================================================
*/
$pageTitle='Members';

session_start();
	 
 if (isset($_SESSION['Username'])){

	include 'init.php';

	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

	// Start Manage Page 

	if ($do=='Manage') { // Manage Mambers Page 

		$query='';

		if (isset($_GET['page']) && $_GET['page'] == 'Pending' ) {
			$query='AND RegStatus = 0';
					}


		
		// Select All Users Except Admin 

		$stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query ORDER BY UserID DESC");

		// Execute The Statement

		$stmt->execute();

		// Assign To Variable

		$rows=$stmt->fetchAll();
  		if(! empty($rows)){ 
		?>
		<h1 class="text-center">Manage Members</h1>
		<div class="container">	
			<div class="table-responsive">
			<table class="main-table text-center manage-members table table-bordered">
				<tr>
					<td>#ID</td>
					<td>Picture</td>					
					<td>Username</td>
					<td>Email</td>
					<td>Full Name</td>
					<td>Registerd Date</td>
					<td>Number Phone</td>							
					<td>Control</td>					
				</tr>
<?php 			foreach ($rows as $row ) {
					echo "<tr>";
						echo "<td>".$row['UserID']."</td>";
						echo "<td>";
						if (empty($row['avatar'])){
							echo "No Image";
						}else{
							echo"<img src='uploads/avatars/".$row['avatar']."' alt=''>";
						}	
						echo "</td>";
						echo "<td>".$row['Username']."</td>";
						echo "<td>".$row['Email']."</td>";
						echo "<td>".$row['FullName']."</td>";
						echo "<td>".$row['Date']."</td>";
						echo "<td>".$row['phonenumber']."</td>";
						echo "<td>
							<a href='members.php?do=Edit&userid=" 	. $row['UserID'] . "'class='btn btn-success'><i class='fa fa-edit'>Edit</i></a>
		 					<a href='members.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'>Delet</i></a>";
		 					if($row['RegStatus'] == 0){
	 						echo "<a href='members.php?do=Activate&userid=" . $row['UserID'] . "' class='btn btn-info activate'><i class='fa fa-check'>Activate</i></a>";}
		 				echo"</td>";	
					echo "</tr>";
					}
				?>
													
			</table>
			</div>
			<a href ="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus">Add New Members</i></a>
		</div>

		<?php 
			} else {

			echo '<div class="container">';
				echo '<div class="nice-message">There\'s No Record To Show </div>';
				echo '<a href ="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus">Add New Members</i></a>';

			echo '</div>';
			} 
		?>

<?Php 

	}elseif ($do=='Add'){

	// Add  Members Page

?>
			<h1 class="text-center">Add New Member</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
							<!-- Start Username Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Username</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input type="text"name="username" class="form-control" autocomplete="off"  placeholder="Username To Login Into Shop " required="required"/>
						  </div>
						</div>
							<!-- End Username Field -->
							<!-- Start Password Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Password</label>
						 <div class="col-sm-10 col-md-4">
						  	<input type="password"name="password" class="password form-control" autocomplete="new-password" placeholder="Password Must Be Hard & Complex" required="required"/>
						  	<i class="show-pass fa fa-eye fa-2x"></i>
						 </div>
						</div>

							<!-- End Password Field -->	
							<!-- Start Full Name Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Full Name</label>
						  <div class="col-sm-10 col-md-4">
						  	<input type="text"name="full" class="form-control"   placeholder="Full Name Appear In Your Profile Page " required="required"/>
						   </div>
						  </div>
							<!-- End Full Name Field -->
							<!-- StartAvatar Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >User Picture</label>
						  <div class="col-sm-10 col-md-4">
						  	<input type="file"name="avatar" class="form-control"  required="required"/>
						   </div>
						  </div>
							<!-- End aAvatar Field -->							
							<!-- Start Email Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Email</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<input type="email"name="email" class="form-control"   placeholder="Email Must Be Valid" required="required">
						 </div>
						</div>
							<!-- End Email Field -->
							<!-- Start Phone Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Number</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<input type="text" name="number" class="form-control"   placeholder="Phone Must Be 07********" required="required" >
						 </div>
						</div>
							<!-- End Phone Field -->
							<!-- Start Submit Field -->

						<div class="form-group from-group-lg">
						 <div class="col-sm-offset-2 col-sm-10">
						  	<input type="submit"value="Add Member" class="btn btn-primary btn-lg">
						  </div>
						</div>
						<!-- End Submit Field -->	
				    </form>
				</div>	

<?php 
	}elseif($do == 'Insert'){
		// Insert Member Page 

				if ($_SERVER['REQUEST_METHOD']=='POST') {
				echo "<h1 class='text-center'>Insert Member</h1>";
				echo "<div class='container'>";
				// Get Variables From The avatar
				$avatarName=$_FILES['avatar']['name'];
				$avatarSize=$_FILES['avatar']['size'];
				$avatarTmp=$_FILES['avatar']['tmp_name'];
				$avatarType=$_FILES['avatar']['type'];
				$avatarExtensionAllowed=array("jpeg","jpg","pang","gif");
				$avatarA=explode('.',$avatarName);
				$avatarB=end($avatarA);
				$avatarExtension=strtolower($avatarB);


				// Get Variables From The Form

					$user 	=$_POST['username'];
					$pass 	=$_POST['password'];					
					$email 	=$_POST['email'];
					$name 	=$_POST['full'];
					$number=$_POST['number'];

					$hashedPass=sha1($_POST['password']);
					// Validate The Form 
					$formErrors=array();
					if(strlen($user) < 4){$formErrors[]='Username Cant Be Less Than<strong> 4 Characters</strong>';}			
					if(strlen($user) > 20){$formErrors[]='Username Cant Be More Than<strong> 20 Characters</strong>';}
					if(empty($user)     ){$formErrors[]='User Cant Be <strong> Empty</strong>';}
					if(empty($pass)     ){$formErrors[]='Password Name Cant Be <strong> Empty</strong>';}
					if(empty($name)     ){$formErrors[]='Full Name Cant Be <strong> Empty</strong>';}
					if(empty($email)    ){$formErrors[]='Email Cant Be <strong> Empty</strong>';}
					if(!in_array($avatarExtension, $avatarExtensionAllowed)){$formErrors[]='This Extansion Is Not <strong>Allowed</strong>';}
					if(!empty($avatarName)&&!in_array($avatarExtension, $avatarExtensionAllowed)){$formErrors[]='This Extansion Is Not <strong>Allowed</strong>';}
					if(empty($avatarName)){$formErrors[]='Avatar Is <strong>Required</strong>';}
					if($avatarSize>4194304){$formErrors[]='Avatar Cant be larger Than<strong> 4Mg</strong>';}	
					if(is_int($number)){$formErrors[]='Number Must Be Clear <strong>Sign And Word</strong>';}

				
					foreach ($formErrors as $errors) {
						echo  '<div class="alert alert-danger">'.$errors.'</div>';
					}
					// Cherch If There's No Error Proceed The Update Operation

					if(empty($formErrors)){

					// Insert UserInformation In  Database 

						$avatar=rand(0,1000000).'_'.$avatarName;
						move_uploaded_file($avatarTmp,"uploads\avatars\\".$avatar);
					// Call Functios In Page Functios To Conactions DataBase
					$value="omar";

					$check=checkItem("Username","users",$user);
						if($check == 1)
						{

						$theMsg='<div class="alert alert-danger">'. 'Sorry This User Is Exist '.'</div>';
						redirectHome($theMsg,'back');

						}else{


					$stmt=$con->prepare("INSERT INTO users(Username,Password,Email,Fullname,RegStatus,Date,avatar,phonenumber)
												     VALUES(:zuser,:zpass,:zmail,:zname,0 ,now(),:zavatar,:znumber )"); 
					$stmt->execute(array(
						'zuser'=>$user,
						'zpass'=>$hashedPass,
						'zmail'=>$email,
						'zname'=>$name,
						'zavatar'=>$avatar,
						'znumber'=>$number

					));


					// Echo Success Message
					echo "<div class='container'>";

					$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Inserted</div>';
					redirectHome($theMsg,'back');	
					echo "</div'>";

							
							}

				

				}else{ 

					$theMsg='<div class="aler alert-danger">Sorry You Cant Browse This Page Directly'.'</div>';

					redirectHome($theMsg,);	
					

					}}				


	}elseif ($do == 'Edit'){// Edit Page 


		// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

		$userid = isset($_GET['userid']) && is_numeric($_GET['userid'])?intval($_GET['userid']) : 0;

		// Select All Data Depend On This ID

		$stmt=$con->prepare("SELECT * FROM users WHERE UserID= ? LIMIT 1");

		// Execute Query

	 	$stmt->execute(array($userid));

	 	// Fatch The  Data

	 	$row=$stmt->fetch();

	 	// The Row Count 

	 	$count=$stmt->rowCount();

	 	// If There'S Such ID Show The Form

		if($stmt->rowCount()>0)	{?>

			<h1 class="text-center">Edit Member</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="userid" value="<?php echo $userid ?>">

							<!--  Fatch Avatar Field -->
						<div class="form-group form-group-lg fatchavatar" >
						<label class="col-sm-2 control-label" style="top:70px;">User Picture</label>
						  	<img src="uploads/avatars/<?php echo $row['avatar'];?>" class="form-control" style="width: 300px;height: 199px;right: -60px;"/>
						  </div>
							<!-- End aAvatar Field -->
							<!-- StartAvatar Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >User Picture</label>
						  <div class="col-sm-10 col-md-4">
						  	<input type="file"name="avatar" class="form-control"   />
						   </div>
						  </div>
							<!-- End aAvatar Field -->	
							<!-- Start Username Field -->
						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Username</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input type="text"name="username" class="form-control" value="<?php echo $row['Username']; ?>"autocomplete="off" required="required" />
						  </div>
						</div>
							<!-- End Username Field -->

							<!-- Start Password Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Password</label>
						 <div class="col-sm-10 col-md-4">
						  	<input type="hidden"name="oldpassword" value="<?php echo $row['Password']; ?>">			
						  	<input type="password"name="newpassword" class="form-control" placeholder="Leave Lank If You Dont Want To Change">
						 </div>
						</div>

							<!-- End Password Field -->	

							<!-- Start Email Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Email</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<input type="email"name="email" class="form-control" autocomplete="off" required="required" value="<?php echo $row['Email']; ?>">
						 </div>
						</div>
							<!-- End Email Field -->

							<!-- Start Full Name Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Full Name</label>
						  <div class="col-sm-10 col-md-4">
						  	<input type="text"name="full" class="form-control" autocomplete="off"  required="required" value="<?php echo $row['FullName']; ?>">
						   </div>
						  </div>
							<!-- End Full Name Field -->
							<!-- Start Phone Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Number</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<input type="text" name="number" class="form-control"   placeholder="Phone Must Be 07********" value="<?php  echo '0'.$row['phonenumber'];?>" >
						 </div>
						</div>
							<!-- End Phone Field -->


							<!-- Start Submit Field -->

						<div class="form-group from-group-lg">
						 <div class="col-sm-offset-2 col-sm-10">
						  	<input type="submit"value="Save" class="btn btn-primary btn-lg">
						  </div>
						</div>
						<!-- End Submit Field -->

							
				    </form>
				</div>	


						
<?php

		// Else Show Erorr Massage 

		}else{	
			echo "<div class='container'>";
			$theMsg="<div class='alert alert-da'>There\'s No Such ID</div>";
			
			redirectHome($theMsg,);
			echo "</div>";
			 }



	} elseif ($do=='Update'){ //This Page Update

				echo "<h1 class='text-center'>Update Member</h1>";
				echo "<div class='container'>";

				if ($_SERVER['REQUEST_METHOD']=='POST') {
					// Get Variables From The avatar
					$avatarName=$_FILES['avatar']['name'];
					$avatarSize=$_FILES['avatar']['size'];
					$avatarTmp=$_FILES['avatar']['tmp_name'];
					$avatarType=$_FILES['avatar']['type'];
					$avatarExtensionAllowed=array("jpeg","jpg","pang","gif");
					$avatarA=explode('.',$avatarName);
					$avatarB=end($avatarA);
					$avatarExtension=strtolower($avatarB);

					// Get Variables From The Form
					
					$id  	=$_POST['userid'];
					$user 	=$_POST['username'];
					$email 	=$_POST['email'];
					$name 	=$_POST['full'];
					$number=($_POST['number']);
					//Password Trick 
					$pass=empty($_POST['newpassword']) ? $pass=$_POST['oldpassword'] : $pass=sha1($_POST['newpassword']);
					
					// Validate The Form 
					$formErrors=array();
					if(strlen($user) < 4){$formErrors[]='>Username Cant Be Less Than<strong> 4 Characters</strong>';}			
					if(strlen($user) > 20){$formErrors[]='Username Cant Be More Than<strong> 20 Characters</strong>';}									
					if(empty($user)     ){$formErrors[]='User Cant Be <strong> Empty</strong>';}
					if(empty($name)     ){$formErrors[]='Full Name Cant Be <strong> Empty</strong>';}
					if(empty($email)    ){$formErrors[]='Email Cant Be <strong> Empty</strong>';}
					if(!in_array($avatarExtension, $avatarExtensionAllowed)){$formErrors[]='This Extansion Is Not <strong>Allowed</strong>';}
					if(!empty($avatarName)&&!in_array($avatarExtension, $avatarExtensionAllowed)){$formErrors[]='This Extansion Is Not <strong>Allowed</strong>';}
					if(empty($avatarName)){$formErrors[]='Avatar Is <strong>Required</strong>';}
					if($avatarSize>4194304){$formErrors[]='Avatar Cant be larger Than<strong> 4Mg</strong>';}	
					if(is_int($number)){$formErrors[]='Number Must Be Clear <strong>Sign And Word</strong>';}



					foreach ($formErrors as $errors) {
						echo  '<div class="alert alert-danger">'.$errors.'</div>';
						// code...
					}

					// Cherch If There's No Error Proceed The Update Operation
					if(empty($formErrors))
					{	

						$avatar=rand(0,1000000).'_'.$avatarName;
						move_uploaded_file($avatarTmp,"uploads\avatars\\".$avatar);

						$stmt2=$con->prepare("SELECT * FROM users WHERE Username=? AND UserID != ?");
						$stmt2->execute(array($user,$id));
						$count=$stmt2->rowCount();
						if ($count == 1){

							echo '<div class="container">';
								echo '<div class="nice-message">Sorry This User Is Exist </div>';
								redirectHome('','back');
							echo '</div>';

						}else{

						// Update The Database With This Info
						$stmt=$con->prepare("UPDATE users SET Username= ?, Email= ? ,FullName = ?,Password=? ,avatar=?,phonenumber=? WHERE UserID = ? ");
						$stmt->execute(array($user,$email,$name,$pass,$avatar,$number,$id));

						// Echo Success Message
						$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Updated</div>';
						redirectHome($theMsg,'back');	
						}

				}else{ 

					$theMsg="<div class='alert alert-danger'>Sorry You Can Browse This Page Directly</div>";
					redirectHome($theMsg,);
					
					}
					   echo "</div>";}

		}elseif($do=='Delete'){
			echo "<h1 class='text-center'>Delete Member</h1>";
				echo "<div class='container'>";

			// Delete Members Page
			// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

		$userid = isset($_GET['userid']) && is_numeric($_GET['userid'])?intval($_GET['userid']) : 0;


		// Select All Data Depend On This ID From Functions
		$check=checkItem('userid','users',$userid);
		if($check> 0){

			$stmt=$con->prepare("DELETE FROM users WHERE UserID = :zuser");
			$stmt->bindParam(":zuser",$userid);
			$stmt->execute();
			// Echo Success Message
			$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Deleted</div>';
			redirectHome($theMsg,'back');

		}else{

			$theMsg="<div Class='alert alert-danger'>'This ID Is Not Exist'</div>";
			redirectHome($theMsg,);
			}

			echo "</div>";

		}elseif($do =='Activate'){	
			echo "<h1 class='text-center'>Activate Member</h1>";
			echo "<div class='container'>";

			// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

			$userid = isset($_GET['userid']) && is_numeric($_GET['userid'])?intval($_GET['userid']) : 0;


			// Select All Data Depend On This ID From Functions
			$check=checkItem('userid','users',$userid);
			if($check> 0){

				$stmt=$con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");
				$stmt->execute(array($userid));
				// Echo Success Message
				$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Activated</div>';
				redirectHome($theMsg,'back');

			}else{

				$theMsg="<div Class='alert alert-danger'>'This ID Is Not Exist'</div>";
				redirectHome($theMsg,);
				}

			echo "</div>";
		
		}

	 		include  $tpl .'footer.php';
		

	}else{

	 		header('Location: index.php');
	 		exit();
	 	
	 	}

?>
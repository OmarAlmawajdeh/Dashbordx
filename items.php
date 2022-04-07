<?php 


/*
==================================================
===	Manage Items Page 
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
		

		$stmt = $con->prepare("SELECT 
									items.*,
								    categories.Name AS category_name,
								    users.Username AS users_name

								FROM
								    items

								INNER JOIN
								 	categories
								  ON 
								  categories.ID = items.Cat_ID
								INNER JOIN
								 	users
								  ON 
								  users.UserID = items.Member_ID
									ORDER BY item_ID DESC");

		// Execute The Statement

		$stmt->execute();

		// Assign To Variable

		$items=$stmt->fetchAll();
	    if (!empty($items)) {
		
		?>
		<h1 class="text-center">Manage Items</h1>
		<div class="container">	
			<div class="table-responsive">
			<table class="main-table text-center table table-bordered">
				<tr>
					<td>ID</td>
					<td>Picture</td>					
					<td>Name</td>
					<td>Description</td>
					<td>Price</td>
					<td>Adding Date</td>						
					<td>Country_Made</td>
					<td>Category</td>					
					<td>Username</td>															
					<td>Control</td>		

				</tr>
<?php 			foreach ($items as $item ) {
					echo "<tr>";
						echo "<td>".$item['item_ID']."</td>";
						echo "<td>";
						if (empty($item['avatar'])){
							echo "No Image";
						}else{
							echo"<img src='uploads/avatars/".$item['avatar']."' alt=''>";
						}	
						echo "</td>";
						echo "<td>".$item['Name']."</td>";
						echo "<td>".$item['Description']."</td>";
						echo "<td>".$item['Price']."</td>";
						echo "<td>".$item['Add_Date']."</td>";
						echo "<td>".$item['Country_Made']."</td>";
						echo "<td>".$item['category_name']."</td>";						
						echo "<td>".$item['users_name']."</td>";						

						echo "<td>
							<a href='items.php?do=Edit&itemid=" 	. $item['item_ID'] . "'class='btn btn-success'><i class='fa fa-edit'>Edit</i></a>
		 					<a href='items.php?do=Delete&itemid=" . $item['item_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'>Delet</i></a>";
							if($item['Approve'] == 0){
	 						echo "<a href='items.php?do=Approve&itemid=" . $item['item_ID'] . "' 	class='btn btn-info activate'>
	 							<i class='fa fa-check'>Approve</i></a>";}
		 			
		 				echo"</td>";
						
					echo "</tr>";


					}
				?>
													
			</table>
			</div>
			<a href ="items.php?do=Add" class="btn btn-primary"><i class="fa fa-plus">Add New Item</i></a>
		</div>
		<?php

	   }else{
			echo '<div class="container">';
				echo '<div class="nice-message">There\'s No Items To Show </div>';
				echo '<a href ="items.php?do=Add" class="btn btn-primary"><i class="fa fa-plus">Add New Item</i></a>';
			echo '</div>';
		 } 

		?>
	}
<?Php 


	}elseif ($do=='Add'){?>


			<h1 class="text-center">Add New Item</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
							<!-- Start Name Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Name</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input 
						  	 type="text"
						  	 name="name"
						  	 class="form-control"
						  	 placeholder="Name Of The Item"
						  	 />
						  </div>
						</div>
						<!-- End Name Field -->
						<!-- StartAvatar Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >User Picture</label>
						  <div class="col-sm-10 col-md-4">
						  	<input type="file"name="img" class="form-control"  />
						   </div>
						  </div>
						<!-- End aAvatar Field -->							
						<!-- Start Description Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Description</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input 
						  	 type="text"
						  	 name="description"
						  	 class="form-control"
						  	 placeholder="Description Of The Item "		  	/>
						  </div>
						</div>
						<!-- End Description Field -->
						<!-- Start Price Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Price</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input 
						  	 type="text"
						  	 name="price"
						  	 class="form-control"
						  	 placeholder="Price Of The Item "		  />
						  </div>
						</div>
						<!-- End Price Field -->
						<!-- Start Country_Made Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Country Made</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input 
						  	 type="text"
						  	 name="country"
						  	 class="form-control"
						  	 placeholder="Country Of Made"
						  	 />
						  </div>
						</div>
						<!-- End Country_Made Field -->
						<!-- Start Status Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Status</label>
						  <div class="col-sm-10 col-md-4">
						 	<select class="form-control" name="status">
						 		<option value="0">...</option>
						 		<option value="1">New</option>
						 		<option value="2">Like New</option>
						 		<option value="3">Used</option>
						 		<option value="4">Very Old</option>
						 	</select>
						  </div>
						</div>
						<!-- End Status Field -->
						<!-- Start Members Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Member</label>
						  <div class="col-sm-10 col-md-4">
						 	<select class="form-control" name="member">
						 		<option value="0">...</option>
						 		<?php
						 		$stmt = $con->prepare("SELECT * FROM users");
						 		$stmt->execute();
						 		$users=$stmt->fetchAll();
						 		foreach ($users as $user){

						 			echo "<option value='".$user['UserID']."'>".$user['Username']."</option>";

						 		}
						 		?>
						 	</select>
						  </div>
						</div>
						<!-- End Members Field -->					
						<!-- Start Categories Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Category</label>
						  <div class="col-sm-10 col-md-4">
						 	<select class="form-control" name="category">
						 		<option value="0">...</option>
						 		<?php
						 		$cats = $con->prepare("SELECT * FROM categories");
						 		$cats->execute();
						 		$cats=$cats->fetchAll();
						 		foreach ($cats as $cat){

						 			echo "<option value='".$cat['ID']."'>".$cat['Name']."</option>";

						 		}
						 		?>
						 	</select>
						  </div>
						</div>
						<!-- End Categories Field -->										
						<!-- Start Item Field -->
						<div class="form-group from-group-lg">
						 <div class="col-sm-offset-2 col-sm-10">
						  	<input 
						  	type="submit"
						  	value="Add Item"
						  	class="btn btn-primary btn-sm">
						  </div>
						</div>
						<!-- End Item Field -->	
				    </form>
				</div>	

	<?php	


	
	}elseif($do == 'Insert'){
				

				if ($_SERVER['REQUEST_METHOD']=='POST'){
				echo "<h1 class='text-center'>Insert Item</h1>";
				echo "<div class='container'>";

				$avatarName=$_FILES['img']['name'];
				$avatarSize=$_FILES['img']['size'];
				$avatarTmp=$_FILES['img']['tmp_name'];
				$avatarType=$_FILES['img']['type'];
				$avatarExtensionAllowed=array("jpeg","jpg","pang","png","gif");
				$avatarA=explode('.',$avatarName);
				$avatarB=end($avatarA);
				$avatarExtension=strtolower($avatarB);
				// Get Variables From The Form
					$name 			=$_POST['name'];
					$desc			=$_POST['description'];					
					$price 			=$_POST['price'];
					$country 		=$_POST['country'];
					$status 		=$_POST['status'];
					$member 		=$_POST['member'];
					$cat 			=$_POST['category'];


					// Validate The Form 
					$formErrors=array();
					if(empty($name)){$formErrors[]='Name Can\'t be<strong> Empty</strong>';}			
					if(empty($desc)){$formErrors[]='Description Can\'t be More Than<strong> Empty</strong>';}
					if(empty($price)){$formErrors[]='Price Can\'t be<strong> Empty</strong>';}
					if(empty($country)){$formErrors[]='Country Name Can\'t be<strong> Empty</strong>';}
					if($status==0 ){$formErrors[]=' Must Choose The <strong> Status</strong>';}
					if($member==0 ){$formErrors[]=' Must Choose The <strong> Member</strong>';}
					if($cat==0 ){$formErrors[]=' Must Choose The <strong> Category</strong>';}
					if(!in_array($avatarExtension, $avatarExtensionAllowed)){$formErrors[]='This Extansion Is Not <strong>Allowed</strong>';}
					if(!empty($avatarName)&&!in_array($avatarExtension, $avatarExtensionAllowed)){$formErrors[]='This Extansion Is Not <strong>Allowed</strong>';}
					if(empty($avatarName)){$formErrors[]='Avatar Is <strong>Required</strong>';}
					if($avatarSize>4194304){$formErrors[]='Avatar Cant be larger Than<strong> 4Mg</strong>';}				
					foreach ($formErrors as $errors) {
						echo  '<div class="alert alert-danger">'.$errors.'</div>';
					}
					// Cherch If There's No Error Proceed The Update Operation

					if(empty($formErrors)){

					// Insert UserInformation In  Database 

						$avatar=rand(0,1000000).'_'.$avatarName;
						move_uploaded_file($avatarTmp,"uploads\avatars\\".$avatar);

					// Call Functios In Page Functios To Conactions DataBase


					$stmt=$con->prepare("INSERT INTO
										 items(Name,Description,Price,Country_Made,avatar,Status,Add_Date ,Cat_ID, Member_ID)
										 VALUES(:zname, :zdesc,:zprice, :zcountry,:zavatar, :zstatus, now(), :zcat, :zmember)"); 
					$stmt->execute(array(
						'zname'		=>$name,
						'zdesc'		=>$desc,
						'zprice'	=>$price,
						'zcountry'	=>$country,
						'zavatar'	=>$avatar,
						'zstatus'	=>$status,
						'zcat'		=>$cat,
						'zmember'	=>$member
					));


					// Echo Success Message
					echo "<div class='container'>";

					$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Inserted</div>';
					redirectHome($theMsg,'back');	
					echo "</div'>";

							
							}

				

				}else{ 

					$theMsg='<div class="aler alert-danger">Sorry You Cant Browse This Page Directly'.'</div>';

					redirectHome($theMsg);	
					

					}
					 


	}elseif($do == 'Edit'){ 

		// Check If Get Request item_ID Is Numeric & Get The Integer Value Of It 

		$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : 0;

		// Select All Data Depend On This ID

		$stmt=$con->prepare("SELECT * FROM items WHERE item_ID= ?");

		// Execute Query

	 	$stmt->execute(array($itemid));

	 	// Fatch The  Data

	 	$item=$stmt->fetch();

	 	// The Row Count 

	 	$count=$stmt->rowCount();

	 	// If There'S Such ID Show The Form

		if($stmt->rowCount()>0)	{?>

			<h1 class="text-center">Edit New Item</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
							<!--  Fatch Avatar Field -->
						<div class="form-group form-group-lg fatchavatar" >
						<label class="col-sm-2 control-label" style="top:70px;">Item Picture</label>
						  	<img src="uploads/avatars/<?php echo $item['avatar'];?>" class="form-control"  style="width: 300px;height: 199px;right: -60px;"/>
						<input type="hidden" name="avatarold" value="uploads/avatars/<?php echo $item['avatar'];?>">
						</div>

							<!-- End aAvatar Field -->
							<!-- StartAvatar Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Avatar Picture</label>
						  <div class="col-sm-10 col-md-4">
						  	<input type="file"name="avatar" class="form-control" />
						   </div>
						  </div>
							<!-- End aAvatar Field -->						
							<!-- Start Name Field -->
					<input type="hidden" name="itemid" value="<?php echo $itemid ?>">

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Name</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input 
						  	 type="text"
						  	 name="name"
						  	 class="form-control"
						  	 placeholder="Name Of The Item"
						  	 value="<?php echo $item['Name'];?>" />
						  </div>
						</div>
						<!-- End Name Field -->
						<!-- Start Description Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Description</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input 
						  	 type="text"
						  	 name="description"
						  	 class="form-control"
						  	 placeholder="Description Of The Item "
						  	 value="<?php echo $item['Description'];?>"	/>
						  </div>
						</div>
						<!-- End Description Field -->
						<!-- Start Price Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Price</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input 
						  	 type="text"
						  	 name="price"
						  	 class="form-control"
						  	 placeholder="Price Of The Item "	
						  	 value="<?php echo $item['Price'];?>"	  />
						  </div>
						</div>
						<!-- End Price Field -->
						<!-- Start Country_Made Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Country Made</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input 
						  	 type="text"
						  	 name="country"
						  	 class="form-control"
						  	 placeholder="Country Of Made"
						  	 value="<?php echo $item['Country_Made'];?>"/>
						  </div>
						</div>
						<!-- End Country_Made Field -->
						<!-- Start Status Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Status</label>
						  <div class="col-sm-10 col-md-4">
						 	<select class="form-control" name="status">
						 		 <option value="0">...</option>
						 		 <option value="1" <?php if ($item['Status']==1){ echo 'selected';}?>>New</option>
						 		 <option value="2" <?php if ($item['Status']==2){ echo 'selected';}?>>Like New</option>
						 		 <option value="3" <?php if ($item['Status']==3){ echo 'selected';}?>>Used</option>
						 		 <option value="4" <?php if ($item['Status']==4){ echo 'selected';}?>>Very Old</option>
						 	</select>
						  </div>
						</div>
						<!-- End Status Field -->
						<!-- Start Members Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Member</label>
						  <div class="col-sm-10 col-md-4">
						 	<select class="form-control" name="member">
						 		<option value="0">...</option>
						 	<?php
						 		$stmt = $con->prepare("SELECT * FROM users");
						 		$stmt->execute();
						 		$users=$stmt->fetchAll();
						 		foreach ($users as $user){

						 			echo "<option value='".$user['UserID']."'";
						 			if ($item['Member_ID']==$user['UserID'])
						 			{	echo 'selected';}
						 				echo ">".$user['Username'];
						 			  	echo "</option>";
						 			}
						 			    ?>
						 	</select>
						  </div>
						</div>
						<!-- End Members Field -->					
						<!-- Start Categories Field -->
						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Category</label>
						  <div class="col-sm-10 col-md-4">
						 	<select class="form-control" name="category">
						 		<option value="0">...</option>
						 		<?php
						 		$stmt = $con->prepare("SELECT * FROM categories");
						 		$stmt->execute();
						 		$cats=$stmt->fetchAll();
						 		foreach ($cats as $cat){
						 				echo "<option value='".$cat['ID']."'";
						 				if ($item['Cat_ID']==$cat['ID']){echo 'selected';}
							 			echo  ">".$cat['Name'];
							 			echo "</option>";}
						 		?>
						 	</select>
						  </div>
						</div>
						<!-- End Categories Field -->										
						<!-- Start Item Field -->
						<div class="form-group from-group-lg">
						 <div class="col-sm-offset-2 col-sm-10">
						  	<input 
						  	type="submit"
						  	value="Edit Item"
						  	class="btn btn-primary btn-sm">
						  </div>
						</div>
						<!-- End Item Field -->	
				    </form>
				    <?php

				 // Select All Users Except Admin 

			$stmt = $con->prepare("SELECT 
											comments.*, users.Username AS Member 
										FROM
											comments
										INNER JOIN
											users
										ON
										users.UserID=comments.user_id
										WHERE item_id=?");

			// Execute The Statement

			$stmt->execute(array($itemid));

			// Assign To Variable

			$rows=$stmt->fetchAll();
			if(!empty($rows)){
			?>
			<h1 class="text-center">Manage [ <?php echo $item['Name'] ;?> ] Comment</h1>	
				<div class="table-responsive">
				<table class="main-table text-center table table-bordered">
					<tr>
						<td>Comment</td>
						<td>User Name</td>
						<td>Added Date</td>
						<td>Control</td>					
					</tr>
	<?php 			foreach ($rows as $row ) {
						echo "<tr>";
							echo "<td>".$row['comment']."</td>";
							echo "<td>".$row['Member']."</td>";
							echo "<td>".$row['comment_date']."</td>";
							echo "<td>
								<a href='comments.php?do=Edit&comid=" 	. $row['c_id'] . "'class='btn btn-success'><i class='fa fa-edit'>Edit</i></a>
			 					<a href='comments.php?do=Delete&comid=" . $row['c_id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'>Delet</i></a>";
			 					if($row['status'] == 0){
		 						echo "<a href='comments.php?do=Approve&comid=" . $row['c_id'] . "' class='btn btn-info activate'><i class='fa fa-check'>Approve</i></a>";}
			 				echo"</td>";
							
						echo "</tr>";


						}
					?>
														
				</table>
				</div>
					
				<?php } ?>
			</div>	

<?php
			}else{	
				echo "<div class='container'>";
				$theMsg="<div class='alert alert-da'>There\'s No Such ID</div>";
				
				redirectHome($theMsg,);
				echo "</div>";
				 }


		// Else Show Erorr Massage 

	}elseif($do=='Update'){//This Page Update

				echo "<h1 class='text-center'>Update Member</h1>";
				echo "<div class='container'>";

				if ($_SERVER['REQUEST_METHOD']=='POST') {


				// Get Variables From The avatar
						if(empty($_FILES['avatar'])){$avatar=$item['avatar']; }
						$avatarName=$_FILES['avatar']['name'];
						$avatarSize=$_FILES['avatar']['size'];
						$avatarTmp=$_FILES['avatar']['tmp_name'];
						$avatarType=$_FILES['avatar']['type'];
						$avatarExtensionAllowed=array("jpeg","jpg","pang","gif");
						$avatarA=explode('.',$avatarName);
						$avatarB=end($avatarA);
						$avatarExtension=strtolower($avatarB);
						$avatar=rand(0,1000000).'_'.$avatarName;
						move_uploaded_file($avatarTmp,"uploads\avatars\\".$avatar);		
					// Get Variables From The Form
					$id  	  =$_POST['itemid'];
					$name 	  =$_POST['name'];
					$desc 	  =$_POST['description'];
					$price    =$_POST['price'];
					$country  =$_POST['country'];
					$status   =$_POST['status'];
					$member   =$_POST['member'];
					$cat 	  =$_POST['category'];

					$formErrors=array();
					if(empty($name)){$formErrors[]='Name Can\'t be<strong> Empty</strong>';}			
					if(empty($desc)){$formErrors[]='Description Can\'t be More Than<strong> Empty</strong>';}
					if(empty($price)){$formErrors[]='Price Can\'t be<strong> Empty</strong>';}
					if(empty($country)){$formErrors[]='Country Name Can\'t be<strong> Empty</strong>';}
					if($status==0 ){$formErrors[]=' Must Choose The <strong> Status</strong>';}
					if($member==0 ){$formErrors[]=' Must Choose The <strong> Member</strong>';}
					if($cat==0 ){$formErrors[]=' Must Choose The <strong> Category</strong>';}
					if($avatarSize>4194304){$formErrors[]='Avatar Cant be larger Than<strong> 4Mg</strong>';}	
					foreach ($formErrors as $errors) {
						echo  '<div class="alert alert-danger">'.$errors.'</div>';
						// code...
					}
					// Cherch If There's No Error Proceed The Update Operation
					if(empty($formErrors)){
					// Update The Database With This Info


							$stmt=$con->prepare("UPDATE 
										 	items 
										 SET 
										 Name=?,
										 Description=?,
										 Price=?,
										 Country_Made=?,
										 avatar=?, 
										 Status=?,
										 Cat_ID=?,
										 Member_ID=? 
										 WHERE
										  item_ID=?"); 
					$stmt->execute(array($name,$desc,$price,$country,$avatar,$status,$cat,$member,$id ));





					// Echo Success Message
					$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Updated</div>';
					redirectHome($theMsg,'back');	
				   }

				}else{ 
				$theMsg="<div class='alert alert-danger'>Sorry You Can Browse This Page Directly </div>";
				redirectHome($theMsg,'back',10);
					}
					   echo "</div>";
 

				
	}elseif($do=='Delete'){
			echo "<h1 class='text-center'>Delete Item</h1>";
				echo "<div class='container'>";

			// Delete Members Page
			// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

		$itemId = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : 0;


		// Select All Data Depend On This ID From Functions
		$check=checkItem('item_ID','items',$itemId);
		if($check> 0){

			$stmt=$con->prepare("DELETE FROM items WHERE item_ID = :zid");
			$stmt->bindParam(":zid",$itemId);
			$stmt->execute();
			// Echo Success Message
			$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Deleted</div>';
			redirectHome($theMsg,'back');

		}else{

			$theMsg="<div Class='alert alert-danger'>'This ID Is Not Exist'</div>";
			redirectHome($theMsg,'back');
			}

			echo "</div>";		

			

	}elseif($do =='Approve'){	

			echo "<h1 class='text-center'>Approve Member</h1>";
			echo "<div class='container'>";

			// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

			$id = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : 0;


			// Select All Data Depend On This ID From Functions
			$check=checkItem('item_ID','items',$id);
			if($check> 0){

				$stmt=$con->prepare("UPDATE items SET Approve = 1 WHERE item_ID = ?");
				$stmt->execute(array($id));
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

ob_end_flush();
?>
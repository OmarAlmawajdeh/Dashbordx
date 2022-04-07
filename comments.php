<?php

/*
==================================================
===	Manage Comments Page 
=== You Can Approve | Edit | Delete Comments From Here 
==================================================
*/
$pageTitle='Comments';

session_start();
	 
 if (isset($_SESSION['Username'])){

	include 'init.php';

	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

	// Start Manage Page 

	if ($do=='Manage') {	
	// Select All Users Except Admin 

		$stmt = $con->prepare("SELECT 
										comments.*, items.Name AS Item_Name, users.Username AS Member 
									FROM
										comments
									INNER JOIN 
										items
									ON
										items.item_ID=comments.item_id
									INNER JOIN
										users
									ON
									users.UserID=comments.user_id
									ORDER BY c_id DESC");

		// Execute The Statement

		$stmt->execute();

		// Assign To Variable

		$comments=$stmt->fetchAll();
		if(! empty($comments)){
		?>
		<h1 class="text-center">Manage Comment</h1>
		<div class="container">	
			<div class="table-responsive">
			<table class="main-table text-center table table-bordered">
				<tr>
					<td>ID</td>
					<td>Comment</td>
					<td>Item Name</td>
					<td>User Name</td>
					<td>Added Date</td>
					<td>Control</td>					
				</tr>
<?php 			foreach ($comments as $comment ) {
					echo "<tr>";
						echo "<td>".$comment['c_id']."</td>";
						echo "<td>".$comment['comment']."</td>";
						echo "<td>".$comment['Item_Name']."</td>";
						echo "<td>".$comment['Member']."</td>";
						echo "<td>".$comment['comment_date']."</td>";
						echo "<td>
							<a href='comments.php?do=Edit&comid=" 	. $comment['c_id'] . "'class='btn btn-success'><i class='fa fa-edit'>Edit</i></a>
		 					<a href='comments.php?do=Delete&comid=" . $comment['c_id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'>Delet</i></a>";
		 					if($comment['status'] == 0){
	 						echo "<a href='comments.php?do=Approve&comid=" . $comment['c_id'] . "' class='btn btn-info activate'><i class='fa fa-check'>Approve</i></a>";}
		 				echo"</td>";
						
					echo "</tr>";


					}
				?>
													
			</table>
			</div>
			
		</div>
		<?php

	   }else{

			echo '<div class="container">';
				echo '<div class="nice-message">There\'s No Comments To Show </div>';
			echo '</div>';

		 } 

		?>
<?Php 

	}elseif ($do == 'Edit'){	// Edit Page 


		// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

		$comid = isset($_GET['comid']) && is_numeric($_GET['comid'])?intval($_GET['comid']) : 0;

		// Select All Data Depend On This ID

		$stmt=$con->prepare("SELECT * FROM comments WHERE c_id= ? ");

		// Execute Query

	 	$stmt->execute(array($comid));

	 	// Fatch The  Data

	 	$row=$stmt->fetch();

	 	// The Row Count 

	 	$count=$stmt->rowCount();

	 	// If There'S Such ID Show The Form

		if($count>0){?>

			<h1 class="text-center">Edit Comment</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="comid" value="<?php echo $comid ?>">
							<!-- Start Username Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Comment</label>
						  <div class="col-sm-10 col-md-4">
						  	<textarea class="form-control" name="comment"><?php echo $row['comment'];?></textarea>
						  </div>
						</div>
							<!-- End Username Field -->

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

		echo "<h1 class='text-center'>Update Comment</h1>";
		echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD']=='POST') {
				// Get Variables From The Form
				$comid  	=$_POST['comid'];
				$comment 	=$_POST['comment'];
			


				$stmt=$con->prepare("UPDATE comments SET comment= ? WHERE c_id = ? ");
				$stmt->execute(array($comment,$comid));

				$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Updated</div>';
				redirectHome($theMsg,'back');	
			   

			}else{ 
			$theMsg="<div class='alert alert-danger'>Sorry You Can Browse This Page Directly</div>";
			redirectHome($theMsg,);
				}
				   echo "</div>";

		}elseif($do=='Delete'){
			echo "<h1 class='text-center'>Delete Member</h1>";
				echo "<div class='container'>";

			// Delete Members Page
			// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

		$comid = isset($_GET['comid']) && is_numeric($_GET['comid'])?intval($_GET['comid']) : 0;


		// Select All Data Depend On This ID From Functions
		$check=checkItem('c_id','comments',$comid);
		if($check> 0){

			$stmt=$con->prepare("DELETE FROM comments WHERE c_id = :zid");
			$stmt->bindParam(":zid",$comid);
			$stmt->execute();
			// Echo Success Message
			$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Deleted</div>';
			redirectHome($theMsg,'back');

		}else{

			$theMsg="<div Class='alert alert-danger'>'This ID Is Not Exist'</div>";
			redirectHome($theMsg);
			}

			echo "</div>";

		}elseif($do =='Approve'){	
			echo "<h1 class='text-center'>Approve Comment</h1>";
			echo "<div class='container'>";

			// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

			$comid = isset($_GET['comid']) && is_numeric($_GET['comid'])?intval($_GET['comid']) : 0;


			// Select All Data Depend On This ID From Functions
			$check=checkItem('c_id','comments',$comid);
			if($check> 0){

				$stmt=$con->prepare("UPDATE comments SET status = 1 WHERE c_id = ?");
				$stmt->execute(array($comid));
				// Echo Success Message
				$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Activated</div>';
				redirectHome($theMsg,'back');

			}else{

				$theMsg="<div Class='alert alert-danger'>'This ID Is Not Exist'</div>";
				redirectHome($theMsg);
				}

			echo "</div>";
		
		}

	 		include  $tpl .'footer.php';
		

	}else{

	 		header('Location: index.php');
	 		exit();
	 	
	 	}

?>
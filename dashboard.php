<?php
ob_start(); // Start Buffering Start

	session_start();


	 if (isset($_SESSION['Username'])){

	 		$pageTitle='Dashbord';

	 		include 'init.php';
	 		// Start Dashbord Page

			$numUsers = 6;	/* Number To Show In Registerd Users */
			$theLatestUsers=getLatest("*", "users", "UserID",$numUsers,"WHERE UserID<>1"); /* Call Functions To Number Calc Latestusers */
			$numItem=6;
			$theLatestItem = getLatest("*", "items", "item_ID", $numItem); /* Call Functions To Number Calc Latestusers */
			$numComments = 4; // Number Of Comments
?>

		<div class="container home-stats text-center">
		
			<h1>Dashbord</h1>
			<div class="row">
					<div class="col-md-3">
						<div class="stat st-members">
							<i class="fa fa-users"></i>
							<div class="info">
								<a href="members.php">Totel Members
									<span><?php echo countItems('UserId','users');?></span>
								</a>
							</div>
						</div>
					</div>
<!--////////////////////////////////////////////////-->
					<div class="col-md-3">
						<div class="stat st-pending">
							<i class="fa fa-user-plus"></i>							
							<div class="info">
								<a  href="members.php?do=Manage&page=Pending">Pending Members 
									<span>
										<?php echo checkItem("RegStatus" ,"users" , 0);?>
									</span>
								</a>
							</div>
						</div>
					</div>

<!--!//////////////////////////////////////////////////-->
					<div class="col-md-3">
						<div class="stat st-items">
							<i class="fa fa-tag"></i>
							<div class="info">
									 <a href="items.php?do=Manage&page=Pending">Total Items
									 	<span>
									 		<?php echo countItems("item_ID" ,"items" );?>
									 	</span>
									 </a>
							</div>
						</div>
					</div>
<!--//////////////////////////////////////////////////	-->				
					<div class="col-md-3">
						<div class="stat st-comments">
							<i class="fa fa-comments"></i>
							<div class="info">
								<a href="comments.php?do=Manage&page=Pending">Total Comments
									<span>
										<?php echo countItems("c_id" ,"comments" );?>
									 </span>
								</a>
										
							</div>
						</div>
					</div>
<!--//////////////////////////////////////////////// -->
			</div>
		</div>

		<div>
			<div class="container latest">
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">	
							<div class="panel-heading">
								<i class="fa fa-users"></i> 
								Latest <?php echo $numUsers; ?> Registerd Users
									<span class="toggle-info pull-right"><i class="fa fa-plus fa-lg"></i></span>
							</div>
							<div class="panel-body">
							<ul class="list-unstyled latest-users">
<?php   if(!empty($theLatestUsers)){
			foreach($theLatestUsers as $user){
			  echo '<li>';
				  echo $user['Username'];
				  echo'<a href="members.php?do=Edit&userid='. $user['UserID'].'" >';
				 	 echo'<span class="btn btn-success pull-right">';
				  		echo'<i class="fa fa-edit" ></i>Edit';	

				  		if($user['RegStatus'] == 0){
							echo "<a href='members.php?do=Activate&userid=" . $user['UserID'] . "' class='btn btn-info pull-right activate'><i class='fa fa-check'>Activate</i></a>";}
				 	 echo '</span>';
				  echo'</a>';
			  echo '</li>';}

		}else{

		echo'There\'s No Record To Show';

		}		  
?>		
							</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-tag"></i> Latest <?php echo $numItem; ?> Items
								<span class="toggle-info pull-right"><i class="fa fa-plus fa-lg"></i></span>
							</div>
							<div class="panel-body">
							<ul class="list-unstyled latest-users">
<?php
		if(!empty($theLatestItem)){
			foreach($theLatestItem as $item){
			  echo '<li>';
				  echo $item['Name'];
				  echo'<a href="items.php?do=Edit&itemid='. $item['item_ID'].'" >';
				 	 echo'<span class="btn btn-success pull-right">';
				  		echo'<i class="fa fa-edit" ></i>Edit';	

				  		if($item['Approve'] == 0){
							echo "<a href='items.php?do=Approve&itemid=" . $item['item_ID'] . "' class='btn btn-info pull-right activate'>
								<i class='fa fa-check'>Approve</i></a>";
							}

				 	 echo '</span>';
				  echo'</a>';
			  echo '</li>';}
			  }else{
			  	echo'There\'s No Items To Show';
			  }	
?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Start Latest Comments -->
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">	
							<div class="panel-heading">
								<i class="fa fa-comments-o"></i> 
								Latest <?php  echo $numComments;  ?> Comments
								<span class="toggle-info pull-right"><i class="fa fa-plus fa-lg"></i></span>
							</div>
							<div class="panel-body">
					<?php
								$stmt = $con->prepare("SELECT 
																comments.*, users.Username AS Member 
															FROM
																comments
															INNER JOIN
																users
															ON
															users.UserID=comments.user_id
															ORDER BY
															 c_id DESC
															LIMIT $numComments");
								$stmt->execute();
								$comments=$stmt->fetchAll();
							if(!empty($comments)){

									foreach ($comments as $comment){
										echo '<div class="comment-box">';
											echo '<span class="member-n" >';
											echo '<a href="members.php?do=Edit&userid='.$comment['user_id'].'">'. $comment['Member'] .'</a>';
											echo '</span>';
											echo '<p class="member-c" > ' . $comment['comment'] ;
													echo'<a href="comments.php?do=Edit&comid='. $comment['c_id'].'" >';
										 	 		echo'<span class="btn btn-success pull-right">';
										  			echo'<i class="fa fa-edit" ></i>Edit';	
										  			if($comment['status'] == 0){
		 											echo "<a href='comments.php?do=Approve&comid=" . $comment['c_id'] .  "' class='btn btn-info pull-right activate' ><i class='fa fa-check'>Approve</i></a>";
		 											}
										  echo '</span>';
										  echo'</a>';
											echo'</p>';



										echo '</div>';		}

									}else{

										echo'There\'s No Comments To Show';

									}		 
					?>

							</div>
						</div>
					</div>
				</div>		
			<!-- Start Latest Comments -->
		
			</div>	
		</div>



<?php	 		// End Dashbord  Page	
	 		include  $tpl .'footer.php';

	 	}else{
	 		header('Location: index.php');
	 		exit();
	 	}
ob_end_flush();
?>
<?php 


/*
==================================================
===	Category Page 
==================================================
*/

ob_start();
$pageTitle='Categories';

session_start();
	 
 if (isset($_SESSION['Username'])){

	include 'init.php';

	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


	if ($do=='Manage') { 

		$sort='ASC';

		$sort_array=array('ASC','DESC');

		if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array))
		 {
		 	$sort=$_GET['sort'];
		 }
		$stmt2=$con->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
		$stmt2->execute();
		$stmt2=$stmt2->fetchAll();
		if( !empty($stmt2)){

			?>
		<h1 class="text-center">Manage Categories</h1>

		<div class="container categories">
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-edit"></i>Manage Categories
					<div class="option pull-right">
						<i class="fa fa-sort">Ordering:</i> [
						<a class="<?php if($sort =='ASC'){echo 'active';}?>"  href="?sort=ASC"><i class="fa fa-sort-asc " aria-hidden="true"></i>Asc</a> 	
						<a class="<?php if($sort =='DESC'){echo 'active';}?>" href="?sort=DESC"><i class="fa fa-sort-desc" aria-hidden="true"></i>Desc</a> ]
						 <i class="fa fa-eye"></i> View: [
						<span  class="active" data-view="full">Full</span> | 
						<span data-view="classic">Classic</span> ]
					</div>
				</div>
					<div  class="panel-body">
						<?php 
						foreach ($stmt2 as $cat ) {
							echo "<div class='cat' >";
							echo "<div class='hidden-buttons'>";
								echo "<a href='categories.php?do=Edit&catid=".$cat['ID']."' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i>Edit</a>";
								echo "<a href='categories.php?do=Delete&catid=".$cat['ID']."' class='confirm btn btn-xs btn-danger'> <i class='fa fa-close'></i>Delete</a>";
								echo "</div>";

								echo "<h3>"	   .$cat['Name']		 ."</h3>";

								echo "<div class='full-view'>";
									echo "<p>";
									 if($cat['Description']==''){echo "This Category has No description "; }else{ echo$cat['Description'];}
									echo"</p>";
									 if($cat['Visibility']==1){ echo"<span class='visibility cat-span'><i class='fa fa-eye'></i> Hidden </span>";}
									 if($cat['Allow_Comment']==1){ echo"<span class='comment cat-span'> <i class='fa fa-close'></i> Comment Disabled </span>";}
									 if($cat['Allow_Ads']==1){ echo"<span class='adevertises cat-span'>  <i class='fa fa-close'></i> Ads Disabled </span>";}
								echo "</div>";

							echo "</div>";
							echo "<hr>";


						}
						?>
					</div>
			</div>
			<a class="btn btn-primary add-category" href="categories.php?do=Add"><i class="fa fa-plus"></i>Add New Category</a>
		</div>
		<?php

	   }else{
			echo '<div class="container">';
				echo '<div class="nice-message">There\'s No Category To Show </div>';
				echo '<a href ="categories.php?do=Add" class="btn btn-primary"><i class="fa fa-plus">Add New Category</i></a>';
			echo '</div>';
		 } 

		?>

<?php
	}elseif ($do=='Add'){?>


			<h1 class="text-center">Add New Category</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Insert" method="POST">
							<!-- Start Name Field -->

						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Name</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input type="text" name="name" class="form-control" autocomplete="off"  placeholder="Name Of The Category"  required="required"/>
						  </div>
						</div>
							<!-- End Name Field -->
							<!-- Start Description Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Description</label>
						 <div class="col-sm-10 col-md-4">
						  	<input type="text"name="description" class="form-control" placeholder="Descripte The Category" />
						 </div>
						</div>

							<!-- End Password Field -->	
							<!-- Start Ordering Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Ordering</label>
						  <div class="col-sm-10 col-md-4">
						  	<input type="text"name="ordering" class="form-control"   placeholder="Number To Arrange The Categories" />
						   </div>
						  </div>
							<!-- End  Ordering Field -->
							<!-- Start Visibility Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Visible</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<div>
						  		<input id="vis-yes" type="radio" name="visibility" value="0" checked />
						  		<label for="vis-yes">Yes</label>
						  	</div>
						  	<div>
						  		<input  id="vis-no" type="radio" name="visibility" value="1"  />
						  		<label for="vis-no">No</label>
						  	</div>
						 </div>
						</div>
						<!-- End Visibility Field -->
						<!-- Start Commenting Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Allow Commenting</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<div>
						  		<input id="com-yes" type="radio" name="commenting" value="0" checked />
						  		<label for="com-yes">Yes</label>
						  	</div>
						  	<div>
						  		<input  id="com-no" type="radio" name="commenting" value="1"  />
						  		<label for="com-no">No</label>
						  	</div>
						 </div>
						</div>
						<!-- End Commenting Field -->
						<!-- Start Ads Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Allow Ads</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<div>
						  		<input id="ads-yes" type="radio" name="ads" value="0" checked />
						  		<label for="ads-yes">Yes</label>
						  	</div>
						  	<div>
						  		<input  id="ads-no" type="radio" name="ads" value="1"  />
						  		<label for="ads-no">No</label>
						  	</div>
						 </div>
						</div>
						<!-- End Ads Field -->						
						<!-- Start Category Field -->

						<div class="form-group from-group-lg">
						 <div class="col-sm-offset-2 col-sm-10">
						  	<input type="submit"value="Add Category" class="btn btn-primary btn-lg">
						  </div>
						</div>
						<!-- End Category Field -->	
				    </form>
				</div>	

	<?php	

	}elseif($do == 'Insert'){ // Insert Category Page 

		if ($_SERVER['REQUEST_METHOD']=='POST') {
		echo "<h1 class='text-center'>Insert Category</h1>";
		echo "<div class='container'>";
		// Get Variables From The Form
			$name 	=$_POST['name'];
			$desc	=$_POST['description'];					
			$order	=$_POST['ordering'];
			$visible=$_POST['visibility'];
			$comment=$_POST['commenting'];
			$ads 	=$_POST['ads'];
		
			// Cherch If There's No Error Proceed The Update Operation
			// Call Functios In Page Functios To Conactions DataBase
			$check=checkItem("Name","categories",$name);
				if($check == 1)
				{

				$theMsg='<div class="alert alert-danger">'. 'Sorry This Category Is Exist '.'</div>';
				redirectHome($theMsg,'back');

				}else{
					// Insert Category Info In Database

			$stmt=$con->prepare("INSERT INTO 
			categories(Name,Description,Ordering ,Visibility,Allow_Comment,Allow_Ads)
			VALUES(:zname, :zdesc, :zorder, :zvisible, :zcomment, :zads)"); 

			$stmt->execute(array(

				'zname'		=>$name,
				'zdesc'		=>$desc,
				'zorder'	=>$order,
				'zvisible'	=>$visible,
				'zcomment'	=>$comment,
				'zads'		=>$ads
			));


			// Echo Success Message
			echo "<div class='container'>";

			$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Inserted</div>';
			redirectHome($theMsg,'back');	
			echo "</div'>";

			
					}


		}else{ 

			$theMsg='<div class="aler alert-danger">Sorry You Cant Browse This Page Directly'.'</div>';

			redirectHome($theMsg,'back');	

			}
	}elseif($do == 'Edit'){ 

	// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

		$catid = isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET['catid']) : 0;

		$stmt=$con->prepare("SELECT * FROM categories WHERE ID = ?");

	 	$stmt->execute(array($catid));

	 	$cat=$stmt->fetch();

	 	$count=$stmt->rowCount();


		if($stmt->rowCount()>0)	{
?>
			<h1 class="text-center">Edit New Category</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Update" method="POST">
							<!-- Start Name Field -->
							<input type="hidden" name="catid" value="<?php echo $catid;?>">
						<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Name</label>
						  <div class="col-sm-10 col-md-4">
						  	 <input type="text" name="name" class="form-control"   placeholder="Name Of The Category"  required="required" value="<?php echo $cat['Name'];?>" />
						  </div>
						</div>
							<!-- End Name Field -->
							<!-- Start Description Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Description</label>
						 <div class="col-sm-10 col-md-4">
						  	<input type="text"name="description" class="form-control" placeholder="Descripte The Category"  value="<?php echo $cat['Description'];?>"/>
						 </div>
						</div>

							<!-- End Password Field -->	
							<!-- Start Ordering Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Ordering</label>
						  <div class="col-sm-10 col-md-4">
						  	<input type="text"name="ordering" class="form-control"   placeholder="Number To Arrange The Categories" value="<?php echo $cat['Ordering'];?>"/>
						   </div>
						  </div>
							<!-- End  Ordering Field -->
							<!-- Start Visibility Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Visible</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<div>
						  		<input id="vis-yes" type="radio" name="visibility" 
						  		value="0"<?php if ($cat['Visibility'] == 0){ echo 'checked'; }?>  />
						  		<label for="vis-yes">Yes</label>
						  	</div>
						  	<div>
						  		<input  id="vis-no" type="radio" name="visibility" 
						  		value="1"<?php if ($cat['Visibility'] == 1){ echo'checked'; } ?>  />
						  		<label for="vis-no">No</label>
						  	</div>
						 </div>
						</div>
						<!-- End Visibility Field -->
						<!-- Start Commenting Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Allow Commenting</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<div>
						  		<input id="com-yes" type="radio" name="commenting" value="0" <?php if ($cat['Allow_Comment'] == 0){ echo'checked'; } ?>   />
						  		<label for="com-yes">Yes</label>
						  	</div>
						  	<div>
						  		<input  id="com-no" type="radio" name="commenting" value="1" <?php if ($cat['Allow_Comment'] == 1){ echo'checked'; } ?>  />
						  		<label for="com-no">No</label>
						  	</div>
						 </div>
						</div>
						<!-- End Commenting Field -->
						<!-- Start Ads Field -->

						<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label" >Allow Ads</label>
						 <div class="col-sm-10 col-md-4 ">
						  	<div>
						  		<input id="ads-yes" type="radio" name="ads" value="0"  <?php if ($cat['Allow_Ads'] == 0){ echo'checked'; }?> />
						  		<label for="ads-yes">Yes</label>
						  	</div>
						  	<div>
						  		<input  id="ads-no" type="radio" name="ads" value="1"  <?php if ($cat['Allow_Ads'] == 1){ echo'checked'; }?> />
						  		<label for="ads-no">No</label>
						  	</div>
						 </div>
						</div>
						<!-- End Ads Field -->						
						<!-- Start Category Field -->

						<div class="form-group from-group-lg">
						 <div class="col-sm-offset-2 col-sm-10">
						  	<input type="submit"value="Save" class="btn btn-primary btn-lg">
						  </div>
						</div>
						<!-- End Category Field -->	
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



	}elseif($do=='Update'){ 

				echo "<h1 class='text-center'>Update Category</h1>";
				echo "<div class='container'>";

				if ($_SERVER['REQUEST_METHOD']=='POST') {
					// Get Variables From The Form
					$id  	  =$_POST['catid'];
					$name 	  =$_POST['name'];
					$descripe =$_POST['description'];
					$ordering =$_POST['ordering'];
					$visib    =$_POST['visibility'];
					$comment  =$_POST['commenting'];
					$ads_s    =$_POST['ads'];


					// Cherch If There's No Error Proceed The Update Operation
					if(empty($formErrors)){
					// Update The Database With This Info
					$stmt=$con->prepare("UPDATE categories SET  Name= ? ,Description = ?,Ordering = ? ,Visibility = ? ,Allow_Comment = ?,Allow_Ads = ? WHERE ID = ? ");
					$stmt->execute(array($name,$descripe,$ordering,$visib,$comment,$ads_s,$id));

					// Echo Success Message
					$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Updated</div>';
					redirectHome($theMsg,'back');	
				   }

				}else{ 
				$theMsg="<div class='alert alert-danger'>Sorry You Can Browse This Page Directly</div>";
				redirectHome($theMsg,);
					}
					   echo "</div>";
				
	}elseif($do=='Delete'){
			echo "<h1 class='text-center'>Delete Category</h1>";
				echo "<div class='container'>";

			// Delete Members Page
			// Check If Get Request Userid Is Numeric & Get The Integer Value Of It 

		$catid = isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET['catid']) : 0;


		// Select All Data Depend On This ID From Functions
		$check=checkItem('ID','categories',$catid);
		if($check> 0){

			$stmt=$con->prepare("DELETE FROM categories WHERE ID = :zid");
			$stmt->bindParam(":zid",$catid);
			$stmt->execute();
			// Echo Success Message
			$theMsg= "<div Class='alert alert-success'>" . $stmt->rowCount().' Record Deleted</div>';
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
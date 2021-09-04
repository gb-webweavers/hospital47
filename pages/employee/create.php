<?php include '../../layout/head.php'; ?>
<?php include '../../layout/sidebar.php'; ?>
<?php include '../../layout/navbar.php'; ?>



<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
		    <div class="card-header py-3">
		        <h6 class="m-0 font-weight-bold text-primary">Create New Emp Type</h6>
		    </div>
		    <div class="card-body">
		        <form action="" method="POST" enctype="multipart/form-data">
		        	
		        	<div class="row">
		        		
		        		<div class="col-12 col-md-6">
		        			<div class="form-group">
		        				<label for="">First Name</label>
		        				<input type="text" class="form-control" name="firstName" required>
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-6">
		        			<div class="form-group">
		        				<label for="">Last Name</label>
		        				<input type="text" class="form-control" name="lastName" required>
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-6">
		        			<div class="form-group">
		        				<label for="">City</label>
		        				<input type="text" class="form-control" name="city" required>
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-6">
		        			<div class="form-group">
		        				<label for="">Mobile</label>
		        				<input type="text" class="form-control" name="mobile" required>
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-6 ">
		        			<div class="form-group">
		        				<label for="">Employee</label>
		        				<select name="empTypeId" class="form-control">
					        		<?php

					        			include '../../connection.php';

					        			$sql="SELECT * FROM empType";

					        			$exec=mysqli_query($con,$sql);

					        			while ($row=mysqli_fetch_array($exec)) {
					        				?>
					        				<option value="<?php echo $row['empTypeId'] ?>">
					        					<?php echo $row['empType'] ?>
					        				</option>
					        				<?php
					        			}

					        		?>
		        				</select>
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-6">
		        			<div class="form-group">
		        				<label for="">UserImage</label>
		        				<input type="file" name="fileToUpload" class="form-control" id="fileToUpload">
		        			</div>
		        		</div>

		        		<div class="col-12">
		        			<div class="form-group">
		        				<input type="checkbox" class="" id="mycheck" /> i want to create login for this employee
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-6 login">
		        			<div class="form-group">
		        				<label for="">User Name</label>
		        				<input type="text" class="form-control" name="userName" >
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-6 login">
		        			<div class="form-group">
		        				<label for="">Password</label>
		        				<input type="password" class="form-control" name="password" >
		        			</div>
		        		</div>

		        		


		        	</div>	

		        	

		        	<button type="submit" name="submit" class="btn btn-primary">Submit</button>

		        </form>
		    </div>
		</div>
	</div>
</div>



<?php include '../../layout/footer.php'; ?>
<?php include '../../layout/script.php'; ?>

<script>

		$(".login").hide()
    
        $('#mycheck').click(function(){
            if($(this).prop("checked") == true){
                $(".login").show()
            }
            else if($(this).prop("checked") == false){
                $(".login").hide()
                $(".login input").val("")
            }

        });
    
</script>




<?php

	if (isset($_POST['submit'])) {


		$target_dir = "../../img/";
		$rand=rand();
		$target_file = $target_dir . $rand.basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		
		  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		  if($check !== false) {
		    echo "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		  } else {
		    echo "File is not an image.";
		    $uploadOk = 0;
		  }
	

		// Check if file already exists
		if (file_exists($target_file)) {
		  echo "Sorry, file already exists.";
		  $uploadOk = 0;
		}

		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		  echo "Sorry, your file is too large.";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";


		    $firstName=$_POST['firstName'];
		    $lastName=$_POST['lastName'];
		    $city=$_POST['city'];
		    $mobile=$_POST['mobile'];
		    $empTypeId=$_POST['empTypeId'];
		    $image = htmlspecialchars( $rand.basename( $_FILES["fileToUpload"]["name"]));


		    include '../../connection.php';

		    $sql="INSERT INTO employees (FirstName,lastName,city,mobile,empImage,empTypeId)
		     VALUES('$firstName','$lastName','$city','$mobile','$image','$empTypeId')";

		    $exec=mysqli_query($con,$sql);


		    if ($exec) {

		    	$userName=$_POST['userName'];
		    	$password=$_POST['password'];
		    	$last_id = mysqli_insert_id($con);


		    	if ($userName!="" && $password!="" ) {
		    		$sql="INSERT INTO login (userName,password,empId) VALUES('$userName','$password','$last_id')";

		    		$exec=mysqli_query($con,$sql);

		    		if ($exec) {		    		
		    			?>
		    				<script>
		    					alert('login created');
		    				</script>
		    			<?php
		    		}
		    	}

		    	

		    	?>
		    		<script>
		    			alert('employee data created');
		    		</script>
		    	<?php
		    }
		    else{
		    	?>
		    		<script>
		    			alert('failed');
		    		</script>
		    	<?php
		    }



		  } else {
		    echo "Sorry, there was an error uploading your file.";
		  }
		}



		
	}



?>


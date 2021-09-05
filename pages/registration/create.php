<?php include '../../layout/head.php'; ?>
<?php include '../../layout/sidebar.php'; ?>
<?php include '../../layout/navbar.php'; ?>

<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
		    <div class="card-header py-3">
		        <h6 class="m-0 font-weight-bold text-primary">New Registration</h6>
		    </div>
		    <div class="card-body">
		        <form action="" method="POST" >
		        	
		        	<div class="row">

		        		<div class="col-12 col-md-6">
		        			<div class="form-group">
		        				<label for="">Reg Type</label>
		        				<select name="regtype" id="regType" class="form-control">
		        					<option value="new">new</option>
		        					<option value="exsisting">exsisting</option>
		        				</select>
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-6">
		        			<div class="form-group">
		        				<label for="">Date</label>
		        				<input type="text" class="form-control" disabled required value="<?php echo date("Y/m/d")  ?>">
		        			</div>
		        		</div>
		        		
		        		<div class="col-12 col-md-6 new-patient">
		        			<div class="form-group">
		        				<label for="">Name</label>
		        				<input type="text" class="form-control" name="name" >
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-3 new-patient">
		        			<div class="form-group">
		        				<label for="">Gender</label>
		        				<select name="gender" id="" class="form-control">
		        					<option value="male">male</option>
		        					<option value="female">female</option>
		        				</select>
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-3 new-patient">
		        			<div class="form-group">
		        				<label for="">NIC</label>
		        				<input type="text" class="form-control" name="nic" >
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-2 new-patient">
		        			<div class="form-group">
		        				<label for="">No</label>
		        				<input type="text" class="form-control" name="no" >
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-5 new-patient">
		        			<div class="form-group">
		        				<label for="">Street</label>
		        				<input type="text" class="form-control" name="street" >
		        			</div>
		        		</div>

		        		<div class="col-12 col-md-5 new-patient">
		        			<div class="form-group">
		        				<label for="">City</label>
		        				<input type="text" class="form-control" name="city" >
		        			</div>
		        		</div>

		        		<div class="col-12 old-patient ">
		        			<div class="form-group">
		        				<label for="">Patients</label>
		        				<select name="patientId" class="form-control" id="mySelect2">
					        		<?php

					        			include '../../connection.php';

					        			$sql="SELECT * FROM patients";

					        			$exec=mysqli_query($con,$sql);

					        			while ($row=mysqli_fetch_array($exec)) {
					        				?>
					        				<option value="<?php echo $row['patientId'] ?>">
					        					<?php echo $row['name'] ?> (<?php echo $row['nic'] ?>)
					        				</option>
					        				<?php
					        			}

					        		?>
		        				</select>
		        			</div>
		        		</div>

		        		<div class="col-12">
		        			<div class="form-group">
		        				<label for="">Reason</label>
		        				<textarea name="reason" class="form-control"cols="30" rows="5"></textarea>
		        			</div>
		        		</div>


		        		<div class="col-12">
		        			<div class="form-group">
		        				<label for="">Payment</label>
		        				<input type="text" name="payment" class="form-control">		        					
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

	$(".old-patient").hide();

	$("#regType").change(function(event) {
		var data = $(this).val()
		if (data=="exsisting") {
			$(".new-patient").hide();
			$(".old-patient").show();
		}
		else{
			$(".new-patient").show();
			$(".old-patient").hide();
		}
	});

	$('#mySelect2').select2({
	  selectOnClose: true
	});
		
    
</script>




<?php

	if (isset($_POST['submit'])) {

	  	$reason=$_POST['reason'];
	  	$payment=$_POST['payment'];
	  	$admissionDate=date("Y/m/d");
	  	$empId=$_SESSION['eid']; 

	  	$regtype=$_POST['regtype'];

	  	include '../../connection.php';

	  	  				
	  	echo "<h1>$regtype</h1>";

	  	if ($regtype=="new") {

	  		$name=$_POST['name'];
	  		$gender=$_POST['gender'];
	  		$nic=$_POST['nic'];
	  		$no=$_POST['no'];
	  		$street=$_POST['street'];
	  		$city=$_POST['city'];

	  		$sql="INSERT INTO patients (name,gender,nic,no,street,city) 
	  		VALUES('$name','$gender','$nic','$no','$street','$city')";

	  		$exec=mysqli_query($con,$sql);

	  		if ($exec) {
	  			?>
	  				<script>
	  					alert("Patient Created")
	  				</script>
	  			<?php

	  			$last_patient_id = mysqli_insert_id($con);

	  			$sql="INSERT INTO addmission (adimissionDate, reason, payment, employeeId, patientId)
	  			VALUES('$admissionDate','$reason','$payment','$empId','$last_patient_id') ";

	  			$exec=mysqli_query($con,$sql);

	  			if ($exec) {
	  				?>
		  				<script>
		  					alert("Admission Created")
		  				</script>
		  			<?php
	  			}


	  		}
	  		else{
	  			?>
	  				<script>
	  					alert("Patient Not Created")
	  				</script>
	  			<?php
	  		}


	  		
	  	}
	  	else{	  		
	  		  				

	  		$patientId=$_POST['patientId'];

  			$sql="INSERT INTO addmission (adimissionDate, reason, payment, employeeId, patientId)
  			VALUES('$admissionDate','$reason','$payment','$empId','$patientId') ";

  			$exec=mysqli_query($con,$sql);

  			if ($exec) {
  				?>
	  				<script>
	  					alert("Admission Created")
	  				</script>
	  			<?php
  			}
  			else{
  				?>
	  				<script>
	  					alert("Admission Created")
	  				</script>
	  			<?php
  			}






	  	}


		 

		
	}



?>


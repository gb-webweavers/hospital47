<?php include '../../layout/head.php'; ?>
<?php include '../../layout/sidebar.php'; ?>
<?php include '../../layout/navbar.php'; ?>

<?php
	
	if ($_SESSION['empType']!='admin') {
	    ?>
	        <script>
	            window.location.href="<?php echo $baseUrl; ?>dashboard.php";
	        </script>
	    <?php
	}

?>

<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
		    <div class="card-header py-3">
		        <h6 class="m-0 font-weight-bold text-primary">Create New Emp Type</h6>
		    </div>
		    <div class="card-body">
		        <form action="" method="POST">
		        	
		        	<div class="form-group">
		        		<label for="">Emp Type</label>
		        		<input type="text" class="form-control" name="empType" required>
		        	</div>

		        	<button type="submit" name="submit" class="btn btn-primary">Submit</button>

		        </form>
		    </div>
		</div>
	</div>
</div>



<?php include '../../layout/footer.php'; ?>
<?php include '../../layout/script.php'; ?>




<?php

	if (isset($_POST['submit'])) {

		$empType=$_POST['empType'];


		include '../../connection.php';

		$sql="INSERT INTO empType (empType) VALUES('$empType')";

		$exec=mysqli_query($con,$sql);


		if ($exec) {
			?>
				<script>
					alert('success');
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

		
	}



?>


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
		        
		    	<?php

		    		$id=$_GET['id'];

		    		include '../../connection.php';

		    		$sql="DELETE FROM empType WHERE empTypeId='$id'";

		    		$exec=mysqli_query($con,$sql);

		    		if ($exec) {
		    			?>
		    				<div class="row">
		    					<div class="col-12 bg-success text-center text-white">
		    						<h1 class="display-3">DATA DELETED</h1>
		    					</div>
		    				</div>
		    			<?php
		    		}
		    		else{
		    			?>
		    				<div class="row">
		    					<div class="col-12 bg-danger text-center text-white">
		    						<h1 class="display-3">DATA NOT DELETED</h1>
		    					</div>
		    				</div>
		    			<?php
		    		}

		    	?>

		    	<script>
		    		window.setTimeout(function() {
		    		    window.location.href = 'view.php';
		    		}, 5000);
		    	</script>

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


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
		<div class="card shadow mb-4" style="max-width: 800px;margin: 0 auto;">
		    <div class="card-header py-3">
		        <h6 class="m-0 font-weight-bold text-primary">View Emp Type</h6>
		    </div>
		    <div class="card-body">
		        <table class="table table-bordered" id="data_table">
		        	<thead>
			        	<tr class="bg-primary text-white">
			        		<th>Image</th>
			        		<th>Full Name</th>
			        		<th>City</th>
			        		<th>Mobile</th>
			        		<th>Utype</th>
			        	</tr>
		        	</thead>
		        	<tbody>
		        		<?php

		        			include '../../connection.php';

		        			$sql="SELECT * FROM employees e INNER JOIN emptype et ON e.empTypeId=et.empTypeId";

		        			$exec=mysqli_query($con,$sql);

		        			while ($row=mysqli_fetch_array($exec)) {
		        				?>
		        				<tr>
		        					<td>
		        						<img style="max-width: 80px" src="../../img/<?php echo $row['empImage']; ?>" alt="">
		        					</td>
		        					<td><?php echo $row['FirstName']." ".$row['lastName']; ?></td>
		        					<td><?php echo $row['city']; ?></td>
		        					<td>
		        						<a href="tel:<?php echo $row['mobile']; ?>"><?php echo $row['mobile']; ?></a>
		        					</td>

		        					<td><?php echo $row['empType']; ?></td>
		        					
		        				</tr>
		        				<?php
		        			}

		        		?>
		        	</tbody>
		        </table>
		    </div>
		</div>
	</div>
</div>



<?php include '../../layout/footer.php'; ?>
<?php include '../../layout/script.php'; ?>

<script>
	$(document).ready( function () {
	    $('#data_table').DataTable();
	} );

	function deleteMe(id){
		$.confirm({
		    title: 'Confirm!',
		    type: 'red',
		    content: 'Do you want to delete this?',
		    buttons: {

		    	somethingElse: {
		    	    text: 'Conform',
		    	    btnClass: 'btn-red',
		    	    keys: ['enter', 'shift'],
		    	    action: function(){
		    	        window.location.href="delete.php?id="+id;
		    	    }
		    	},		        
		        cancel: function () {		            
		        }
		        
		    }
		});
	}

</script>




<?php

	if (isset($_POST['submit'])) {

		$empType=$_POST['empType'];


		$con=mysqli_connect("localhost","root","","hospital");

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


<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                                    </div>                                   
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Enter Email Address..." required name="userName">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                placeholder="Password" name="password" required>
                                        </div>                                      
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        
                                        
                                    </form>
                                    <hr>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>


<?php

    if (isset($_POST['submit'])) {

        $userName=$_POST['userName'];
        $password=$_POST['password'];

        include 'connection.php';

        $sql="SELECT * FROM login l 
                INNER JOIN employees e ON l.empId=e.empId
                INNER JOIN emptype et ON et.empTypeId=e.empTypeId
                WHERE userName='$userName' AND password='$password'";

        $exec=mysqli_query($con,$sql);

        $count=mysqli_num_rows($exec);

        echo "<h1>$count</h1>";

        if ($count>0) {

            while ($row=mysqli_fetch_array($exec)) {
                $_SESSION['eid']=$row['empId'];
                $_SESSION['name']=$row['FirstName']." ".$row['lastName'];
                $_SESSION['image']=$row['empImage'];
                $_SESSION['empType']=$row['empType'];
            }

           ?>
            <script>
                window.location.href='dashboard.php';
            </script>
           <?php
        }
        else{
            ?>
              <script>
                  alert("Sorry, Wrong Username or Password");
              </script>
            <?php
        }
        
    }


?>
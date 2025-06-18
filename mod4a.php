<?php
// Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Module 4 - SQL Injection</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Module 4 - SQL Injection</a>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container">
            <div class="mt-5">
                <form method="post" action="">
                  <div class="mb-3">
                    <label for="idSqlInjection"
                      class="form-label">SQL to be injected</label>
                    <textarea class="form-control" id="idSqlInjection" rows="3"
                      name="sql"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>


            <!-- START YOUR SQL ASSIGNMENT -->
            <?php 
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql'])) {
			$SQL = $_POST['sql'];
			$servername = "localhost";
			$username = "student";
			$password = "student";
			$dbname = "employees";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if ($conn->connect_error){
				die("Connection failed: " . mysqli_connect_error());
			}
			echo "running query for $SQL<br>";
			$sql = "SELECT emp_no, salary FROM salaries WHERE emp_no = $SQL";
			$result = $conn->query($sql); 	
			

			if ($result->num_rows > 0){
				echo"<table><tr><th>EmpNo.</th><th style='padding-left:40px;'>Salary</th></tr>";
				while($row = $result->fetch_assoc()){
					echo "<tr><td>".$row["emp_no"]."</td><td style='padding-left:40px;'>".$row["salary"]."</td></tr>";
				}
				echo "</table>";
			} else {
				echo "0 results";
			}
			$conn->close();
		}
            ?>
            <!-- END YOUR SQL ASSIGNMENT -->
        </div>
    </body>
</html>

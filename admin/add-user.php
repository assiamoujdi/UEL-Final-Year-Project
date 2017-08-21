<!DOCTYPE html>
<html>
	<?php 
		include "../includes/header.php";
		include "../includes/admin-navbar.php";
	?>
<head>
	<title></title>
</head>
<body>
	<div id="wrapper">
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="container">
				    <h1>Add User</h1>
				  	<hr>
					<div class="row">
				      <div class="col-md-9 personal-info">
				        <h3>Account Information</h3>
				        
				        <form class="form-horizontal" role="form" method="post">
				          <div class="form-group">
				            <label class="col-lg-3 control-label">ID:</label>
				            <div class="col-lg-8">
				              <input class="form-control" type="text" id="id" name="id" required>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-lg-3 control-label">First name:</label>
				            <div class="col-lg-8">
				              <input class="form-control" type="text" id="name" name="name" required>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-lg-3 control-label">Surname:</label>
				            <div class="col-lg-8">
				              <input class="form-control" type="text" id="sname" name="sname" required>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-lg-3 control-label">Email:</label>
				            <div class="col-lg-8">
				              <input class="form-control" type="email" id="email" name="email" required>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-md-3 control-label">Username:</label>
				            <div class="col-md-8">
				              <input class="form-control" type="text" id="username" name="username" required>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-md-3 control-label">Password:</label>
				            <div class="col-md-8">
				              <input class="form-control" type="password" id="password" name="password" required>
				            </div>
				          </div>
		          		  <div class="form-group">
							 <label class="col-md-3 control-label" for="rank">Account Level:</label>
							 <div class="col-md-8">
			                  <select id="rank" class="form-group form-control" data-show-subtext="true" data-live-search="true" name="rank" style="margin-left: -1px;" required>
		                  		<option value="" selected disabled>-- SELECT --</option>
		                  		<option value="one">Student</option>
		                  		<option value="two">Lecturer</option>
		                  		<option value="three">Admin</option>
			               	  </select>
			               	  </div>
          				  </div>
          				  <div class="alert alert-info alert-dismissable">
				          	<a class="panel-close close" data-dismiss="alert">×</a> 
				          	<i class="fa fa-warning" style="color: red;"></i> If account level is <b>student</b>, choose a level of study. If account is admin or lecturer, ignore the selection box.
		          		  </div>
          				  <div class="form-group">
							 <label class="col-md-3 control-label" for="level">Student Study Level:</label>
							 <div class="col-md-8">
			                  <select id="level" class="form-group form-control" data-show-subtext="true" data-live-search="true" name="level" style="margin-left: -1px;">
		                  		<option value="" selected disabled>-- SELECT --</option>
		                  		<option value="3">Level 3 (Foundation)</option>
		                  		<option value="4">Level 4 (1st Year)</option>
		                  		<option value="5">Level 5 (2nd Year)</option>
		                  		<option value="6">Level 6 (3rd Year)</option>
			               	  </select>
			               	  </div>
          				  </div>
				          <div class="form-group">
				            <label class="col-md-3 control-label"></label>
				            <div class="col-md-8">
				              <input type="submit" name="submit" class="btn btn-primary" value="Add User">
				              <span></span>
				              <input type="reset" class="btn btn-default" value="Cancel" onclick="goBack()">
				            </div>
				          </div>
				        </form>
				      </div>
				  </div>
				</div>
				<hr>
			</div>
		</div>
	</div>
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script>
		function goBack() {
			window.location = 'view-users.php';
		}
	</script>
</body>
	
</html>

<?php 
	$conn = mysqli_connect("localhost","root","","project");
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	if(isset($_POST['submit'])) {

		$uid = mysqli_real_escape_string($conn, $_REQUEST['id']);
		$name1 = mysqli_real_escape_string($conn, $_REQUEST['name']);
		$sname1 = mysqli_real_escape_string($conn, $_REQUEST['sname']);
		$email1 = mysqli_real_escape_string($conn, $_REQUEST['email']);
		$username1 = mysqli_real_escape_string($conn, $_REQUEST['username']);
		$password1 = mysqli_real_escape_string($conn, $_REQUEST['password']);
		$rank1 = mysqli_real_escape_string($conn, $_REQUEST['rank']);
		$level1 = mysqli_real_escape_string($conn, $_REQUEST['level']);

		if($rank1 == 'one') {
			$query = "INSERT INTO users (id, name, surname, email, username, password, rank, level, supervisor, second_supervisor, modules) VALUES ('" . $uid . "', '" . $name1 . "', '" . $sname1 . "', '" . $email1 . "', '" . $username1 . "', '" . $password1 . "', 'student', '" . $level1 . "', '', '', '')";
		}

		if($rank1 == 'two') {
			$query = "INSERT INTO users (id, name, surname, email, username, password, rank, level, supervisor, second_supervisor, modules) VALUES ('" . $uid . "', '" . $name1 . "', '" . $sname1 . "', '" . $email1 . "', '" . $username1 . "', '" . $password1 . "', 'lecturer', '0', '', '', '')";
		}

		if($rank1 == 'three') {
			$query = "INSERT INTO users (id, name, surname, email, username, password, rank, level, supervisor, second_supervisor, modules) VALUES ('" . $uid . "', '" . $name1 . "', '" . $sname1 . "', '" . $email1 . "', '" . $username1 . "', '" . $password1 . "', 'admin', '0', '', '', '')";
		}

		$result= mysqli_query($conn, $query) or die(mysqli_error($conn));
		mysqli_close($conn);
		
		echo "<script>goBack();</script>";
	}
?>
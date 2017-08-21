<!DOCTYPE html>
<html>
	<?php 
		include "../includes/header.php";
		include "../includes/lecturer-navbar.php";
    	include "../db_handler.php";
	?>
<head>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/css/bootstrap-slider.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/bootstrap-slider.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
	<title></title>
</head>
<body>
	<div id="wrapper">
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="container">
				    <h1>Add Module</h1>
				  	<hr>
					<div class="row">
				      <div class="col-md-9 personal-info">
				        <h3>Module Information</h3>
				        <form class="form-horizontal" role="form" method="post">
				        <div class="form-group">
				            <label class="col-lg-3 control-label">Module Code:</label>
				            <div class="col-lg-8">
				              <input class="form-control" type="text" id="code" name="code">
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-lg-3 control-label">Module Name:</label>
				            <div class="col-lg-8">
				              <input class="form-control" type="text" id="name" name="name">
				            </div>
				          </div>
				          <div class="form-group">
							<label class="col-md-3 control-label" for="level">Module Level:</label>
							 <div class="col-md-8">
			                  <select id="rank" class="form-group form-control" data-show-subtext="true" data-live-search="true" name="level" style="margin-left: -1px;" required>
		                  	   <option value="" selected disabled>-- SELECT --</option>
		                  	   <option value="3">Level 3 (Foundation)</option>
		                  	   <option value="4">Level 4 (1st Year)</option>
		                  	   <option value="5">Level 5 (2nd Year)</option>
		                  	   <option value="6">Level 6 (3rd Year)</option>
			               	  </select>
		               	 	</div>
          				  </div>
          				  <div class="form-group">
				            <label class="col-lg-3 control-label">Module Leader:</label> 
				            <div class="col-lg-8">
							      <?php
									$query = "SELECT name, surname FROM users WHERE rank = 'lecturer' ORDER BY surname DESC";
									$result = mysqli_query($conn, $query);
								   ?>
									<select class="selectpicker" data-show-subtext="true" data-live-search="true" id="leader" name="leader">
										<option selected="selected" disabled>-- SELECT --</option>
										<?php 
										while ($row = mysqli_fetch_array($result))
										{
										    echo "<option value='$row[0]'>$row[0] $row[1]</option>";
										}
										?>        
									</select>
				          	</div>
				          </div>
				          <div class="form-group">
				            <label class="col-lg-3 control-label">Module Description:</label>
				            <div class="col-lg-8">
				              <textarea class="form-control" onkeyup="textCounter(this,'counter',250);" type="text" id="description" name="description" rows="5" required></textarea>
				              <input disabled maxlength="3" size="3" value="250" id="counter">
					      		<small>Characters remaining.</small>
					      		<script>
									function textCounter(field,field2,maxlimit)
									{
									 	var countfield = document.getElementById(field2);
									 	if ( field.value.length > maxlimit ) {
									  		field.value = field.value.substring( 0, maxlimit );
									  		return false;
									 	} else {
									  		countfield.value = maxlimit - field.value.length;
									 	}
									}
						  		</script>
			            	</div>
				          </div>
          				  <?php
			                $query = "SELECT name FROM assessment GROUP BY name";
			                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			                $choices = "";
			                while ($row = mysqli_fetch_array($result)) {
			                    $choices = $choices . "<option value='$row[0]'>Name: $row[0]</option>";
			                }
		            	  ?>
	                      <div class="form-group">
                        	<label class="col-lg-3 control-label">Add Assessment 1:</label>
                        	<div class="col-lg-8">
								<select class="form-control" name="assessment1" id="assessment1">
                            		<option selected="selected" disabled="">-- SELECT --</option>
                            		<?php
	                                	echo $choices;
	                                ?>
                            	</select>
                        	</div>
                		  </div>
  	                      <div class="form-group">
                        	<label class="col-lg-3 control-label">Add Assessment 2:</label>
                        	<div class="col-lg-8">
								<select class="form-control" name="assessment2" id="assessment2">
                            		<option selected="selected" disabled="">-- SELECT --</option>
                            		<option value="none">No 2nd Assessment</option>
	                                <?php
	                                	echo $choices;
	                                ?>
                            	</select>
                        	</div>
                		  </div>
                		  <div class="form-group">
                        	<label class="col-lg-3 control-label">Add Assessment 3:</label>
                        	<div class="col-lg-8">
								<select class="form-control" name="assessment3" id="assessment3">
                            		<option selected="selected" disabled="">-- SELECT --</option>
                            		<option value="none">No 3rd Assessment</option>
	                                <?php
	                                	echo $choices;
	                                ?>
                            	</select>
                        	</div>
                		  </div>
  				          <?php
			                $query = "SELECT name, surname FROM users WHERE rank = 'lecturer'";
			                $result = mysqli_query($conn, $query);
			                $options = "";
			                while ($row = mysqli_fetch_array($result)) {
			                    $options = $options . "<option value='$row[0]'>$row[0] $row[1]</option>";
			                }
		            	  ?>
		            	  <label class="col-lg-3 control-label"></label>
		            	  <div class="col-lg-8">
				        	  <div class="alert alert-info alert-dismissable">
					          	<i class="fa fa-warning"></i> <strong><u>NOTE:</u></strong> To select more than one option from the list, press the <strong>'Ctrl'</strong> button while selecting options in the selection boxes below.
				          	  </div>
			          	  </div>
			          	  <div class="form-group">
                        	<label class="col-lg-3 control-label">Lecturers Linked To Module:</label>
                        	<div class="col-lg-8">
                            	<select class="form-control" name="linked[]" multiple>
                            		<option>All Lecturers</option>
	                                <?php
	                                	echo $options;
	                                ?>
                            	</select>
                        	</div>
                		  </div>
			          	  <div class="form-group">
                        	<label class="col-lg-3 control-label">Lecturers Who Have Access To Students:</label>
                        	<div class="col-lg-8">
                            	<select class="form-control" name="lecturers[]" multiple>
                            		<option>All Lecturers</option>
	                                <?php
	                                	echo $options;
	                                ?>
                            	</select>
                        	</div>
                		  </div>
	                      <div class="form-group">
                        	<label class="col-lg-3 control-label">Lecturers Who Can Mark This Module:</label>
                        	<div class="col-lg-8">
                            	<select class="form-control" name="markers[]" multiple>
                            		<option>All Lecturers</option>
	                                <?php
	                                	echo $options;
	                                ?>
                            	</select>
                        	</div>
                		  </div>
                		  <div class="form-group">
				            <label class="col-lg-3 control-label">Engagement points:</label>
				            <div class="col-lg-8"> 
						      	<div class="input-group control-group after-add-more">
								   <input type="text" name="addmore[]" class="form-control" placeholder="Add Engagement Point">
									  <div class="input-group-btn"> 
										<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
									  </div>
							  	</div>
						        <div class="copy-fields hide">
						          <div class="control-group input-group" style="margin-top:10px">
						            <input type="text" name="addmore[]" class="form-control" placeholder="Add Engagement Point">
						            <div class="input-group-btn"> 
						              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
						            </div>
						          </div>
						        </div>
				          	</div>
				          </div>		          
				          <div class="form-group">
				            <label class="col-md-3 control-label"></label>
				            <div class="col-md-8">
				              <input type="submit" name="submit" class="btn btn-primary" value="Add Module">
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
			window.location.href = 'view-modules.php';
		}
	</script>
</body>
</html>

<style type="text/css">
	.entry:not(:first-of-type)
	{
	    margin-top: 10px;
	}
	.glyphicon
	{
	    font-size: 12px;
	}
	#counter {
	    padding: 2px;
	    border: 1px solid #eee;
	    font: 1em 'Trebuchet MS',verdana,sans-serif;
	    color: black;
	    border: none;
	}
	textarea {
    	resize: none;
	}
	.table-sortable tbody tr {
    	cursor: move;
	}
</style>

<script type="text/javascript">
	$(function(){
	   $('button#showit').on('click',function(){  
	      $('#myform').show();
	      $('#showit').hide();
	      $('#hideit').show();
	   });
	   $('button#hideit').on('click',function(){  
	      $('#myform').hide();
	      $('#showit').show();
	      $('#hideit').hide();
	   });
	});
</script>

<script type="text/javascript">
    $(document).ready(function() {
 
      $(".add-more").click(function(){ 
          var html = $(".copy-fields").html();
          $(".after-add-more").after(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
 
    });
</script>

<?php 
	if(isset($_POST['submit'])) {
		$id = mysqli_real_escape_string($conn, $_REQUEST['code']);
		$mname = mysqli_real_escape_string($conn, $_REQUEST['name']);
		$mlevel = mysqli_real_escape_string($conn, $_REQUEST['level']);
		$mleader = mysqli_real_escape_string($conn, $_REQUEST['leader']);
		$mdesc = mysqli_real_escape_string($conn, $_REQUEST['description']);
		// $mlinked = mysqli_real_escape_string($conn, $_REQUEST['linked']);
		$massess1 = mysqli_real_escape_string($conn, $_REQUEST['assessment1']);
		$massess2 = mysqli_real_escape_string($conn, $_REQUEST['assessment2']);
		$massess3 = mysqli_real_escape_string($conn, $_REQUEST['assessment3']);

		foreach ($_POST['lecturers'] as $mlecturers) {
			foreach ($_POST['markers'] as $mmarkers) {
				foreach ($_POST['addmore'] as $mpoints) {
					foreach ($_POST['linked'] as $mlinked) {
						$sql = "SELECT assessment_code FROM assessment WHERE name = '$massess1'";
						$res = mysqli_query($conn, $sql); // SAVES 'sql' QUERY RESULT
						$test = mysqli_fetch_array($res); // FETCHES THE DATA FROM THAT RESULT

						$assess1 = $test['assessment_code']; // SAVES THE ARRAY AS A STRING

						if ($massess2 == 'none' || $massess3 == 'none') {
							$query = "INSERT INTO module (module_code, module_name, module_leader, description, level, assessment1, assessment2, assessment3, lecturers_linked, access_students, markers, marking_scheme, engagement_points) VALUES ('" . $id . "', '" . $mname . "', '" . $mleader . "', '" . $mdesc . "', '" . $mlevel . "', '" . $assess1 . "', 'No 2nd Assessment', 'No 3rd Assessment', '" . $mlinked . "', '". $mlecturers . "', '" . $mmarkers . "', '" . "' '" . "', '" . $mpoints . "')";

							$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
						}

						else {
							$sql1 = "SELECT assessment_code FROM assessment WHERE name = '$massess2'";
							$res1 = mysqli_query($conn, $sql1); // SAVES 'sql' QUERY RESULT
							$test1 = mysqli_fetch_array($res1); // FETCHES THE DATA FROM THAT RESULT

							$assess2 = $test1['assessment_code']; // SAVES THE ARRAY AS A STRING

							$sql2 = "SELECT assessment_code FROM assessment WHERE name = '$massess3'";
							$res2 = mysqli_query($conn, $sql2); // SAVES 'sql' QUERY RESULT
							$test2 = mysqli_fetch_array($res2); // FETCHES THE DATA FROM THAT RESULT

							$assess3 = $test2['assessment_code']; // SAVES THE ARRAY AS A STRING

							$query = "INSERT INTO module (module_code, module_name, module_leader, description, level, assessment1, assessment2, assessment3, lecturers_linked, access_students, markers, marking_scheme, engagement_points) VALUES ('" . $id . "', '" . $mname . "', '" . $mleader . "', '" . $mdesc . "', '" . $mlevel . "', '" . $assess1 . "', '" . $assess2 . "','" . $assess3 . "', '" . $mlinked . "', '". $mlecturers . "', '" . $mmarkers . "', '" . "' '" . "', '" . $mpoints . "')";

							$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
						}
					}
				}
			}
		}
		mysqli_close($conn);
		echo '<script type="text/javascript">','goBack();','</script>';
	}
?>
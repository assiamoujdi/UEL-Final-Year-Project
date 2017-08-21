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
	<title></title>
</head>
<body>
	<?php 
	if (isset($_GET['id'])) {
		$module = mysqli_real_escape_string($conn, $_GET['id']);

		$sql = "SELECT * FROM module WHERE module_code = '$module'"; 
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	
        while($row = mysqli_fetch_array($result)) { 
        	$mcode = $row['module_code'];
        	$mname = $row['module_name'];
		}
	}
	?>
	<div id="wrapper">
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="container">
				    <h1>Add Assessment</h1>
			    	<?php 
						$sql = "SELECT assessment1, assessment2, assessment3 FROM module WHERE module_code = '$mcode'";

						$answer = mysqli_query($conn, $sql); // SAVES 'sql' QUERY RESULT
						$test = mysqli_fetch_array($answer); // FETCHES THE DATA FROM THAT RESULT

						$a1 = $test['assessment1']; // SAVES THE ARRAY AS A STRING
						$a2 = $test['assessment2']; // SAVES THE ARRAY AS A STRING
						$a3 = $test['assessment3']; // SAVES THE ARRAY AS A STRING

						$get = "SELECT DISTINCT weighs FROM assessment WHERE assessment_code = '$a1'";
						$recieve = "SELECT DISTINCT weighs FROM assessment WHERE assessment_code = '$a2'";
						$go = "SELECT DISTINCT weighs FROM assessment WHERE assessment_code = '$a3'";

						$got = mysqli_query($conn, $get);
						$recieved = mysqli_query($conn, $recieve);
						$stay = mysqli_query($conn, $go);

						$a1weight = "";
						$a2weight = "";
						$a3weight = "";

						while ($row1 = mysqli_fetch_array($got)) {
							$a1weight = $row1['weighs'];
						}

						while ($row2 = mysqli_fetch_array($recieved)) {
							$a2weight = $row2['weighs'];
						}

						while ($row3 = mysqli_fetch_array($stay)) {
							$a3weight = $row3['weighs'];
						}

						$totalWeight = 0;

						if ($a1weight == "" && $a2weight == "" && $a3weight == "") {
							echo "<b style='color: red;'>ALERT : </b>Current weight for Module " . $mcode . " - " . $mname . " is: 0% for Assessment 1, 0% for Assessment 2 and 0% for Assessment 3. Total weight: " . $totalWeight . "%";
						}
						else if ($a1weight == "" && $a2weight == "") {
							$totalWeight = $totalWeight + $a3weight;
							echo "<b style='color: red;'>ALERT : </b>Current weight for Module " . $mcode . " - " . $mname . " is: 0% for Assessment 1, 0% for Assessment 2 and " . $a3weight . "% for Assessment 3. Total weight: " . $totalWeight . "%";
						}
						else if ($a1weight == "" && $a3weight == "") {
							$totalWeight = $totalWeight + $a2weight;
							echo "<b style='color: red;'>ALERT : </b>Current weight for Module " . $mcode . " - " . $mname . " is: 0% for Assessment 1, ". $a2weight ."% for Assessment 2 and 0% for Assessment 3. Total weight: " . $totalWeight . "%";
						}
						else if ($a2weight == "" && $a3weight == "") {
							$totalWeight = $totalWeight + $a1weight;
							echo "<b style='color: red;'>ALERT : </b>Current weight for Module " . $mcode . " - " . $mname . " is: " . $a1weight . "% for Assessment 1, 0% for Assessment 2 and 0% for Assessment 3. Total weight: " . $totalWeight . "%";
						}
						else if ($a1weight == "") {
							$totalWeight = $totalWeight + $a2weight + $a3weight;
							echo "<b style='color: red;'>ALERT : </b>Current weight for Module " . $mcode . " - " . $mname . " is: 0% for Assessment 1, " . $a2weight . "% for Assessment 2 and " . $a3weight . "% for Assessment 3. Total weight: " . $totalWeight . "%";
						}
						else if ($a2weight == "") {
							$totalWeight = $totalWeight + $a1weight + $a3weight;
							echo "<b style='color: red;'>ALERT : </b>Current weight for Module " . $mcode . " - " . $mname . " is: " . $a1weight . "% for Assessment 1, 0% for Assessment 2 and " . $a3weight . "% for Assessment 3. Total weight: " . $totalWeight . "%";
						}
						else if ($a3weight == "") {
							$totalWeight = $totalWeight + $a1weight + $a2weight;
							echo "<b style='color: red;'>ALERT : </b>Current weight for Module " . $mcode . " - " . $mname . " is: " . $a1weight . "% for Assessment 1, " . $a2weight . "% for Assessment 2 and 0% for Assessment 3. Total weight: " . $totalWeight . "%";
						}
						else {
							$totalWeight = $totalWeight + $a1weight + $a2weight + $a3weight;
							echo "<b style='color: red;'>ALERT : </b>Current weight for Module " . $mcode . " - " . $mname . " is: " . $a1weight . "% for Assessment 1, " . $a2weight . "% for Assessment 2 and " . $a3weight . "% for Assessment 3. Total weight: " . $totalWeight . "%";
						}
					?>
				  	<hr>
					<div class="row">
				      <div class="col-md-9 personal-info">
				        <h3>Assessment Information</h3>
				        <?php 
					        if ($totalWeight == "100") {
								echo "<br><b style='color: red;'>IMPORTANT NOTICE: </b>The module selected already has assessments weighing 100%. Therefore <b style='color: red;'>no more can be added</b>.";
							}
				        	else if ($totalWeight != "100") {
				        		echo "<br><b style='color: red;'>IMPORTANT NOTICE: </b>The module selected can only weigh 100%. The remaining weight avaliable is: <b style='color: red;'>" . (100 - $totalWeight) . "%</b><br>.";
				        		?>
			        		<form class="form-horizontal" role="form" method="post">
					        <div class="form-group">
					            <label class="col-lg-3 control-label">Module Code:</label>
					            <div class="col-lg-8">
					              <input class="form-control" type="text" id="code" name="code" value="<?php if (isset($_GET['id'])) { print $mcode; }?>" readonly>
					            </div>
					          </div>
					          <div class="form-group">
					            <label class="col-lg-3 control-label">Module Name:</label>
					            <div class="col-lg-8">
					              <input class="form-control" type="text" id="name" name="name" value="<?php if (isset($_GET['id'])) { print $mname; }?>" readonly>
					            </div>
					          </div>
					          <div class="form-group">
					            <label class="col-lg-3 control-label">Assessment Code:</label>
					            <div class="col-lg-8">
					              <input class="form-control" type="text" id="acode" name="acode">
					            </div>
					          </div>
					          <div class="form-group">
								<label class="col-md-3 control-label" for="ascheme">Assessment Number:</label>
								 <div class="col-md-8">
				                  <select id="rank" class="form-group form-control" data-show-subtext="true" data-live-search="true" name="anumber" style="margin-left: -1px;" required>
			                  	   <option value="" selected disabled>-- SELECT --</option>
			                  	   <option value="1">1</option>
			                  	   <option value="2">2</option>
			                  	   <option value="3">3</option>
				               	  </select>
			               	 	</div>
	          				  </div>
	  				          <div class="form-group">
								<label class="col-md-3 control-label" for="aname">Assessment Name/Type:</label>
								 <div class="col-md-8">
				                  <input class="form-control" type="text" id="aname" name="aname">
				               	 </div>
	          				  </div>
	  				          <div class="form-group">
					            <label class="col-lg-3 control-label">Assessment Weight:</label>
					            <div class="col-lg-8">
					              <input class="form-control" type="number" id="aweight" name="aweight">
					            </div>
					          </div>
					          <div class="form-group">
								<label class="col-md-3 control-label" for="nmarks">Number Of Markers:</label>
								 <div class="col-md-8">
				                  <select id="rank" class="form-group form-control" data-show-subtext="true" data-live-search="true" name="nmarks" style="margin-left: -1px;" required>
			                  	   <option value="1">1</option>
			                  	   <option selected value="2">2</option>
			                  	   <option value="3">3</option>
				               	  </select>
				               	 </div>
	          				  </div>
	          				  <div class="form-group">
								<label class="col-md-3 control-label" for="ascheme">Marking Scheme:</label>
								 <div class="col-md-8">
				                  <select id="rank" class="form-group form-control" data-show-subtext="true" data-live-search="true" name="ascheme" style="margin-left: -1px;" required>
			                  	   <option value="" selected disabled>-- SELECT --</option>
			                  	   <option value="yes">Yes</option>
			                  	   <option value="no">No</option>
				               	  </select>
			               	 	</div>
	          				  </div>
					          <div class="form-group">
					            <label class="col-lg-3 control-label">Assessment Description:</label>
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
	                        	<label class="col-lg-3 control-label">Lecturers Who Can Mark This Assessment:</label>
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
					            <label class="col-lg-3 control-label">Sub-Assessments:</label>
					            <div class="col-lg-8">
									<button id="showit" class="btn btn-success" type="button">Add</button>
									<button id="hideit" class="btn btn-danger" type="button" style="display: none;">Cancel</button>
									<br>
									<br>
									<div class="container">
									    <div class="row clearfix" style="display: none;" id="myform">
											<div class="col-md-12 column">
												<table class="table table-bordered table-hover" id="tab_logic">
													<thead>
														<tr >
															<th class="text-center">#</th>
															<th class="text-center">Name</th>
															<th class="text-center">Description</th>
															<th class="text-center">Weight</th>
															<th class="text-center">Marking Scheme</th>
														</tr>
													</thead>
													<tbody>
														<tr id='addr0'>
															<td>1</td>
															<td>
																<input type="text" name='sname[]'  placeholder='Name' class="form-control"/>
															</td>
															<td>
																<input type="text" name='sdesc[]' placeholder='Description' class="form-control"/>
															</td>
															<td>
																<input type="number" name='sweight[]' placeholder='Weight' class="form-control"/>
															</td>
															<td>
																<select name="schoice[]" class="form-control">
																	<option selected="selected" disabled="">-- SELECT --</option>
																	<option value="Yes">Yes</option>
																	<option value="No (Single Marking)">No (Single Marking)</option>
																</select>
															</td>
														</tr>
									                    <tr id='addr1'></tr>
													</tbody>
												</table>
											</div>
											<a id="add_row" class="btn btn-success pull-left">Add Row</a><a id='delete_row' class="pull-right btn btn-danger">Delete Row</a>
										</div>
									</div>
								</div>
							  </div>		          
					          <div class="form-group">
					            <label class="col-md-3 control-label"></label>
					            <div class="col-md-8">
					              <input type="submit" name="submit" class="btn btn-primary" value="Add Assessment">
					              <span></span>
					              <input type="reset" class="btn btn-default" value="Cancel" onclick="goBack()">
					            </div>
					          </div>
					        </form>
				        		<?php
				        	}
				        ?>
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
			window.location.href = 'view-assessments.php';
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
     $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='sname[]"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='sdesc[]"+i+"' type='text' placeholder='Description'  class='form-control input-md'></td><td><input  name='sweight[]"+i+"' type='text' placeholder='Weight'  class='form-control input-md'></td><td><select name='schoice[]' class='form-control'><option selected='selected' disabled=''>-- SELECT --</option><option value='Yes'>Yes</option><option value='No (Single Marking)'>No (Single Marking)</option></select></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
	  });
	     $("#delete_row").click(function(){
	    	 if(i>1){
			 $("#addr"+(i-1)).html('');
			 i--;
			 }
		 });

	});
</script>

<?php 
	if(isset($_POST['submit'])) {
		$id = mysqli_real_escape_string($conn, $_REQUEST['acode']);
		$aname1 = mysqli_real_escape_string($conn, $_REQUEST['aname']);
		$aweight1 = mysqli_real_escape_string($conn, $_REQUEST['aweight']);
		$adesc = mysqli_real_escape_string($conn, $_REQUEST['description']);
		$anmarkers = mysqli_real_escape_string($conn, $_REQUEST['nmarks']);
		$amscheme = mysqli_real_escape_string($conn, $_REQUEST['ascheme']);
		$anumber1 = mysqli_real_escape_string($conn, $_REQUEST['anumber']);

		$remainingWeight = 100 - $totalWeight;

		if ($aweight1 <= $remainingWeight) {
			$totalMarks = 0;

			if(isset($_POST['sweight'])) {
				foreach ($_POST['sweight'] as $key => $value) {
					$scweight = $_POST['sweight'][$key];

					$totalMarks = $totalMarks + $scweight;
				}
			}

			foreach ($_POST['lecturers'] as $amarkers) {
				if (isset($_POST['sname']) && isset($_POST['sdesc']) && isset($_POST['sweight']) && isset($_POST['schoice'])) {
					if ($totalMarks == '100') {
						foreach ($_POST['sname'] as $key => $value) {
							$asdname = $_POST['sname'][$key];
							$asdesc = $_POST['sdesc'][$key];
							$asweight = $_POST['sweight'][$key];
							$asmarking = $_POST['schoice'][$key];

							$query = "INSERT INTO assessment (assessment_code, name, number_markers, marking_scheme, weighs, description, markers, sub_assessment, sub_assessment_description, sub_assessment_weight, sub_assessment_marking_scheme) VALUES ('" . $id . "', '" . $aname1 . "', '" . $anmarkers . "', '" . $amscheme . "', '" . $aweight1 . "%', '" . $adesc . "', '" . $amarkers . "','" . $asdname . "', '" . $asdesc . "', '" . $asweight . "', '" . $asmarking . "')";

							$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
						}
					}

					else if ($totalMarks > '100') {
						$emessageL = "Sub assessments to large. Make sure the weight is 100%. Current weight: " . $totalMarks;

						echo "<script type='text/javascript'>alert('$emessageL');history.go(-1);</script>";
					}

					else if ($totalMarks < '100') {
						$emessageS = "Sub assessments to small. Make sure the weight is 100%. Current weight: " . $totalMarks;

						echo "<script type='text/javascript'>alert('$emessageS');history.go(-1);</script>";
					}
				}

				else {
					$query = "INSERT INTO assessment (assessment_code, name, number_markers, marking_scheme, weighs, description, markers, sub_assessment, sub_assessment_description, sub_assessment_weight, sub_assessment_marking_scheme) VALUES ('" . $id . "', '" . $aname1 . "', '" . $anmarkers . "', '" . $amscheme . "', '" . $aweight1 . "', '" . $adesc . "', '" . $amarkers . "',' ', ' ', ' ', ' ')";

					$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
				}

				$search = "SELECT assessment_code FROM assessment WHERE name = '$aname1'";
				$res = mysqli_query($conn, $search); // SAVES 'sql' QUERY RESULT
				$test = mysqli_fetch_array($res); // FETCHES THE DATA FROM THAT RESULT

				$acode = $test['assessment_code']; // SAVES THE ARRAY AS A STRING

				if ($anumber1 == '1') {
					$sql = "UPDATE module SET assessment1 = '$acode' WHERE module_code = '$mcode'";		
				}		

				if ($anumber1 == '2') {
					$sql = "UPDATE module SET assessment2 = '$acode' WHERE module_code = '$mcode'";		
				}

				if ($anumber1 == '3') {
					$sql = "UPDATE module SET assessment3 = '$acode' WHERE module_code = '$mcode'";		
				}

				$result1 = mysqli_query($conn, $sql) or die(mysqli_error($conn));	
			}

			mysqli_close($conn);
			echo '<script type="text/javascript">','goBack();','</script>';
		}

		else {
			mysqli_close($conn);
			
			$emessageT = "The size of the assessment you enetered is invalid. Must be: " . $remainingWeight . "% or less." ;

			echo "<script type='text/javascript'>alert('$emessageT');history.go(-1);</script>";
		}
	}
?>
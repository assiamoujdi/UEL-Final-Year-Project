<!DOCTYPE html>
<html>
    <?php 
        include "../includes/header.php";
        include "../includes/lecturer-navbar.php";
        include "../db_handler.php";
    ?>
    <?php 
        if (isset($_GET['id'])) {
            $ms = mysqli_real_escape_string($conn, $_GET['id']);

            $sql = "SELECT * FROM marking_scheme WHERE module_code = '$ms'"; 
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
            while($row = mysqli_fetch_array($result)) { 
                $mc = $row['module_code'];
                $mn = $row['module_name'];
                $ac = $row['assessment_code'];
                $tm = $row['total_marks'];
                $an = $row['area_name'];
                $mq = $row['questions'];
                $ma = $row['marks_avaliable'];
            }

            $query = "SELECT sub_assessment FROM assessment WHERE assessment_code = '$ac'";

            $res = mysqli_query($conn, $query); // SAVES 'sql' QUERY RESULT
            $test = mysqli_fetch_array($res); // FETCHES THE DATA FROM THAT RESULT

            $acn = $test['sub_assessment']; // SAVES THE ARRAY AS A STRING
        }
    ?>
<head>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <title></title>
</head>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="container">
                    <h2 class="test">Marking Scheme For <?php echo $mc . " " . $mn . ": " . $acn ?></h2>
                    <hr>
                <form class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                    <label class="col-lg-3 control-label">Student ID & Name:</label> 
                    <div class="col-lg-8">
                      <?php
                        $query = "SELECT id, name, surname FROM users WHERE rank = 'student' ORDER BY surname DESC";
                        $result = mysqli_query($conn, $query);
                       ?>
                        <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="student" name="student">
                            <option selected="selected" disabled>-- SELECT --</option>
                            <?php 
                            while ($row = mysqli_fetch_array($result))
                            {
                                echo "<option value='$row[0]'>$row[0] - $row[1] $row[2]</option>";
                            }
                        ?>        
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Marker ID & Name:</label> 
                        <div class="col-lg-8">
                          <?php
                            $query = "SELECT id, name, surname FROM users WHERE rank = 'lecturer' ORDER BY surname DESC";
                            $result = mysqli_query($conn, $query);
                           ?>
                            <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="marker" name="marker">
                                <option selected="selected" disabled>-- SELECT --</option>
                                <?php 
                                while ($row = mysqli_fetch_array($result))
                                {
                                    echo "<option value='$row[0]'>$row[0] - $row[1] $row[2]</option>";
                                }
                            ?>        
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-3 control-label">Marking Table:</label> 
                        <div class="col-lg-8">
                        <table class="table table-bordered">
                            <tr>
                                <th>Area Name</th>
                                <th>Questions</th>
                                <th>Marks Avaliable</th>
                                <th>Mark Given</th>
                            </tr>                   
                                <?php
                                    $sql = "SELECT * FROM marking_scheme WHERE module_name = '$mn'"; 
                                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                                    $output = '';
                                    if(mysqli_num_rows($result) > 0)
                                    {

                                     while($row = mysqli_fetch_array($result))
                                     {
                                        
                                      $output .= '
                                       <tr>
                                            <td>'.$row["area_name"].'</td>
                                            <td>'.$row["questions"].'</td>
                                            <td>'.$row["marks_avaliable"].'</td>
                                            <td>
                                                <input type="text" id="place" class="markissued" name="markgiven" placeholder="Mark">
                                            </td>
                                      </tr>';
                                     }
                                     echo $output;
                                    }
                                ?>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align: center; font-weight: bold; color: red;">Total:</td>
                                <td>
                                    <input type="text" name="totalmarks" placeholder="Total Marks" id="totalmarks" readonly style="border-style: groove; border-color: black; text-align: center;">
                                </td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-3 control-label">Feedback:</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" onkeyup="textCounter(this,'counter',250);" type="text" id="feedback" name="feedback" rows="5" placeholder="Enter feedback/comments" required></textarea>
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
                <div class="form-group">
                <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input type="submit" name="submit" class="btn btn-primary" id="button1" value="Add Mark">
                      <span></span>
                      <input type="reset" class="btn btn-default" value="Cancel" id="button2" onclick="goBack()">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<style type="text/css">
    input {
        width: 100%;
        height: 30px;
        resize: none;
        margin: 4px;
    }
    th {
        text-align: center;
    }
    textarea {
        resize: none;
        width: 100%;
        height: 150px;
    }
    #place { 
        text-align: center;
    }
    #button1, #button2 {
        width: auto;
        height: auto;
    }
    #counter {
        padding: 2px;
        border: 1px solid #eee;
        font: 1em 'Trebuchet MS',verdana,sans-serif;
        color: black;
        border: none;
        height: auto;
        width: auto;
    }
</style>

<script type="text/javascript">
    function goBack() {
        window.location.href = 'view-marking-schemes.php';
    }
</script>

<script type="text/javascript">
    $(document).on('change', '.markissued', function() {
        var ntotal = 0;
        $('.markissued').each(function(){
            ntotal += parseFloat($(this).val());
        });
        document.getElementById("totalmarks").value = ntotal;
    });
</script>

<?php 
    if(isset($_POST['submit'])) {
        $id = mysqli_insert_id($conn);
        $comments = mysqli_real_escape_string($conn, $_REQUEST['feedback']);
        $markGiven = mysqli_real_escape_string($conn, $_REQUEST['totalmarks']);
        $student = mysqli_real_escape_string($conn, $_REQUEST['student']);

        $marksg = mysqli_real_escape_string($conn, $_REQUEST['markgiven']);
        $marksa = $row['marks_avaliable'];

        if ($marksg > $marksa) {
            $emessageM = "Marks given can not be larger than marks avaliable. Please check all given marks.";
            echo "<script type='text/javascript'>alert('$emessageM');history.go(-1);</script>";
        }

        else {
            $aquery = "SELECT assessment_code FROM assessment WHERE sub_assessment = '$acn'"; // FINDS THE ASSESSMENT CODE BASED ON THE ASSESSMENT CHOSEN IN THE SELECTION LIST ABOVE

            $testing = mysqli_query($conn, $aquery); // SAVES 'sql' QUERY RESULT
            $atest = mysqli_fetch_array($testing); // FETCHES THE DATA FROM THAT RESULT

            $acode = $atest['assessment_code']; // SAVES THE ARRAY AS A STRING
            
            $get = "SELECT mark1, mark2, mark3, final_mark, sub_assessment, feedback FROM marks WHERE student_id = '$student' AND module_code = '$mc'";
            $res = mysqli_query($conn, $get);
            $given = mysqli_fetch_array($res);

            $mark1 = $given['mark1'];
            $mark2 = $given['mark2'];
            $mark3 = $given['mark3'];
            $final = $given['final_mark'];
            $subadb = $given['sub_assessment'];
            $feedback = $given['feedback'];
            $feedbackOverall = $feedback . $comments;

            if ($subadb == $acn) {
                if ($mark1 == 0) {
                    $query = "INSERT INTO marks (mark_id, module_code, assessment_code, sub_assessment, student_id, mark1, mark2, mark3, final_mark, engagement, feedback) VALUES ('" . $id . "', '" . $mc . "', '" . $acode . "', '" . $acn . "', '" . $student . "', '" . $markGiven . "', '0', '0', '" . $markGiven . "', '', '" . $comments . "')";
                }

                else if ($mark1 != 0) {
                    if ($mark2 != 0) {
                        $markCheck = $mark1 - $mark2;

                        if ($markCheck >= 10 || $mark1 < 40 || $mark2 < 40) {
                            $query = "UPDATE marks SET mark3 = '$markGiven', final_mark = '$markGiven', feedback = '$feedbackOverall' WHERE student_id = '$student' AND module_code = '$mc'";
                        }

                        else { 
                            $emessageS = "3rd Marking is not needed for this student.";
                            echo "<script type='text/javascript'>alert('$emessageS');goBack();</script>";
                        }
                    }

                    else {
                        $finalMark = $mark1 + $markGiven;
                            $query = "UPDATE marks SET mark2 = '$markGiven', final_mark = '$finalMark', feedback = '$feedbackOverall' WHERE student_id = '$student' AND module_code = '$mc'";
                    }
                }       
            }   

            else if ($subadb != $acn) {
                $query = "INSERT INTO marks (mark_id, module_code, assessment_code, sub_assessment, student_id, mark1, mark2, mark3, final_mark, engagement, feedback) VALUES ('" . $id . "', '" . $mc . "', '" . $acode . "', '" . $acn . "', '" . $student . "', '" . $markGiven . "', '0', '0', '" . $markGiven . "', '', '" . $comments . "')";
            } 
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            mysqli_close($conn);
            echo "<script>goBack();</script>";      
        }
    }
?>
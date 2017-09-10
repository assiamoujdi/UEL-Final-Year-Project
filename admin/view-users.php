<?php
include "../db_handler.php"; 
 
$message = "";
if (isset($_POST['submit'])) {
    $allowed = array('csv');
    $filename = $_FILES['file']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        $message = 'Invalid file type or no file uploaded, please use .CSV file!';
    } else {
 
        move_uploaded_file($_FILES["file"]["tmp_name"], "" . $_FILES['file']['name']);
        $file = "" . $_FILES['file']['name'];
 
        $query = <<<eof
        LOAD DATA LOCAL INFILE '$file'
         INTO TABLE users
         FIELDS TERMINATED BY ','
         LINES TERMINATED BY '\n'

        (id,name,surname,email,username,password,rank,level)
eof;
        if (!$result = mysqli_query($conn, $query)) {
            exit(mysqli_error($con));
        }
        $message = "CSV file successfully imported!";
    }
}
 
$users = '<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>name</th>
    <th>surname</th>
    <th>email</th>
    <th>username</th>
    <th>password</th>
    <th>rank</th>
    <th>level</th>
    <th>supervisor</th>
    <th>second_supervisor</th>
    <th>modules</th>
</tr>
';

$query = "SELECT * FROM users";
if (!$result = mysqli_query($conn, $query)) {
    exit(mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    $number = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $users .= '<tr>
            <td>' . $number . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['surname'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['username'] . '</td>
            <td>' . $row['password'] . '</td>
            <td>' . $row['rank'] . '</td>
        </tr>';
        $number++;
    }
} else {
    $users .= '<tr>
        <td colspan="4">Records not found!</td>
        </tr>';
}
$users .= '</table>';
?>

<!DOCTYPE html>
<html>
	<?php 
		include "../includes/header.php";
		include "../includes/admin-navbar.php";
	?>
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/css/bootstrap-slider.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/bootstrap-slider.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <title></title>
</head>
<body>
<div class="container">
    <div class="row">
        <form class="form-horizontal" style="float: right;" action="view-users.php" method="post" name="export" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <input type="submit" name="export" class="btn btn-success" value="Export As CSV File"/>
            </div>
          </div>                    
        </form> 
    	<h1>List Of Users</h1>
    	<hr>
            <div class="row">
        <div class="col-md-6 col-md-offset-0">
            <form enctype="multipart/form-data" method="post" action="view-users.php">
                <div class="form-group">
                    <label for="file">Add users through a .CSV file</label>
                    <input name="file" type="file" class="form-control">
                </div>
                <div class="form-group">
                    <?php echo $message; ?>
                </div>
                <div class="pull-right" style="margin-top: -50px; margin-right: -85px;">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
        <div class="panel panel-primary filterable" style="border-color: #00bdaa;">
            <div class="panel-heading" style="background-color: #00bdaa;">
                <h3 class="panel-title">Users</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter Search</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Surname" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Email" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Username" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Rank" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Edit/Delete User" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $output = '';
                        if(isset($_POST["query"]))
                        {
                         $search = mysqli_real_escape_string($conn, $_POST["query"]);
                         $query = "
                          SELECT * FROM users 
                          WHERE name LIKE '%".$search."%'
                          OR surname LIKE '%".$search."%' 
                          OR email LIKE '%".$search."%' 
                          OR username LIKE '%".$search."%' 
                         ";
                        }
                        else
                        {
                         $query = "SELECT * FROM users ORDER BY name asc";
                        }
                            $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0)
                        {

                         while($row = mysqli_fetch_array($result))
                         {
                        $username = $row["username"];
                            
                          $output .= '
                           <tr>
                            <td>'.$row["name"].'</td>
                            <td>'.$row["surname"].'</td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["username"].'</td>
                            <td>'.$row["rank"].'</td>

                          <td class="text-center">
                          <a class="btn-edit btn btn-info btn-xs" href="edit-user.php?id=' . $username . '">
                          <span class=" glyphicon glyphicon-edit"></span> Edit</a>
                           <a href="remove-user.php?id=' . $username . '"class="btn-remove btn btn-danger btn-xs">
                           <span class="glyphicon glyphicon-remove"></span>Delete</a></td>
                           </tr>
                        </div>
                          ';
                         }
                         echo $output;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<style type="text/css">
    .filterable {
    margin-top: 15px;
    }
    .filterable .panel-heading .pull-right {
        margin-top: -20px;
    }
    .filterable .filters input[disabled] {
        background-color: transparent;
        border: none;
        cursor: auto;
        box-shadow: none;
        padding: 0;
        height: auto;
    }
    .filterable .filters input[disabled]::-webkit-input-placeholder {
        color: #333;
    }
    .filterable .filters input[disabled]::-moz-placeholder {
        color: #333;
    }
    .filterable .filters input[disabled]:-ms-input-placeholder {
        color: #333;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $('.filterable .btn-filter').click(function(){
            var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e){
            var code = e.keyCode || e.which;
            if (code == '9') return;
            
            var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');

            var $filteredRows = $rows.filter(function(){
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });

            $table.find('tbody .no-result').remove();

            $rows.show();
            $filteredRows.hide();

            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
            }
        });
    });
</script>

<?php 
   if(isset($_POST["export"])){
     
      $result = "SELECT * FROM users";
      $row = mysqli_query($conn, $result) or die(mysqli_error($conn));

      $fp = fopen('../spreadsheets/users.csv', 'w');

      while($val = mysqli_fetch_array($row, MYSQLI_ASSOC)){
          fputcsv($fp, $val);
      }
      fclose($fp); 
    }  
?>
<?php

session_start();
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
{
	header('location:index.php');
}

require_once 'includes/config.php';
$sql = "SELECT * from overdue";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$table = '
<table class="table">
<tr>
<th>Sr No</th>
<th>Student Name</th>
<th>Student ID</th>
<th>Phone Number</th>
<th>Fine</th>
</tr>
<tr>';
$cnt=1;
$totalcredit=0;
if($query->rowCount() > 0)
{
	foreach($results as $result)
	{
		$table .= '<tr>
		<td><center>'.$cnt.'</center></td>
		<td><center>'.$result->StudentName.'</center></td>
		<td><center>'.$result->StudentID.'</center></td>
		<td><center>'.$result->MobNumber.'</center></td>
		<td><center>'.$result->Fine.'</center></td>
		</tr>';
		$cnt+=1;
		$totalcredit+=$result->Fine;
	}
}
$table .= '
</tr>
</table>
<div align="right">Total Credit:'.$totalcredit.'</div>
<br>
<button onClick="window.print()">Print this page</button>
';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Simple Library Management System | Add Book</title>
	<?php include('includes/header-styles.php');?>
</head>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php include('includes/header.php');
			include('bgwork.php');?>
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Overdue Reports</h3>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row" style="display: block;">
						<div class="col-md-12 col-sm-12  ">
							<div class="x_panel">
								<div class="x_title">
									<h2>View Reports</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a class="dropdown-item" href="#">Settings 1</a>
												<a class="dropdown-item" href="#">Settings 2</a>
											</div>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<?php echo $table; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- footer content -->
			<footer>
				<div class="pull-right">
					Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
				</div>
				<div class="clearfix"></div>
			</footer>
		</div>
	</div>
	<!-- /footer content -->
	<?php include('includes/footer-scripts.php');?>
</body>
</html>
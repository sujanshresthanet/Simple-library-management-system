<?php

session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
	header('location:index.php');
}

require_once 'includes/config.php';

$sql = "SELECT tblstudents.FullName,tblbooks.BookName,tblbooks.ISBNNumber,tblbooks.id,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId order by tblissuedbookdetails.id desc";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$table = '
<table class="table">
<thead>
<tr>
<th>Student Name</th>
<th>Book Name</th>
<th>Book ID</th>
<th>ISBN Number</th>
<th>Issued Date</th>
<th>Return Date</th>
</tr>
</thead>

<tr>';
$cnt=1;
if($query->rowCount() > 0)
{
	foreach($results as $result)
	{
		$table .= '<tr>
		<td><center>'.$result->FullName.'</center></td>
		<td><center>'.$result->BookName.'</center></td>
		<td><center>'.$result->id.'</center></td>
		<td><center>'.$result->ISBNNumber.'</center></td>
		<td><center>'.$result->IssuesDate.'</center></td>
		<td><center>'.$result->ReturnDate.'</center></td>
		</tr>';
	}
}
$table .= '
</tr>
</table>
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
							<h3>User Reports</h3>
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="row" style="display: block;">
						<div class="col-md-12 col-sm-12  ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Reports</h2>
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






















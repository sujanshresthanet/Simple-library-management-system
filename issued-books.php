<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{
  header('location:index.php');
}
else{
  if(isset($_GET['del']))
  {
    $id=$_GET['del'];
    $sql = "delete from tblbooks  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();
    $_SESSION['delmsg']="Category deleted scuccessfully ";
    header('location:manage-books.php');
  }
  ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Library Management System | Manage Issued Books</title>
    <?php include('includes/header-styles.php');?>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include('includes/header.php');
        include('bgwork.php');?>
        <div class="right_col" role="main">
          <div class="row">
            <div class="col-md-12">
              <h4 class="header-line">Manage Issued Books</h4>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Issued Books Listings</h2>
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
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Book Name</th>
                              <th>ISBN </th>
                              <th>Issued Date</th>
                              <th>Return Date</th>
                              <th>Fine in(Rs)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sid=$_SESSION['stdid'];
                            $sql="SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
                            $query = $dbh -> prepare($sql);
                            $query-> bindParam(':sid', $sid, PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                              foreach($results as $result)
                                {               ?>
                                  <tr class="odd gradeX">
                                    <td class="center"><?php echo htmlentities($cnt);?></td>
                                    <td class="center"><?php echo htmlentities($result->BookName);?></td>
                                    <td class="center"><?php echo htmlentities($result->ISBNNumber);?></td>
                                    <td class="center"><?php echo htmlentities($result->IssuesDate);?></td>
                                    <td class="center"><?php if($result->ReturnDate=="")
                                    {?>
                                      <span style="color:red">
                                        <?php   echo htmlentities("Not Return Yet"); ?>
                                      </span>
                                    <?php } else {
                                      echo htmlentities($result->ReturnDate);
                                    }
                                    ?></td>
                                    <td class="center"><?php echo htmlentities($result->fine);?></td>
                                  </tr>
                                  <?php $cnt=$cnt+1;}} ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <!--End Advanced Tables -->
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
            <!-- /footer content -->
            <?php include('includes/footer-scripts.php');?>
          </body>
          </html>
          <?php } ?>
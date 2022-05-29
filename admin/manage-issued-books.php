<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){
  header('location:index.php');
} else {
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
          <div class="row">
            <?php if($_SESSION['error']!="")
            {?>
              <div class="col-md-12">
                <div class="alert alert-danger" >
                  <strong>Error :</strong>
                  <?php echo htmlentities($_SESSION['error']);?>
                  <?php echo htmlentities($_SESSION['error']="");?>
                </div>
              </div>
            <?php } ?>
            <?php if($_SESSION['msg']!="")
            {?>
              <div class="col-md-12">
                <div class="alert alert-success" >
                  <strong>Success :</strong>
                  <?php echo htmlentities($_SESSION['msg']);?>
                  <?php echo htmlentities($_SESSION['msg']="");?>
                </div>
              </div>
            <?php } ?>
            <?php if($_SESSION['delmsg']!="")
            {?>
              <div class="col-md-12">
                <div class="alert alert-success" >
                  <strong>Success :</strong>
                  <?php echo htmlentities($_SESSION['delmsg']);?>
                  <?php echo htmlentities($_SESSION['delmsg']="");?>
                </div>
              </div>
            <?php } ?>
          </div>
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
                    <div class="col-md-12">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          Issued Books
                        </div>
                        <div class="panel-body">
                          <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Student Name</th>
                                  <th>Book Name</th>
                                  <th>Book ID</th>
                                  <th>ISBN </th>
                                  <th>Issued Date</th>
                                  <th>Return Date</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $sql = "SELECT tblstudents.FullName,tblbooks.BookName,tblbooks.ISBNNumber,tblbooks.id,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId order by tblissuedbookdetails.id desc";
                                $query = $dbh -> prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                  foreach($results as $result)
                                    {               ?>
                                      <tr class="odd gradeX">
                                        <td class="center"><?php echo htmlentities($cnt);?></td>
                                        <td class="center"><?php echo htmlentities($result->FullName);?></td>
                                        <td class="center"><?php echo htmlentities($result->BookName);?></td>
                                        <td class="center"><?php echo htmlentities($result->id);?></td>
                                        <td class="center"><?php echo htmlentities($result->ISBNNumber);?></td>
                                        <td class="center"><?php echo htmlentities($result->IssuesDate);?></td>
                                        <td class="center"><?php if($result->ReturnDate=="")
                                        {
                                          $date=Date('Y/m/d');
                                          $date2=Date("Y/m/d",strtotime($result->IssuesDate));
                                          $diff=strtotime($date)- strtotime($date2);
                                          $days=floor($diff/86400);
                                          if($days>7)
                                          {
                                            $days=$days-7;
                                            $str=$days." days exceeded";
                                          }
                                          else if($days<7)
                                          {
                                            $days=7-$days;
                                            $str=$days." days remaining";
                                          }
                                          else
                                          {
                                            $str="Last day remaining";
                                          }
                                          echo htmlentities("Not Return Yet ");?><span style="float:right"><b><?php echo htmlentities($str);?></b></span>
                                          <?php
                                        } else {
                                          echo htmlentities($result->ReturnDate);
                                        }
                                        ?></td>
                                        <td class="center">
                                          <a href="update-issue-bookdeails.php?rid=<?php echo htmlentities($result->rid);?>&ISBNNumber=<?php echo htmlentities($result->ISBNNumber);?>&status=<?php echo htmlentities($str);?>&days=<?php echo htmlentities($days);?>"><button class="btn btn-sm btn-primary"><i class="fa fa-edit "></i> Edit</button>
                                          </td>
                                        </tr>
                                        <?php $cnt=$cnt+1;}} ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <footer>
                      <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                      </div>
                      <div class="clearfix"></div>
                    </footer>
                  </div>
                  <?php include('includes/footer-scripts.php');?>
                </body>
                </html>
                <?php } ?>
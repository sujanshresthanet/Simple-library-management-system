<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
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
              <h4 class="header-line">Manage Requested Books</h4>
            </div>
          </div>
          <div class="row">
            <?php if($_SESSION['error']!="")
            {?>
              <div class="col-md-6">
                <div class="alert alert-danger" >
                  <strong>Error :</strong>
                  <?php echo htmlentities($_SESSION['error']);?>
                  <?php echo htmlentities($_SESSION['error']="");?>
                </div>
              </div>
            <?php } ?>
            <?php if($_SESSION['msg']!="")
            {?>
              <div class="col-md-6">
                <div class="alert alert-success" >
                  <strong>Success :</strong>
                  <?php echo htmlentities($_SESSION['msg']);?>
                  <?php echo htmlentities($_SESSION['msg']="");?>
                </div>
              </div>
            <?php } ?>
            <?php if($_SESSION['delmsg']!="")
            {?>
              <div class="col-md-6">
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
                  <h2>Requested Books Listings</h2>
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
                              <th>Student ID</th>
                              <th>Student Name</th>
                              <th>Book Name</th>
                              <th>Category Name</th>
                              <th>Publication Name</th>
                              <th>ISBN Number</th>
                              <th>Book Price</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $sql = "SELECT StudentID,StudName,BookName,CategoryName,AuthorName,ISBNNumber,BookPrice from tblrequestedbookdetails";
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
                                    <td class="center"><?php echo htmlentities($result->StudentID);?></td>
                                    <td class="center"><?php echo htmlentities($result->StudName);?></td>
                                    <td class="center"><?php echo htmlentities($result->BookName);?></td>
                                    <td class="center"><?php echo htmlentities($result->CategoryName);?></td>
                                    <td class="center"><?php echo htmlentities($result->AuthorName);?></td>
                                    <td class="center"><?php echo htmlentities($result->ISBNNumber);?></td>
                                    <td class="center"><?php echo htmlentities($result->BookPrice);?></td>
                                    <td class="center"><a href="issue-book2.php?ISBNNumber=<?php echo $result->ISBNNumber;?>&StudentID=<?php echo $result->StudentID;?>"><i class="fa fa-edit "></i></a> Issue&nbsp;&nbsp;</td>
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
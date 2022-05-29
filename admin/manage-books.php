<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
  header('location:index.php');
} else {
  if(isset($_GET['del'])) {
    $id=$_GET['del'];
    $sql = "delete from tblbooks  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();
    $_SESSION['delmsg']="Book deleted scuccessfully ";
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
    <title>Simple Library Management System | Manage Books</title>
    <?php include('includes/header-styles.php');?>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include('includes/header.php');
        include('bgwork.php');?>
        <div class="right_col" role="main">
          <div class="page-title">
            <div class="title_left">
              <h3>Manage Books</h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Books Listing</h2>
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
                    <?php if($_SESSION['updatemsg']!="")
                    {?>
                      <div class="col-md-6">
                        <div class="alert alert-success" >
                          <strong>Success :</strong>
                          <?php echo htmlentities($_SESSION['updatemsg']);?>
                          <?php echo htmlentities($_SESSION['updatemsg']="");?>
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
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Books Listing
                      </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Book Name</th>
                                <th>Book ID</th>
                                <th>Total Copies</th>
                                <th>Issued Copies</th>
                                <th>Category</th>
                                <th>Publication</th>
                                <th>ISBN</th>
                                <th>Price</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $sql = "SELECT tblbooks.BookName,tblbooks.id,tblbooks.Copies,tblbooks.IssuedCopies,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId";
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
                                      <td class="center"><?php echo htmlentities($result->BookName);?></td>
                                      <td class="center"><?php echo htmlentities($result->id);?></td>
                                      <td class="center"><?php echo htmlentities($result->Copies);?></td>
                                      <td class="center"><?php echo htmlentities($result->IssuedCopies);?></td>
                                      <td class="center"><?php echo htmlentities($result->CategoryName);?></td>
                                      <td class="center"><?php echo htmlentities($result->AuthorName);?></td>
                                      <td class="center"><?php echo htmlentities($result->ISBNNumber);?></td>
                                      <td class="center"><?php echo htmlentities($result->BookPrice);?></td>
                                      <td class="center">
                                        <a href="edit-book.php?bookid=<?php echo htmlentities($result->bookid);?>"><button class="btn btn-sm btn-primary"><i class="fa fa-edit "></i> Edit</button>
                                          <a href="manage-books.php?del=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Are you sure you want to delete?');"" >  <button class="btn btn-sm btn-danger"><i class="fa fa-pencil"></i> Delete</button>
                                          </td>
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
                </div>
                <?php include('includes/footer-scripts.php');?>
              </body>
              </html>
              <?php } ?>
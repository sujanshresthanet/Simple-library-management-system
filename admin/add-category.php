<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
  header('location:index.php');
} else {
  if(isset($_POST['create'])) {
    $category=$_POST['category'];
    $status=$_POST['status'];
    $sql = "SELECT * from tblcategory where CategoryName=:CategoryName";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':CategoryName',$category,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0) {
      $_SESSION['msg']="This category is already added";
      header('location:manage-categories.php');
    } else {
      $sql="INSERT INTO  tblcategory(CategoryName,Status) VALUES(:category,:status)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':category',$category,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      if($lastInsertId) {
        $_SESSION['msg']="categories Listed successfully";
        header('location:manage-categories.php');
      } else {
        $_SESSION['error']="Something went wrong. Please try again";
        header('location:manage-categories.php');
      }
    }
  }
  ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Library Management System | Add Categories</title>
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
              <h3>Add Category</h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Category Info</h2>
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
                  <br />
                  <form class="form-horizontal form-label-left" method="POST">
                    <div class="form-group row ">
                      <label class="control-label col-md-3 col-sm-3 ">Category Name</label>
                      <div class="col-md-9 col-sm-9 ">
                        <input name="category" type="text" class="form-control required" placeholder="Category Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-sm-3  control-label">Checkboxes and radios
                        <br>
                        <small class="text-navy">Status</small>
                      </label>
                      <div class="col-md-9 col-sm-9 ">
                        <div class="radio">
                          <label>
                            <input type="radio" checked="checked" value="1" id="optionsRadios1" name="status"> Active
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" value="0" id="optionsRadios2" name="status"> Inactive
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9  offset-md-3">
                        <button type="button" class="btn btn-sm btn-primary">Cancel</button>
                        <button type="reset" class="btn btn-sm btn-primary">Reset</button>
                        <button type="submit" name = "create" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>
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
      <?php include('includes/footer-scripts.php');?>
    </body>
    </html>
    <?php } ?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
  header('location:index.php');
} else{
  if(isset($_POST['create'])) {
    $author=$_POST['author'];
    $sql="INSERT INTO  tblauthors(AuthorName) VALUES(:author)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':author',$author,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId) {
      $_SESSION['msg']="Publication Listed successfully";
      header('location:manage-publications.php');
    } else {
      $_SESSION['error']="Something went wrong. Please try again";
      header('location:manage-publications.php');
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
    <title>Simple Library Management System | Add Author</title>
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
              <h4 class="header-line">Add Publication</h4>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Publication Name <small>different form elements</small></h2>
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
                  <form role="form" method="post">
                    <div class="form-group">
                      <label>Publication Name</label>
                      <input class="form-control" type="text" name="author" autocomplete="off"  required />
                    </div>
                    <button type="submit" name="create" class="btn btn-info">Add </button>
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
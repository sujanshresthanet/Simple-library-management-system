<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
  header('location:index.php');
}
else{
  if(isset($_POST['update']))
  {
    $fine=$_POST['finetf'];
    $sql ="SELECT fine from tblfine ";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $listedbooks=$query->rowCount();
    if($listedbooks==0)
    {
      $sql="insert into tblfine values(:fine)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':fine',$fine,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
    }
    else
    {
      $sql="update tblfine set fine=:fine where 1";
      $query = $dbh->prepare($sql);
      $query->bindParam(':fine',$fine,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
    }
    if($lastInsertId)
    {
      $_SESSION['msg']="Fine Updated successfully";
      header('location:set-fine.php');
    }
    else
    {
      $_SESSION['error']="Something went wrong. Please try again";
      header('location:set-fine.php');
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
              <h3>Set Fine</h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Fine Update Section</h2>
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
                      <label>Fine Per Day</label>
                      <input class="form-control" type="text" name="finetf" autocomplete="off"  required />
                    </div>
                    <button type="submit" name="update" class="btn btn-info">Update </button>
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
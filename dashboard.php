<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{
  header('location:index.php');
}
else{?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <?php include('includes/header-styles.php');?>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include('includes/header.php');
        include('bgwork.php');?>
        <div class="right_col" role="main">
          <h3>User DASHBOARD</h3>
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-info back-widget-set text-center">
                <i class="fa fa-bars fa-5x"></i>
                <?php
                $sid=$_SESSION['stdid'];
                $sql1 ="SELECT id from tblissuedbookdetails where StudentID=:sid";
                $query1 = $dbh -> prepare($sql1);
                $query1->bindParam(':sid',$sid,PDO::PARAM_STR);
                $query1->execute();
                $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                $issuedbooks=$query1->rowCount();
                ?>
                <h3><?php echo htmlentities($issuedbooks);?> </h3>
                Book Issued
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-warning back-widget-set text-center">
                <i class="fa fa-recycle fa-5x"></i>
                <?php
                $rsts=0;
                $sql2 ="SELECT id from tblissuedbookdetails where StudentID=:sid and ReturnStatus=:rsts";
                $query2 = $dbh -> prepare($sql2);
                $query2->bindParam(':sid',$sid,PDO::PARAM_STR);
                $query2->bindParam(':rsts',$rsts,PDO::PARAM_STR);
                $query2->execute();
                $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                $returnedbooks=$query2->rowCount();
                ?>
                <h3><?php echo htmlentities($returnedbooks);?></h3>
                Books Not Returned Yet
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
    </div>
    <?php include('includes/footer-scripts.php');?>
  </body>
  </html>
  <?php } ?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
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
    <title>Simple Library Management System | Admin Dash Board</title>
    <?php include('includes/header-styles.php');?>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include('includes/header.php');
        include('bgwork.php');?>
        <div class="right_col" role="main">
          <h3>Admin Dashboard</h3>
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                <i class="fa fa-book fa-5x"></i>
                <?php
                $sql ="SELECT id from tblbooks ";
                $query = $dbh -> prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                $listdbooks=$query->rowCount();
                ?>
                <h3><?php echo htmlentities($listdbooks);?></h3>
                Books Listed
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-info back-widget-set text-center">
                <i class="fa fa-bars fa-5x"></i>
                <?php
                $sql1 ="SELECT id from tblissuedbookdetails ";
                $query1 = $dbh -> prepare($sql1);
                $query1->execute();
                $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                $issuedbooks=$query1->rowCount();
                ?>
                <h3><?php echo htmlentities($issuedbooks);?> </h3>
                Times Book Issued
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-warning back-widget-set text-center">
                <i class="fa fa-recycle fa-5x"></i>
                <?php
                $status=1;
                $sql2 ="SELECT id from tblissuedbookdetails where ReturnStatus=:status";
                $query2 = $dbh -> prepare($sql2);
                $query2->bindParam(':status',$status,PDO::PARAM_STR);
                $query2->execute();
                $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                $returnedbooks=$query2->rowCount();
                ?>
                <h3><?php echo htmlentities($returnedbooks);?></h3>
                Times  Books Returned
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-danger back-widget-set text-center">
                <i class="fa fa-users fa-5x"></i>
                <?php
                $sql3 ="SELECT id from tblstudents ";
                $query3 = $dbh -> prepare($sql3);
                $query3->execute();
                $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                $regstds=$query3->rowCount();
                ?>
                <h3><?php echo htmlentities($regstds);?></h3>
                Registered Users
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                <i class="fa fa-user fa-5x"></i>
                <?php
                $sql4 ="SELECT id from tblauthors ";
                $query4 = $dbh -> prepare($sql4);
                $query4->execute();
                $results4=$query4->fetchAll(PDO::FETCH_OBJ);
                $listdathrs=$query4->rowCount();
                ?>
                <h3><?php echo htmlentities($listdathrs);?></h3>
                Publications Listed
              </div>
            </div>
            <div class="col-md-3 col-sm-3 rscol-xs-6">
              <div class="alert alert-info back-widget-set text-center">
                <i class="fa fa-file-archive-o fa-5x"></i>
                <?php
                $sql5 ="SELECT id from tblcategory ";
                $query5 = $dbh -> prepare($sql5);
                $query5->execute();
                $results5=$query5->fetchAll(PDO::FETCH_OBJ);
                $listdcats=$query5->rowCount();
                ?>
                <h3><?php echo htmlentities($listdcats);?> </h3>
                Listed Categories
              </div>
            </div>
            <div class="col-md-3 col-sm-3 rscol-xs-6">
              <div class="alert alert-info back-widget-set text-center">
                <i class="fa fa-money fa-5x"></i>
                <?php
                $ret="select * from tblfine where 1";
                $query= $dbh -> prepare($ret);
                $query-> execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount() > 0)
                {
                  foreach($results as $result)
                  {
                    $fine=$result->fine;
                  }
                }
                ?>
                <h3><?php echo htmlentities($fine);?> </h3>
                Current Fine Per Day
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
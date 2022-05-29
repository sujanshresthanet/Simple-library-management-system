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
    $athrid=intval($_GET['athrid']);
    $UpdationDate = date('Y-m-d H:i:s');
    $author=$_POST['author'];
    $sql="update  tblauthors set AuthorName=:author,UpdationDate=:UpdationDate where id=:athrid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':author',$author,PDO::PARAM_STR);
    $query->bindParam(':athrid',$athrid,PDO::PARAM_STR);
    $query->bindParam(':UpdationDate',$UpdationDate,PDO::PARAM_STR);

    $query->execute();
    $_SESSION['updatemsg']="Author info updated successfully";
    header('location:manage-publications.php');



  }
  ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Library Management System | Add Publication</title>
    <?php include('includes/header-styles.php');?>

  </head>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!------MENU SECTION START-->
        <?php include('includes/header.php');
        include('bgwork.php');?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="page-title">
            <div class="title_left">
              <h4 class="header-line">Edit Publication</h4>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>


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
                    <?php
                    $athrid=intval($_GET['athrid']);
                    $sql = "SELECT * from  tblauthors where id=:athrid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':athrid',$athrid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                        {               ?>
                          <input class="form-control" type="text" name="author" value="<?php echo htmlentities($result->AuthorName);?>" required />
                        <?php }} ?>
                      </div>

                      <button type="submit" name="update" class="btn btn-info">Update </button>

                    </form>
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


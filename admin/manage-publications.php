<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
  header('location:index.php');
} else {
  if(isset($_GET['del'])) {
    $id=$_GET['del'];
    $sql = "delete from tblauthors  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();
    $_SESSION['delmsg']="Publication deleted";
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
    <title>Simple Library Management System | Manage Authors</title>
    <?php include('includes/header-styles.php');?>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include('includes/header.php');
        include('bgwork.php');?>
        <div class="right_col" role="main">
          <div class="content-wrapper">
            <div class="container">
              <div class="row pad-botm">
                <div class="col-md-12">
                  <h4 class="header-line">Manage Publications</h4>
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
                  <?php if($_SESSION['updatemsg']!="")
                  {?>
                    <div class="col-md-12">
                      <div class="alert alert-success" >
                        <strong>Success :</strong>
                        <?php echo htmlentities($_SESSION['updatemsg']);?>
                        <?php echo htmlentities($_SESSION['updatemsg']="");?>
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
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2> Publications Listing <small>Users</small></h2>
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
                                  <th>Publication</th>
                                  <th>Creation Date</th>
                                  <th>Updation Date</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $sql = "SELECT * from  tblauthors";
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
                                        <td class="center"><?php echo htmlentities($result->AuthorName);?></td>
                                        <td class="center"><?php echo htmlentities($result->creationDate);?></td>
                                        <td class="center"><?php echo htmlentities($result->UpdationDate);?></td>
                                        <td class="center">
                                          <a href="edit-publication.php?athrid=<?php echo htmlentities($result->id);?>"><button class="btn btn-sm btn-primary"><i class="fa fa-edit "></i> Edit</button>
                                            <a href="manage-publications.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to delete?');"" >  <button class="btn btn-sm btn-danger"><i class="fa fa-pencil"></i> Delete</button>
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
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    if(isset($_GET['inid']))
    {
        $id=$_GET['inid'];
        $status=0;
        $sql = "update tblstudents set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
        $query -> execute();
        header('location:reg-students.php');
    }
//code for active students
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $status=1;
        $sql = "update tblstudents set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
        $query -> execute();
        header('location:reg-students.php');
    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Simple Library Management System | Manage Reg Students</title>
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
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Reg Students Listing</h2>
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
                                                    <th>Email id </th>
                                                    <th>Mobile Number</th>
                                                    <th>Reg Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sql = "SELECT * from tblstudents";
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
                                                                <td class="center"><?php echo htmlentities($result->StudentId);?></td>
                                                                <td class="center"><?php echo htmlentities($result->FullName);?></td>
                                                                <td class="center"><?php echo htmlentities($result->EmailId);?></td>
                                                                <td class="center"><?php echo htmlentities($result->MobileNumber);?></td>
                                                                <td class="center"><?php echo htmlentities($result->RegDate);?></td>
                                                                <td class="center"><?php if($result->Status==1)
                                                                {
                                                                    echo htmlentities("Active");
                                                                } else {
                                                                    echo htmlentities("Blocked");
                                                                }
                                                                ?></td>
                                                                <td class="center">
                                                                    <?php if($result->Status==1)
                                                                    {?>
                                                                        <a href="reg-students.php?inid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to block this student?');"" >  <button class="btn btn-sm btn-danger"> Inactive</button>
                                                                        <?php } else {?>
                                                                            <a href="reg-students.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to active this student?');""><button class="btn btn-sm btn-primary"> Active</button>
                                                                            <?php } ?>
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
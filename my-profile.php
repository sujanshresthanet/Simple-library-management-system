<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
    header('location:index.php');
}
else{
    if(isset($_POST['update']))
    {
        $sid=$_SESSION['stdid'];
        $fname=$_POST['fullanme'];
        $_SESSION['username']=$fname;
        $mobileno=$_POST['mobileno'];
        $sql="update tblstudents set FullName=:fname,MobileNumber=:mobileno where StudentId=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid',$sid,PDO::PARAM_STR);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Your profile has been updated")</script>';
    }
    ?>
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
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Update Profile</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>My Profile</h2>
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
                                    <form name="signup" method="post">
                                        <?php
                                        $sid=$_SESSION['stdid'];
                                        $sql="SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblstudents  where StudentId=:sid ";
                                        $query = $dbh -> prepare($sql);
                                        $query-> bindParam(':sid', $sid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                            foreach($results as $result)
                                                {               ?>
                                                    <div class="form-group">
                                                        <label>Student ID : </label>
                                                        <?php echo htmlentities($result->StudentId);?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Reg Date : </label>
                                                        <?php echo htmlentities($result->RegDate);?>
                                                    </div>
                                                    <?php if($result->UpdationDate!=""){?>
                                                        <div class="form-group">
                                                            <label>Last Updation Date : </label>
                                                            <?php echo htmlentities($result->UpdationDate);?>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="form-group">
                                                        <label>Profile Status : </label>
                                                        <?php if($result->Status==1){?>
                                                            <span style="color: green">Active</span>
                                                        <?php } else { ?>
                                                            <span style="color: red">Blocked</span>
                                                        <?php }?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Enter Full Name</label>
                                                        <input class="form-control" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName);?>" autocomplete="off" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mobile Number :</label>
                                                        <input class="form-control" type="text" name="mobileno" maxlength="10" value="<?php echo htmlentities($result->MobileNumber);?>" autocomplete="off" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Enter Email</label>
                                                        <input class="form-control" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId);?>"  autocomplete="off" required readonly />
                                                    </div>
                                                <?php }} ?>
                                                <button type="submit" name="update" class="btn btn-sm btn-primary" id="submit">Update Now </button>
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
                </div>
            </div>
            <?php include('includes/footer-scripts.php');?>
        </body>
        </html>
        <?php } ?>
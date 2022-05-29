<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
    header('location:index.php');
}
else{
    if(isset($_POST['change']))
    {
        $password=md5($_POST['password']);
        $newpassword=md5($_POST['newpassword']);
        $email=$_SESSION['login'];
        $sql ="SELECT Password FROM tblstudents WHERE EmailId=:email and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        if($query -> rowCount() > 0)
        {
            $con="update tblstudents set Password=:newpassword where EmailId=:email";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg="Your Password succesfully changed";
        }
        else {
            $error="Your current password is wrong";
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
        <title>Simple Library Management System | </title>
        <?php include('includes/header-styles.php');?>
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
            .succWrap{
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
        </style>
    </head>
    <script type="text/javascript">
        function valid()
        {
            if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
            {
                alert("New Password and Confirm Password Field do not match  !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php include('includes/header.php');
                include('bgwork.php');?>
                <div class="right_col" role="main">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-line">User Change Password</h4>
                        </div>
                    </div>
                    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Change Password</h2>
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
                                    <form role="form" method="post" onSubmit="return valid();" name="chngpwd">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input class="form-control" type="password" name="password" autocomplete="off" required  />
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Password</label>
                                            <input class="form-control" type="password" name="newpassword" autocomplete="off" required  />
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password </label>
                                            <input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
                                        </div>
                                        <button type="submit" name="change" class="btn btn-info">Change </button>
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
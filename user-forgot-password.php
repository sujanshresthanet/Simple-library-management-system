<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['change']))
{
//code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    }
    else {
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $newpassword=md5($_POST['newpassword']);
        $sql ="SELECT EmailId FROM tblstudents WHERE EmailId=:email and MobileNumber=:mobile";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        if($query -> rowCount() > 0)
        {
            $con="update tblstudents set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo "<script>alert('Your Password succesfully changed');</script>";
        }
        else {
            echo "<script>alert('Email id or Mobile no is invalid');</script>";
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
    <title>Simple Library Management System | Password Recovery </title>
    <!-- Bootstrap -->
    <link href="./theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./theme/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="./theme/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="./theme/css/custom.min.css" rel="stylesheet">
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
</head>
<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <div>
                        <h1><i class="fa fa-book"></i> Library Management System</h1>
                    </div>
                    <form role="form" name="chngpwd" method="post" onSubmit="return valid();">
                        <h1>Forgot password form</h1>
                        <div class="form-group">
                            <input placeholder="Enter Reg Email id" class="form-control" type="email" name="email" required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input placeholder="Enter Reg Mobile No" class="form-control" type="text" name="mobile" required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input placeholder="Password" class="form-control" type="password" name="newpassword" required autocomplete="off"  />
                        </div>
                        <div class="form-group">
                            <input placeholder="ConfirmPassword" class="form-control" type="password" name="confirmpassword" required autocomplete="off"  />
                        </div>
                        <div class="form-group">
                         <img src="captcha.php">
                         <p>Verificaion code</p>
                         <input type="text"  name="vercode" class="form-control" autocomplete="off" placeholder="Enter the verification code" required/>
                     </div>
                     <button type="submit" name="change" class="btn btn-info">Change Password</button> | <a href="index.php">Login</a>
                 </form>
                 <div class="clearfix"></div>
                 <div class="separator">
                    <div class="clearfix"></div>
                    <br />
                    <p>©<?php echo date('Y')?> All Rights Reserved. Library management system</p>
                </div>
            </form>
        </section>
    </div>
</div>
</div>
</body>
</html>
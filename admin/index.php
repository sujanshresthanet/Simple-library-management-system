<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
  $username=$_POST['username'];
  $password=md5($_POST['password']);
  $sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':username', $username, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    $_SESSION['alogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
  } else{
    echo "<script>alert('Invalid Details');</script>";
  }
} elseif(isset($_SESSION['alogin'])) {
 echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>LMS! | </title>

  <!-- Bootstrap -->
  <link href="../theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../theme/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="../theme/vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../theme/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
 <div>
  <a class="hiddenanchor" id="signup"></a>
  <a class="hiddenanchor" id="signin"></a>

  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <div>
          <h2><i class="fa fa-book"></i> Library Management System</h2>

        </div>
        <form role="form" method="post">

          <h1>Admin Login Form</h1>
          <div>
            <input  name="username" type="text" class="form-control" placeholder="Username" required="" />
          </div>
          <div>
            <input name="password" type="password" class="form-control" placeholder="Password" required="" />
          </div>
          <div>
            <input class="btn btn-primary submit" name="login" value="Log in" type="submit">
          </div>

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

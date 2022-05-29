<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
  header('location:index.php');
} else{
  if(isset($_POST['issue']))
  {
    $studentid=strtoupper($_POST['studentid']);
    $bookid=$_POST['bookdetails'];
    $ReturnStatus = 0;
    $sql="INSERT INTO  tblissuedbookdetails(StudentID,BookId,ReturnStatus) VALUES(:studentid,:bookid, :ReturnStatus)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
    $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
    $query->bindParam(':ReturnStatus',$ReturnStatus,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      $_SESSION['msg']="Book issued successfully";
      $sql="update tblbooks set IssuedCopies=IssueCopies-1 where id=:bookid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
      $query->execute();
      header('location:manage-issued-books.php');
    }
    else
    {
      $_SESSION['error']="Something went wrong. Please try again";
      header('location:manage-issued-books.php');
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
    <title>Simple Library Management System | Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <?php include('includes/header-styles.php');?>
    <script>
    // function for get student name
    function getstudent() {
      $("#loaderIcon").show();
      jQuery.ajax({
        url: "get_student.php",
        data:'studentid='+$("#studentid").val(),
        type: "POST",
        success:function(data){
          $("#get_student_name").html(data);
          $("#loaderIcon").hide();
        },
        error:function (){}
      });
    }
    //function for book details
    function getbook() {
      $("#loaderIcon").show();
      jQuery.ajax({
        url: "get_book.php",
        data:'bookid='+$("#bookid").val(),
        type: "POST",
        success:function(data){
          $("#get_book_name").html(data);
          $("#loaderIcon").hide();
        },
        error:function (){}
      });
    }
  </script>
  <style type="text/css">
    .others{
      color:red;
    }
  </style>
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include('includes/header.php');
      include('bgwork.php');?>
      <div class="right_col" role="main">
        <div class="page-title">
          <div class="title_left">
            <h3>Issue a New Book</h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Issue a New Book</h2>
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
                    <label>Student id<span style="color:red;">*</span></label>
                    <input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off"  required />
                  </div>
                  <div class="form-group">
                    <span id="get_student_name" style="font-size:16px;"></span>
                  </div>
                  <div class="form-group">
                    <label>Book ID<span style="color:red;">*</span></label>
                    <input class="form-control" type="text" name="bookid" id="bookid" onBlur="getbook()"  required="required" />
                  </div>
                  <div class="form-group">
                    <label>Book Title<span style="color:red;">*</span></label>
                    <select  class="form-control" name="bookdetails" id="get_book_name" readonly>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>
                  </div>
                </div>
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
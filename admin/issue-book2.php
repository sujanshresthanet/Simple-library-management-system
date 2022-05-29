<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
}
else{

    if(isset($_POST['issue']))
    {

        $studentid=strtoupper($_POST['studentid']);
        $bookid=$_POST['bookdetails'];
        $sql="INSERT INTO  tblissuedbookdetails(StudentID,BookId) VALUES(:studentid,:bookid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
        $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        $bookid=$_GET['ISBNNumber'];
        $studentid=$_GET['StudentID'];
        $sql="DELETE FROM tblrequestedbookdetails WHERE StudentID=:studentid and ISBNNumber=:bookid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':studentid',$studentid, PDO::PARAM_STR);
        $query -> bindParam(':bookid',$bookid, PDO::PARAM_STR);
        $query->execute();

        $sql="update tblbooks set IssuedCopies=IssuedCopies+1 where ISBNNumber=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg']="Book issued successfully";
        header('location:manage-issued-books.php');

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
      <!------MENU SECTION START-->
      <?php include('includes/header.php');
      include('bgwork.php');?>

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="page-title">
          <div class="title_left">
            <h3>Issue a New Book</h3>
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
      <h2>Issue a New Book <small>different form elements</small></h2>
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





  <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">

    <?php
    $bookid=$_GET['ISBNNumber'];
    $stdid=$_GET['StudentID'];
    ?>
    <div class="form-group">
        <label>Student id<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="studentid" id="studentid" value="<?php echo htmlentities($stdid);?>" onBlur="getstudent()" required />
    </div>

    <div class="form-group">
        <span id="get_student_name" style="font-size:16px;"></span>
    </div>

    <div class="form-group">
        <label>BookID<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="booikid" id="bookid" value="<?php echo htmlentities($bookid);?>" onBlur="getbook()"  required="required" />
    </div>

    <div class="form-group">
      Book Title<select  class="form-control" name="bookdetails" id="get_book_name" readonly>
      </select>
  </div>

  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
  else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

  <button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>

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
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
}
else{
    $status=$_GET['status'];
    $days=$_GET['days'];
    if(isset($_POST['return']))
    {
        $rid=intval($_GET['rid']);
        $fine=$_POST['fine'];
        $ISBNNumber=$_GET['ISBNNumber'];

        $rstatus=1;
        $sql="update tblissuedbookdetails set fine=:fine,ReturnStatus=:rstatus where id=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->bindParam(':fine',$fine,PDO::PARAM_STR);
        $query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
        $query->execute();

        $sql="update tblbooks set IssuedCopies=IssuedCopies-1 where ISBNNumber=:ISBNNumber";
        $query = $dbh->prepare($sql);
        $query->bindParam(':ISBNNumber',$ISBNNumber,PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg']="Book Returned successfully";
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
    <title>Simple Library Management System | Issued Book Details</title>
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
              <h3>Issued Book Details</h3>
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
        <h2>Issued Book Details <small>different form elements</small></h2>
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
        <?php
        $rid=intval($_GET['rid']);
        $sql = "SELECT tblstudents.FullName,tblbooks.BookName,tblbooks.id,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine,tblissuedbookdetails.ReturnStatus from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblissuedbookdetails.id=:rid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
            foreach($results as $result)
                {               ?>




                    <div class="form-group">
                        <label>Student Name :</label>
                        <?php echo htmlentities($result->FullName);?>
                    </div>

                    <div class="form-group">
                        <label>Book Name :</label>
                        <?php echo htmlentities($result->BookName);?>
                    </div>


                    <div class="form-group">
                        <label>Book ID :</label>
                        <?php echo htmlentities($result->id);?>
                    </div>

                    <div class="form-group">
                        <label>ISBN :</label>
                        <?php echo htmlentities($result->ISBNNumber);?>
                    </div>

                    <div class="form-group">
                        <label>Book Issued Date :</label>
                        <?php echo htmlentities($result->IssuesDate);?>
                    </div>

                    <div class="form-group">
                        <label>Book Returned Date :</label>
                        <?php if($result->ReturnDate=="")
                        {
                            echo htmlentities("Not Return Yet");
                        } else {
                            echo htmlentities($result->ReturnDate);
                        }?>
                    </div>

                    <div class="form-group">
                        <?php
                        $flag=0;
                        if(strpos($status,'exceeded')!== false && $result->ReturnDate===NULL)
                        {
                            $flag=1;
                            ?>
                            <span><b>Fine To Be Paid:</b><?php echo htmlentities($days*$_SESSION['fine']);?></span>
                            <?php
                        }?>
                    </div>


                    <?php if($flag===1){?>
                        <div class="form-group">
                            <label>Fine (in Rs) :</label>
                            <input class="form-control" type="text" name="fine" id="fine" />
                        <?php }
                        else {
                            ?>
                            <div class="form-group">
                                <label>Fine (in Rs) :</label>
                                <?php
                                if($result->fine===Null){
                                    echo htmlentities("0");
                                }
                                else
                                {
                                   echo htmlentities($result->fine);
                               }
                           }
                           ?></div>
                       </div>

                       <?php if($result->ReturnStatus==0){?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8" style="padding-left:20px;padding-top:-20px;">
                                    <button type="submit" name="return" id="submit" class="btn btn-info">Return Book</button>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                <?php }}}?>
            </form>
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
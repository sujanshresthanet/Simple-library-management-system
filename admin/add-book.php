<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
  header('location:index.php');
} else{
  if(isset($_POST['add'])) {
    $bookname=$_POST['bookname'];
    $category=$_POST['category'];
    $author=$_POST['author'];
    $isbn=$_POST['isbn'];
    $price=$_POST['price'];
    $copies=$_POST['copies'];
    $IssuedCopies = 0;
    $sql="INSERT INTO  tblbooks(BookName,CatId,AuthorId,ISBNNumber,BookPrice,Copies,IssuedCopies) VALUES(:bookname,:category,:author,:isbn,:price,:copies,:IssuedCopies)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
    $query->bindParam(':category',$category,PDO::PARAM_STR);
    $query->bindParam(':author',$author,PDO::PARAM_STR);
    $query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
    $query->bindParam(':price',$price,PDO::PARAM_STR);
    $query->bindParam(':copies',$copies,PDO::PARAM_STR);
    $query->bindParam(':IssuedCopies',$IssuedCopies,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId) {
      $_SESSION['msg']="Book Listed successfully";
      header('location:manage-books.php');
    } else {
      $_SESSION['error']="Something went wrong. Please try again";
      header('location:manage-books.php');
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
    <title>Simple Library Management System | Add Book</title>
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
              <h3>Add Book</h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Book Info <small>different form elements</small></h2>
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
                      <label>Book Name<span style="color:red;">*</span></label>
                      <input class="form-control" type="text" name="bookname" autocomplete="off"  required />
                    </div>
                    <div class="form-group">
                      <label> Category<span style="color:red;">*</span></label>
                      <select class="form-control" name="category" required="required">
                        <option value=""> Select Category</option>
                        <?php
                        $status=1;
                        $sql = "SELECT * from  tblcategory where Status=:status";
                        $query = $dbh -> prepare($sql);
                        $query -> bindParam(':status',$status, PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0) {
                          foreach($results as $result) {
                           ?>
                           <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->CategoryName);?></option>
                         <?php }} ?>
                       </select>
                     </div>
                     <div class="form-group">
                      <label> Publication<span style="color:red;">*</span></label>
                      <select class="form-control" name="author" required="required">
                        <option value=""> Select Publication</option>
                        <?php
                        $sql = "SELECT * from  tblauthors ";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0) {
                          foreach($results as $result) {
                            ?>
                            <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->AuthorName);?></option>
                          <?php }} ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>ISBN Number<span style="color:red;">*</span></label>
                        <input class="form-control" type="number" name="isbn"  required="required" autocomplete="off"  />
                        <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
                      </div>
                      <div class="form-group">
                        <label>No of Copies<span style="color:red;">*</span></label>
                        <input class="form-control" type="number" name="copies" autocomplete="off"   required="required" />
                      </div>
                      <div class="form-group">
                        <label>Price<span style="color:red;">*</span></label>
                        <input class="form-control" type="number" name="price" autocomplete="off"   required="required" />
                      </div>
                      <button type="submit" name="add" class="btn btn-info">Add </button>
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
        <?php include('includes/footer-scripts.php');?>
      </body>
      </html>
      <?php } ?>
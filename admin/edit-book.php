<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
}
else{

    if(isset($_POST['update']))
    {
        $bookname=$_POST['bookname'];
        $category=$_POST['category'];
        $author=$_POST['author'];
        $isbn=$_POST['isbn'];
        $price=$_POST['price'];
        $bookid=intval($_GET['bookid']);
        $Copies=($_GET['Copies']);
        $sql="update tblbooks set BookName=:bookname,CatId=:category,AuthorId=:author,ISBNNumber=:isbn,BookPrice=:price,Copies=:Copies where id=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
        $query->bindParam(':category',$category,PDO::PARAM_STR);
        $query->bindParam(':author',$author,PDO::PARAM_STR);
        $query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
        $query->bindParam(':price',$price,PDO::PARAM_STR);
        $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
        $query->bindParam(':Copies',$Copies,PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg']="Book info updated successfully";
        header('location:manage-books.php');


    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Simple Library Management System | Edit Book</title>
        <?php include('includes/header-styles.php');?>

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
                  <h3>Edit Book</h3>
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
        <?php
        $bookid=intval($_GET['bookid']);
        $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblbooks.Copies,tblcategory.id as cid,tblauthors.AuthorName,tblauthors.id as athrid,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId where tblbooks.id=:bookid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
            foreach($results as $result)
                {               ?>
                    <div class="form-group">
                        <label>Book ID</label>
                        <input class="form-control" type="number" name="bookid" value="<?php echo htmlentities($result->bookid);?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Book Name<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName);?>" required />
                    </div>

                    <div class="form-group">
                        <label> Category<span style="color:red;">*</span></label>
                        <select class="form-control" name="category" required="required">
                            <option value="<?php echo htmlentities($result->cid);?>"> <?php echo htmlentities($catname=$result->CategoryName);?></option>
                            <?php
                            $status=1;
                            $sql1 = "SELECT * from  tblcategory where Status=:status";
                            $query1 = $dbh -> prepare($sql1);
                            $query1-> bindParam(':status',$status, PDO::PARAM_STR);
                            $query1->execute();
                            $resultss=$query1->fetchAll(PDO::FETCH_OBJ);
                            if($query1->rowCount() > 0)
                            {
                                foreach($resultss as $row)
                                {
                                    if($catname==$row->CategoryName)
                                    {
                                        continue;
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->CategoryName);?></option>
                                    <?php }}} ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label> Publication<span style="color:red;">*</span></label>
                                <select class="form-control" name="author" required="required">
                                    <option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->AuthorName);?></option>
                                    <?php

                                    $sql2 = "SELECT * from  tblauthors ";
                                    $query2 = $dbh -> prepare($sql2);
                                    $query2->execute();
                                    $result2=$query2->fetchAll(PDO::FETCH_OBJ);
                                    if($query2->rowCount() > 0)
                                    {
                                        foreach($result2 as $ret)
                                        {
                                            if($athrname==$ret->AuthorName)
                                            {
                                                continue;
                                            } else{

                                                ?>
                                                <option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->AuthorName);?></option>
                                            <?php }}} ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ISBN Number<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber);?>"  required="required" />
                                        <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
                                    </div>

                                    <div class="form-group">
                                       <label>No of Copies<span style="color:red;">*</span></label>
                                       <input class="form-control" type="text" name="copies" value="<?php echo htmlentities($result->Copies);?>"   required="required" />
                                   </div>

                                   <div class="form-group">
                                       <label>Price in Rs<span style="color:red;">*</span></label>
                                       <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->BookPrice);?>"   required="required" />
                                   </div>
                               <?php }} ?>
                               <button type="submit" name="update" class="btn btn-info">Update </button>

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










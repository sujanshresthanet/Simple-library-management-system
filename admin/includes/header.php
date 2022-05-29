<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="dashboard.php" class="site_title"><i class="fa fa-book"></i> <span>LMS</span></a>
    </div>
    <div class="clearfix"></div>
    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_info">
        <h2>Welcome, <?php echo $_SESSION['alogin']; ?> <i class="fa fa-home"></i></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <br />
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a>
          </li>
          <li><a><i class="fa fa-sitemap"></i> Categories <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li role="presentation"><a role="menuitem" tabindex="-1" href="add-category.php" >Add Category</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-categories.php">Manage Categories</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> Publications <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li role="presentation"><a role="menuitem" tabindex="-1" href="add-publications.php">Add Publications</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-publications.php">Manage Publications</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-book"></i> Books <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li role="presentation"><a role="menuitem" tabindex="-1" href="add-book.php">Add Book</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-books.php">Manage Books</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="set-fine.php">Update Fine</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-book"></i> Issue Books <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li role="presentation"><a role="menuitem" tabindex="-1" href="issue-book.php">Issue New Book</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-issued-books.php">Manage Issued Books</a></li>
            </ul>
          </li>
          <li><a href="manage-requested-books.php"><i class="fa fa-book"></i> Requested Books</a>
            <li><a href="report.php"><i class="fa fa-bar-chart-o"></i> Report</a></li>
            <li><a href="reg-students.php"><i class="fa fa-users"></i> Reg Students</a></li>
            <li><a href="change-password.php"><i class="fa fa-gear"></i> Change Password</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- /sidebar menu -->
      <!-- /menu footer buttons -->
      <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
          <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
          <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
          <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
      </div>
      <!-- /menu footer buttons -->
    </div>
  </div>
  <!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open" style="padding-left: 15px;">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION['alogin']; ?>
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item"  href="change-password.php"> Change Password</a>
              <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </div>
<!-- /top navigation -->
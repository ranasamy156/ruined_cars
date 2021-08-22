<header class="main-header">
        <!-- Logo -->
        <a href="../index.php?id=<?php echo $_SESSION['id'] ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><?php echo $expr['controlpanel'] ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             <!-- Notifications: style can be found in dropdown.less -->
             <?php
                  include_once '../database.php';
                  $newdb = new Database();
                  $new = $newdb->GetData("select * from notification where seen = '0' and type_id='1' ORDER BY id DESC");
                  $noti_rows = $new->num_rows;
                  if($rownot = mysqli_fetch_assoc($new)){
                 ?>
               <li class="dropdown notifications-menu">
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning"><?php echo $noti_rows ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php foreach ($new as $rownot) { ?>
                      <li>
                        <a name="submit" href="request.php?n=<?php echo ($rownot["request_id"]); ?>">
                          <i class="fa fa-warning text-yellow"></i> <?php echo $rownot['message'] ?>
                        </a>
                      </li>
                      <?php }
                      ?>
                    </ul>
                    
                  </li>
                </ul>
              </li>
              <?php } ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/new.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/new.png" class="img-circle" alt="User Image">
                    <p>
                    <?php echo $_SESSION['name']; ?>
                      <small><?php echo $_SESSION['phone']; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                  <div class="pull-<?php echo $expr['right'] ?>">
                      <a href="editprofile.php" class="btn btn-default btn-flat"><?php echo $expr['editprofile'] ?></a>
                    </div>
                    <div class="pull-<?php echo $expr['left'] ?>">
                      <a href="../logout.php" class="btn btn-default btn-flat"><?php echo $expr['logout'] ?></a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
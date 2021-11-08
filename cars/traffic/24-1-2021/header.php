<header class="main-header">
        <!-- Logo -->
        <a href="../index.php" class="logo">
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
                  $sql = "CALL getNotifications(?)";
                  $typeID = $_SESSION['type_id'];
  
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(1, $typeID, PDO::PARAM_INT);
                  $stmt->execute();
                  $noti_rows = $stmt->rowCount();
                  if($noti_rows != 0){
                 ?>
               <li class="dropdown notifications-menu">
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-primary"><?php echo $noti_rows ?></span>
                </a>
                <ul class="dropdown-menu">
                  
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php foreach ($stmt as $rownot) { ?>
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
                  <img src="../../assets/dist/img/new.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../assets/dist/img/new.png" class="img-circle" alt="User Image">
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
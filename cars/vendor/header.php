<header class="main-header">
      
      <!-- Logo -->
      <a href="index.php?id=<?php echo $_SESSION['id'] ?>" class="logo">
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
                <span class="label label-danger"><?php echo $noti_rows ?></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <?php foreach ($stmt as $rownot) { ?>
                    <li>
                      <a name="submit" href="24-1-2021/request.php?n=<?php echo ($rownot["request_id"]); ?>">
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
                <img src="../assets/dist/img/new.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="../assets/dist/img/new.png" class="img-circle" alt="User Image">
                  <p>
                  <?php echo $_SESSION['name']; ?>
                    <small><?php echo $_SESSION['phone']; ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="24-1-2021/editprofile.php" class="btn btn-default btn-flat"><?php echo $expr['editprofile'] ?></a>
                  </div>
                  <div class="pull-left">
                    <a href="logout.php" class="btn btn-default btn-flat"><?php echo $expr['logout'] ?></a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-<?php echo $expr['right'] ?> image">
            <img src="../assets/dist/img/new.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-<?php echo $expr['left'] ?> info">
            <p><?php echo $_SESSION['name']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $expr['online'] ?></a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="active treeview">
              <a href="index.php?id=<?php echo $_SESSION['id'] ?>">
                <i class="fa fa-dashboard"></i> <span>
                  <?php echo $expr['controlpanel'] ?></span> <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i>
              </a>
            </li>
            <?php if($_SESSION["permission_des"] == 'admin') {?>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-users"></i>
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i>
                <span><?php echo $expr['managerusers'] ?></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="24-1-2021/adddetails.php"><i class="fa fa-circle-o"></i> <?php echo $expr['addusers'] ?></a></li>
                <li><a href="24-1-2021/userlist.php"><i class="fa fa-circle-o"></i><?php echo $expr['userlist'] ?></a></li>
              </ul>
            </li>
            <?php }?>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-tasks"></i>
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i>
                <span><?php echo $expr['manageprocedures'] ?></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="24-1-2021/procedures.php"><i class="fa fa-circle-o"></i> <?php echo $expr['addprocedures'] ?> </a></li>
                <li><a href="24-1-2021/procedureslist.php"><i class="fa fa-circle-o"></i><?php echo $expr['procedureslist'] ?></a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-comments"></i>
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i>
                <span><?php echo $expr['managestatus'] ?></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="24-1-2021/addstatus.php"><i class="fa fa-circle-o"></i> <?php echo $expr['addstatus'] ?> </a></li>
                <li><a href="24-1-2021/reqlist.php"><i class="fa fa-circle-o"></i><?php echo $expr['statuslist'] ?></a></li>
              </ul>
            </li>
            <li>
              <a href="24-1-2021/closed.php">
              <i class="fa fa-times-circle" aria-hidden="true"></i> <span><?php echo $expr['closedrequests'] ?></span> <!--<span class="badge badge-danger"><?php //echo $pen; ?></span>-->
              </a>
            </li>
            <li>
              <a href="24-1-2021/direct.php">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> <span>الطلبات الفورية</span> <!--<span class="badge badge-danger"><?php //echo $pen; ?></span>-->
              </a>
            </li>
            <li>
              <a href="24-1-2021/lifting_procedures.php">
              <i class="fa fa-align-justify" aria-hidden="true"></i> <span>محاضر الرفع</span> <!--<span class="badge badge-danger"><?php //echo $pen; ?></span>-->
              </a>
            </li>
            <li>
              <a href="reports.php">
              <i class="fa fa-print" aria-hidden="true"></i> <span><?php echo $expr['printreport'] ?> و الاستعلامات</span> <!--<span class="badge badge-danger"><?php //echo $pen; ?></span>-->
              </a>
            </li>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-language"></i>
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i>
                <span><?php echo $expr['languages'] ?></span>
              </a>
              <ul class="treeview-menu">
                <?php foreach($dictionary as $key => $lang_dict){
                    if($current_lang == $key){  
                ?>
                <li><a href="#" id="ar" class="translate"><?php echo $lang_dict['name'] ?></a></li>
              <?php }else{ ?>
                <li><a href="lang.php?change=<?php echo $key ?>" id="en" class="translate"></i><?php echo $lang_dict['name'] ?></a></li>
              <?php } } ?>
              </ul>
            </li>
          </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
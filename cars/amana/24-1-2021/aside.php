<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-<?php echo $expr['right'] ?> image">
              <img src="../../assets/dist/img/new.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['name']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $expr['online'] ?></a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="active treeview">
              <a href="../index.php">
                <i class="fa fa-dashboard"></i> <span><?php echo $expr['mainmenu'] ?></span> <i class="fa fa-angle-left pull-left"></i>
              </a>
            </li>
            <?php if($_SESSION["permission_des"] == 'admin') {?>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-users"></i>
                <span><?php echo $expr['managerusers'] ?></span>
                <i class="fa fa-angle-left pull-<?php echo $expr['right'] ?>"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="adddetails.php"><i class="fa fa-circle-o"></i> <?php echo $expr['addusers'] ?></a></li>
                <li><a href="userlist.php"><i class="fa fa-circle-o"></i><?php echo $expr['userlist'] ?></a></li>
              </ul>
            </li>
            <?php }?>
            <li>
              <a href="photolist.php">
                <i class="fa fa-picture-o" aria-hidden="true"></i> <span><?php echo $expr['slider'] ?></span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-tasks"></i>
                <span><?php echo $expr['manageprocedures'] ?></span>
                <i class="fa fa-angle-left pull-<?php echo $expr['right'] ?>"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="procedures.php"><i class="fa fa-circle-o"></i> <?php echo $expr['addprocedures'] ?> </a></li>
                <li><a href="procedureslist.php"><i class="fa fa-circle-o"></i><?php echo $expr['procedureslist'] ?></a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-comments"></i>
                <span><?php echo $expr['managestatus'] ?></span>
                <i class="fa fa-angle-left pull-<?php echo $expr['right'] ?>"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="addstatus.php"><i class="fa fa-circle-o"></i><?php echo $expr['addstatus'] ?></a></li>
                <li><a href="reqlist.php"><i class="fa fa-circle-o"></i> <?php echo $expr['statuslist'] ?> </a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-newspaper-o"></i>
                <span><?php echo $expr['managenews'] ?></span>
                <i class="fa fa-angle-left pull-<?php echo $expr['right'] ?>"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="news.php"><i class="fa fa-circle-o"></i><?php echo $expr['addnews'] ?> </a></li>
                <li><a href="newslist.php"><i class="fa fa-circle-o"></i><?php echo $expr['newslist'] ?></a></li>
              </ul>
            </li>
            <li>
              <a href="addcar.php">
                <i class="fa fa-car" aria-hidden="true"></i> <span><?php echo $expr['cars'] ?></span>
              </a>
            </li>
            <li>
              <a href="closed.php">
              <i class="fa fa-times-circle" aria-hidden="true"></i> <span><?php echo $expr['closedrequests'] ?></span>
              </a>
            </li>
            <li>
              <a href="direct.php">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> <span>?????????????? ??????????????</span>
              </a>
            </li>
            <li>
              <a href="lifting_procedures.php">
              <i class="fa fa-align-justify" aria-hidden="true"></i> <span>?????????? ??????????</span>
              </a>
            </li>
            <li>
              <a href="../reports.php">
              <i class="fa fa-print" aria-hidden="true"></i> <span><?php echo $expr['printreport'] ?> ?? ??????????????????????</span>
              </a>
            </li>
            <?php if($_SESSION["permission_des"] == 'admin') {?>
            <li>
              <a href="emergency.php">
              <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span>?????????? ??????????????</span>
              </a>
            </li>
            <?php } ?>
            <!-- <li>
              <a href="">
              <i class="fa fa-plus" aria-hidden="true"></i> <span><?php //echo $expr['carretrieval'] ?></span>
              </a>
            </li> -->
            <li class="treeview">
              <a href="#">
              <i class="fa fa-language"></i>
                <span><?php echo $expr['languages'] ?></span>
                <i class="fa fa-angle-left pull-<?php echo $expr['right'] ?>"></i>
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
    
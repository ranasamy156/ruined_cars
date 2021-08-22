<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-<?php echo $expr['right'] ?> image">
              <img src="dist/img/new.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-<?php echo $expr['left'] ?> info">
              <p><?php echo $_SESSION['name']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $expr['online'] ?></a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="active treeview">
              <a href="../index.php?id=<?php echo $_SESSION['id'] ?>">
                <i class="fa fa-dashboard"></i> <span><?php echo $expr['mainmenu'] ?></span> <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i>
              </a>
            </li>
            <?php if($_SESSION["permission_des"] == 'admin') {?>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-users"></i>
                <span><?php echo $expr['managerusers'] ?></span>
                <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['right'] ?>"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="adddetails.php"><i class="fa fa-circle-o"></i> <?php echo $expr['addusers'] ?></a></li>
                <li><a href="userlist.php"><i class="fa fa-circle-o"></i><?php echo $expr['userlist'] ?></a></li>
              </ul>
            </li>
            <?php }?>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-tasks"></i>
                <span><?php echo $expr['manageprocedures'] ?></span>
                <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['right'] ?>"></i>
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
                <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['right'] ?>"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="addstatus.php"><i class="fa fa-circle-o"></i><?php echo $expr['addstatus'] ?></a></li>
                <li><a href="reqlist.php"><i class="fa fa-circle-o"></i> <?php echo $expr['statuslist'] ?> </a></li>
              </ul>
            </li>
            <li>
            <!-- <?php
                // include_once '../database.php';
                // $req1 = new Database();
                // $rs = $req1->GetData("select rq.* ,st.description as status_name ,us.name from request rq ,statuses st, users us where rq.user_id = us.id and rq.status_id=st.id and rq.updated_at < now() - interval 7 DAY order by rq.id desc");
                // $pen = $rs->num_rows;
                ?>
              <a href="pending.php">
             <i class="fa fa-hourglass-half" aria-hidden="true"></i> <span><?php //echo $expr['pendingrequests'] ?></span> <span class="badge badge-danger"><?php //echo $pen; ?></span>
              </a>
            </li> -->
            <li>
              <a href="closed.php">
              <i class="fa fa-times-circle" aria-hidden="true"></i> <span><?php echo $expr['closedrequests'] ?></span>
              </a>
            </li>
            <li>
              <a href="direct.php">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> <span>الطلبات الفورية</span>
              </a>
            </li>
            <li>
              <a href="lifting_procedures.php">
              <i class="fa fa-align-justify" aria-hidden="true"></i> <span>محاضر الرفع</span>
              </a>
            </li>
            <li>
              <a href="../reports.php">
              <i class="fa fa-print" aria-hidden="true"></i> <span><?php echo $expr['printreport'] ?> و الاستعلامات</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
              <i class="fa fa-language"></i>
                <span><?php echo $expr['languages'] ?></span>
                <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['right'] ?>"></i>
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
    
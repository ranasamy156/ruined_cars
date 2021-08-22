<?php
include 'lang.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "2"){

?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['mainmenu'] ?></title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php if($expr['direction'] == 'rtl'){ ?>
      <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <!-- <link rel="stylesheet" href="dist/fonts/fonts-fa.css"> -->
      <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
      <link rel="stylesheet" href="dist/css/rtl.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
          folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <?php }else{ ?>
       <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <!-- <link rel="stylesheet" href="dist/fonts/fonts-fa.css"> -->
      <link rel="stylesheet" href="disten/css/bootstrap-rtl.min.css">
      <link rel="stylesheet" href="disten/css/rtl.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="disten/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
          folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="disten/css/skins/_all-skins.min.css">
    <?php
     }?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
    <style>
      
        @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
        /* font-family: 'Amiri', serif; */
.navbar-nav>.user-menu>.dropdown-menu>li.user-header>p {
    z-index: 5;
    color: #fff;
    color: black;
    font-size: 17px;
    margin-top: 10px;
}
.navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
}
    </style>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
        }

        a {
            color: black;
        }
    </style>
  </head>

  <body class="skin-green sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;text-align:<?php echo $expr['align']?>">
    <div class="wrapper" >
    
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
                  include_once 'database.php';
                  $newdb = new Database();
                  $new = $newdb->GetData("select * from notification where seen = '0' and type_id = '2' ORDER BY id DESC");
                  $noti_rows = $new->num_rows;
                  if($rownot = mysqli_fetch_assoc($new)){
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
                      <?php foreach ($new as $rownot) { ?>
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
            <li>
              <a href="24-1-2021/photolist.php">
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i><i class="fa fa-picture-o" aria-hidden="true"></i> <span><?php echo $expr['slider'] ?></span>
              </a>
            </li>
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
            <li class="treeview">
              <a href="#">
              <i class="fa fa-newspaper-o"></i>
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i>
                <span><?php echo $expr['managenews'] ?></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="24-1-2021/news.php"><i class="fa fa-circle-o"></i><?php echo $expr['addnews'] ?> </a></li>
                <li><a href="24-1-2021/newslist.php"><i class="fa fa-circle-o"></i><?php echo $expr['newslist'] ?></a></li>
              </ul>
            </li>
            <li>
              <a href="24-1-2021/addcar.php">
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i><i class="fa fa-car" aria-hidden="true"></i> <span><?php echo $expr['cars'] ?></span>
              </a>
            </li>
            <?php
                // include_once 'database.php';
                // $pp = new Database();
                // $rzs = $pp->GetData("select rq.* ,st.description as status_name ,us.name from request rq ,statuses st, users us where rq.user_id = us.id and rq.status_id=st.id and rq.updated_at < now() - interval 7 DAY order by rq.id desc");
                // $pen = $rzs->num_rows;
                ?>
            <!-- <li>
              <a href="24-1-2021/pending.php">
              <i class="fa fa-angle-<?php //echo $expr['left'] ?> pull-<?php// echo $expr['left'] ?>"></i><i class="fa fa-hourglass-half" aria-hidden="true"></i> <span><?php //echo $expr['pendingrequests'] ?></span> 
              </a>
            </li>
            <li>
              <a href="24-1-2021/readytobeclosed.php">
              <i class="fa fa-angle-<?php// echo $expr['left'] ?> pull-<?php// echo $expr['left'] ?>"></i><i class="fa fa-clone" aria-hidden="true"></i> <span><?php// echo $expr['readytobeclosed'] ?></span> 
              </a>
            </li> -->
            <li>
              <a href="24-1-2021/closed.php">
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i><i class="fa fa-times-circle" aria-hidden="true"></i> <span><?php echo $expr['closedrequests'] ?></span> <!--<span class="badge badge-danger"><?php //echo $pen; ?></span>-->
              </a>
            </li>
            <li>
              <a href="24-1-2021/lifting_procedures.php">
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i><i class="fa fa-align-justify" aria-hidden="true"></i> <span>محاضر الرفع</span> <!--<span class="badge badge-danger"><?php //echo $pen; ?></span>-->
              </a>
            </li>
            <li>
              <a href="reports.php">
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i><i class="fa fa-print" aria-hidden="true"></i> <span><?php echo $expr['printreport'] ?> و الاستعلامات</span> <!--<span class="badge badge-danger"><?php //echo $pen; ?></span>-->
              </a>
            </li>
            <?php if($_SESSION["permission_des"] == 'admin') {?>
            <li>
              <a href="24-1-2021/emergency.php">
              <i class="fa fa-angle-<?php echo $expr['left'] ?> pull-<?php echo $expr['left'] ?>"></i><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span>حالات الطوارئ</span> <!--<span class="badge badge-danger"><?php //echo $pen; ?></span>-->
              </a>
            </li>
            <?php } ?>
            <!-- <li>
              <a href="">
              <i class="fa fa-angle-<?php //echo $expr['left'] ?> pull-<?php //echo $expr['left'] ?>"></i><i class="fa fa-plus" aria-hidden="true"></i> <span><?php //echo $expr['carretrieval'] ?></span>
              </a>
            </li> -->
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

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      
        <!-- Main content -->
        <section class="content">
        <h2 style="font-family: 'Amiri' , serif;text-align:center;">التقارير و الاستعلامات</h2>
          <div class="row">
            <div class="col-md-12 m-auto">
                <div class="table-responsive print-container">
                    <table class="table" style="font-size: large;">
                        <tbody>
                            <td><a target="_blank" href="report.php">تقرير بالتاريخ و المدة</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportarea.php">تقرير بالحي و البلدية</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportrequests.php?n=0"><?php echo $expr['printrequests'] ?></a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportcars.php?n=13">تقرير الطلبات المقبولة</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportcars.php?n=14">تقرير سيارات جاهزة للرفع (مضى عليها 15 يوم)</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportrequests.php?n=1">تقرير السيارات المحجوزة (خلال 90 يوم)</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportrequests.php?n=2">تقرير السيارات الجاهزة للفسح (مضى عليها 90 يوم)</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportrefused.php">تقرير الطلبات المرفوضة</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportcars.php?n=17">تقرير طلبات الموافقة الضمنية</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportcars.php?n=24">تقرير سيارات تم استرجاعها للمالك</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportcars.php?n=25">تقرير سيارات تم نقل ملكيتها للمقاول</a></td>
                        </tbody>
                        <tbody>
                            <td><a target="_blank" href="reportcars.php?n=26">تقرير طلبات تم وقف العمل عليها</a></td>
                        </tbody>
                    </table>
                </div>
            </div>

          </div>
          <!-- Main row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-left hidden-xs">
          <b>Version</b> 2.2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://alsaifco.net/ar">Al-saif</a>.</strong> All rights reserved.
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.4 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
  <!-- <script type="text/javascript">
    $(function() {
        $('#searchselect').change(function(){
          var val=$(this).val()
            var res = val.split("_");
            console.log(res[0]);
            $('.weight').hide();
            $('#' + res[0]).show();
        });
    });
</script> -->
  </html>
  <?php
} }else {
  header('location:http://alsaifit.com/');
}
?>

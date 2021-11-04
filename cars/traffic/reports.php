<?php
include 'lang.php';
include '../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "4"){
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['mainmenu'] ?></title>

    <?php include 'layout.php'; ?>
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

  <body class="skin-red sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;text-align:<?php echo $expr['align']?>">
    <div class="wrapper" >
    
    <?php include 'header.php'; ?>

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

    <?php include 'layoutjs.php'; ?>
  </body>
  </html>
  <?php
} }else {
  header('location:http://alsaifit.com/');
}
?>

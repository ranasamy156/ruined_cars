<?php
include 'lang.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "2") {

?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['cardetails'] ?></title>
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
    <style>
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
}
        @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
        /* font-family: 'Amiri', serif; */
.navbar-nav>.user-menu>.dropdown-menu>li.user-header>p {
    z-index: 5;
    color: #fff;
    color: black;
    font-size: 17px;
    margin-top: 10px;
}
.adminpanel{
        width:100%;
        color:#000;
        margin:30px auto 0;
        padding:50px;
        border:1px solid #ddd;
        text-align:left;
      font-size: 14px;
      margin-top: 0px;
    background-color: white;
        }
        .fa-search{
      color:white;
    }
    .box.box-info {
    border-top-color: white;
}
    </style>
  </head>

  <body class="skin-green sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
    <div class="wrapper">
      <?php
        include_once 'header.php';
      ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php
        include_once 'aside.php';
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <div class="adminpanel">
      <h2 style="text-align:<?php echo $expr['align']?>"><?php echo $expr['edit']?> <?php echo $expr['carmodel'] ?></h2>
      <form method="post">
      <?php
            $sql = "CALL getCarModelByID(?)";
            $itemID = $_GET['n'];

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$itemID,PDO::PARAM_INT);
            $stmt->execute();
            $row2 = $stmt->fetch();
      ?>
      <div>
      <div style="margin-top:65px;">
      <select name="model" style="float:<?php echo $expr['right'] ?>;" disabled>  
        <option value="<?php echo($row2['manufacture_id']); ?>" ><?php echo($row2['man_name']); ?></option>
      </select>
      </div>
      <div>
        <input type="text" value="<?php echo($row2['name']); ?>" name="mod" maxlength="400" style="width: 100%;margin-top:15px; height: 50px;font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
      </div>
      <div>
        <input type="text" value="<?php echo($row2['en_name']); ?>" name="enmod" maxlength="400" style="width: 100%;margin-top:15px; height: 50px;font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
      </div>
      </div>
        <div class="box-footer clearfix">
            <button class="pull-<?php echo $expr['left'] ?> btn btn-default" name="btnupdate"><?php echo $expr['save'] ?> <i class="fa fa-arrow-circle-<?php echo $expr['left'] ?>"></i></button>
        </div>
            </div>
            <?php
                    if(isset($_POST["btnupdate"]))
                    {
                      $sql = "CALL updateCarModel(?,?,?)";
                      $model = $_POST['mod'];
                      $enmod = $_POST['enmod'];
                      $itemID = $_GET['n'];
          
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(1,$model,PDO::PARAM_STR, 100);
                      $stmt->bindParam(2,$enmod,PDO::PARAM_STR, 100);
                      $stmt->bindParam(3,$itemID,PDO::PARAM_INT);
                      $rs = $stmt->execute();
                      if($rs){
                      echo "<meta http-equiv='refresh' content='0.1'>";
                      }
                    }    
        
            ?>
            </div>
            </form>
          </div>
      </div>
      </div>
        <!-- Content Header (Page header) -->

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

  </html>
  <?php
}   } else {
    header('location:http://alsaifit.com/');
  }
?>
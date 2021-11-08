<?php
include 'lang.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["permission_des"] == 'admin' && $_SESSION["type_id"] == "1") {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['addusers'] ?></title>
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
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
.adminpanel{
        width:100%;
        color:#000;
        margin:30px auto 0;
        padding:50px;
        border:1px solid #ddd;
        text-align:left;
      font-size: medium;
      margin-top: 0px;
    background-color: white;
    text-align:right;
        }
        .fa-search{
      color:white;
    }
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
}

    </style>
  </head>

  <body class="skin-blue sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
    <div class="wrapper" >
      <?php
        include_once 'header.php';
      ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php
        include_once 'aside.php';
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" >
            <form method="post">
          <div class="adminpanel" >
          <h2 style="font-family:'Amiri', serif;text-align:center;margin-top:-15px;margin-bottom:35px;"><?php echo $expr['addusers'] ?></h2>
          <table style="width:100%">
            <tr>
              <td style="width:180px;"><?php echo $expr['usname'] ?></td>
              <td><input style="width:220px;" type="text" name="name" required autocomplete="name"></td>
            </tr>
            <tr>
              <td style="width:180px;"><?php echo $expr['usphone'] ?></td>
              <td><input style="width:150px;" type="text" name="phone" required autocomplete="phone"></td>
            </tr>
            <tr>
              <td style="width:180px;"><?php echo $expr['usemail'] ?></td>
              <td><input style="width:150px;" type="text" name="username" required autocomplete="username"></td>
            </tr>
            <tr>
              <td style="width:180px;"><?php echo $expr['uspass'] ?></td>
              <td><input style="width:150px;" type="password" name="password" required autocomplete="password"></td>
            </tr>
            <tr>
              <td style="width:180px;"><?php echo $expr['usconpass'] ?></td>
              <td><input style="width:150px;" type="password" name="confirm" required autocomplete="confirm"></td>
            </tr>
          </table>
          <div>
          <button class="btn btn-primary" name="btnadd" style="margin-top: 15px;margin-right: 120px;"><?php echo $expr['add'] ?></button>
          </div>
            <?php
              if(isset($_POST["btnadd"]))
              {
                // $p="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
                // if(preg_match($p,$_POST["password"]))
                // {

                  if($_POST["password"] == $_POST["confirm"])
                  {
                    $name = $_POST["name"];
                    $phone = $_POST["phone"];
                    $userName = $_POST["username"];
                    $pass = $_POST["password"];
                    $typeID = $_SESSION['type_id'];
                    $sql = "CALL insertUsers(? , ? , ? , ? , ?)";

                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $name, PDO::PARAM_STR, 100);
                    $stmt->bindParam(2, $phone, PDO::PARAM_STR, 100);
                    $stmt->bindParam(3, $userName, PDO::PARAM_STR, 100);
                    $stmt->bindParam(4, $pass, PDO::PARAM_STR, 100);
                    $stmt->bindParam(5, $typeID, PDO::PARAM_INT);
                    $rs = $stmt->execute();
                    if($rs){

                      echo("<div class='alert alert-success'>" .$expr['addsuccess']. "</div>");	
                    }else{
                      echo("<div class='alert alert-danger'>اسم المستخدم او رقم الجوال تم استخدامهم سابقا</div>");
                      
                    }
                  }else {
                    echo("<div class='alert alert-danger'>" .$expr['confirmpassmessage']. "</div>");

                  }
                }
              
                // else
                // {
                //   echo("<div class='alert alert-danger'> Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</div>");
                // }
              ?>
              
			</form>			
          
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
  }else {
    header('location:../index.php');
} } else {
  header('location:http://alsaifit.com/');
}
?>
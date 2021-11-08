<?php
include 'lang.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['statuslist'] ?></title>
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
    <style>
      .box.box-info {
        border-top-color: white;
      margin-top: 50px;
          
      }
      
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <style>
        @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
        /* font-family: 'Amiri', serif; */
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
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
        text-align:right;
      font-size: 14px;
      margin-top: 0px;
    background-color: white;
        }
        .fa-search{
      color:white;
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
      <div class="container  mt-5">
      
      <div class="adminpanel">
      <h3 style="margin-top: -30px;font-size: x-large;font-family:'Amiri', serif;" class="navbar-brand"><?php echo $expr['addstatus'] ?></h3>
          <div class="box box-info" style="text-align:center;">
            <div class="box-body">
              <form method="post">
                <div>
                  <input type="text" name="des" placeholder="<?php echo $expr['statusadd'] ?>" maxlength="400" style="width: 100%; height: 125px; font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-left btn btn-default" name="btnsave"><?php echo $expr['save'] ?> <i class="fa fa-arrow-circle-left"></i></button>
                </div>
                <?php
                    if(isset($_POST["btnsave"]))
                    {
                      $desc = $_POST["des"];
                      $userID = $_SESSION['id'];

                      $sql = "CALL insertStatuses(? , ?)";
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(1, $desc, PDO::PARAM_STR, 100);
                      $stmt->bindParam(2, $userID, PDO::PARAM_INT);
                      $msg = $stmt->execute();
                          if($msg){
                           // echo("<script> window.open('reqlist.php' , '_self') </script>");
                            echo("<div class='alert alert-success'>".$expr['statussuccess']."</div>");
                          }
                          else
                            echo("<div class='alert alert-danger'> Error is ".$msg."</div>");	
                      }
                    ?>
              </form>
            </div>
          </div>
      
        <!-- Content Header (Page header) -->

        <?php require 'layoutjs.php'; ?>
  </body>

  </html>
<?php
} else {
  header('location:http://alsaifit.com/');
}
?>

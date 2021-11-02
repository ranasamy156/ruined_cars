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
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
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
      <h2 style="text-align:<?php echo $expr['align']?>"><?php echo $expr['edit']?> <?php echo $expr['carman'] ?></h2>
      <form method="post">
          <?php
            $sql = "CALL getCarManufactureByID(?)";
            $itemID = $_GET['n'];

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$itemID,PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();
          ?>
          
          <div class="box box-info" style="text-align:center;">
            <div class="box-body">
                <div>
                  <input type="text" name="manf" value="<?php echo $row['name']; ?>" maxlength="400" style="width: 100%;margin: 15px; height: 50px;font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                </div>
                <div>
                  <input type="text" name="armanf" value="<?php echo $row['ar_name']; ?>" maxlength="400" style="width: 100%;margin: 15px; height: 50px;font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-<?php echo $expr['left']?> btn btn-default" name="btnupdate"><?php echo $expr['save'] ?> <i class="fa fa-arrow-circle-<?php echo $expr['left']?>"></i></button>
                </div>
            </div>
                <?php
                    if(isset($_POST["btnupdate"]))
                    {
                      $sql = "CALL updateCarManufacture(?,?,?)";
                      $manf = $_POST['manf'];
                      $armanf = $_POST['armanf'];
                      $itemID = $_GET['n'];
          
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(1,$manf,PDO::PARAM_STR, 100);
                      $stmt->bindParam(2,$armanf,PDO::PARAM_STR, 100);
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

        <?php require 'layoutjs.php'; ?>
  </body>

  </html>
  <?php
 }  } else {
    header('location:http://alsaifit.com/');
  }
?>
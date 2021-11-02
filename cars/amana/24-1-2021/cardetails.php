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
    </style>
  </head>

  <body class="skin-green sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
    <div class="wrapper" >
      <?php
        include_once 'header.php';
      ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php
        include_once 'aside.php';
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <?php
          $sql = "CALL getCarModelsByManID(?)";
          $itemID = $_GET['n'];

          $stmt = $conn->prepare($sql);
          $stmt->bindParam(1, $itemID, PDO::PARAM_INT);
          $stmt->execute();
        ?>

            <form method="post">
          <div class="adminpanel">
          <h2 style="font-family:'Amiri', serif;text-align:<?php echo $expr['align'] ?>;"><?php echo $expr['cardetails'] ?></h2>
          <a style="float:left;" href="reportcarmodel.php?n=<?php echo $_GET['n']; ?>" class="btn btn-default">طباعة تقرير</a>
          <table style="text-align:<?php echo $expr['align'] ?>;font-size:medium;" class="table table-borderd table-striped">
          <thead>
              <th><?php echo $expr['carmodel'] ?></th>
              <th><?php echo $expr['carmodel'] ?></th>
              <th><?php echo $expr['releaseyear'] ?></th>
              <th><?php echo $expr['edit'] ?></th>
              <th><?php echo $expr['remove'] ?></th>
            </thead>
          <?php foreach($stmt as $row){ ?>
            <tbody>
              <td> <?php echo ($row["name"]); ?> </td>
              <td> <?php echo ($row["en_name"]); ?> </td>
              <td> <?php echo ($row["release_year"]); ?>  </td>
              <td> <a href="editcarmodel.php?n=<?php echo ($row['id'])?>"><?php echo $expr['edit'] ?></a> </td>
              <td> <a href="#"><?php echo $expr['remove'] ?></a> </td>
            </tbody>
            <?php
                      }
                        ?>
            </table>
            </form>
					
          </table>
          </div>
      
        <!-- Content Header (Page header) -->

        <?php require 'layoutjs.php'; ?>
  </body>

  </html>
  <?php
  } } else {
    header('location:http://alsaifit.com/');
}
?>
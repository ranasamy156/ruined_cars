<?php
include 'lang.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "4"){
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['prolist']?></title>
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
    <style>
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
}
      .icons {
        color: #AF121E;
        width: 500px;
        height: 200px;
        border: 5px solid #AF121E;
      }
      .row {
        margin-right: 100px;
        /* margin-left: -100px; */
        padding: 20px;
        padding-right: 60px;
        padding-top: 0px;
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
        text-align:<?php echo $expr['align'] ?>;
      font-size: medium;
      margin-top: 0px;
    background-color: white;
        }
        .fa-search{
      color:white;
    }
    </style>
  </head>

  <body class="skin-red sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
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
      
      
      <div class="adminpanel">
      <div class="table-responsive">
      <h3 style="font-size:x-large;font-family:'Amiri', serif;" class="navbar-brand"><?php echo $expr['prolist'] ?></h3>
      <table style="text-align:<?php echo $expr['align'] ?>;width:100%" class="table table-borderd table-striped">
                <thead>
                  <tr>
                  <th scope="col"><?php echo $expr['procedure']; ?></th>
                    <th scope="col"><?php echo $expr['remove']; ?></th>
                  </tr>
                </thead>
                <?php
                $typeID = $_SESSION['type_id'];
                $sql = "CALL getProcedures(?)";
            
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $typeID, PDO::PARAM_INT);
                $stmt->execute();
                foreach ($stmt as $row){
                  ?>
              <tbody>
                <tr>
              
                  <th scope="row"><?php echo ($row["description"]); ?></th>
                  <td><a href="delpro.php?n=<?php echo ($row["id"]); ?>"><?php echo $expr['remove']; ?></a></td>
                </tr>
              </tbody>
              <?php
                }
                  ?>
              </table>
      </div>
        <!-- Content Header (Page header) -->

        <?php require 'layoutjs.php'; ?>
  </body>

  </html>
<?php
} }else {
  header('location:http://alsaifit.com/');
}
?>

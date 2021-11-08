<?php
include 'lang.php';
include_once '../hijri.php';
include '../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "1"){
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['mainmenu'] ?></title>
    <?php require 'layout.php'; ?>
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
  </head>

  <body class="skin-blue sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;text-align:<?php echo $expr['align']?>">
    <div class="wrapper" >
    
    <?php include 'header.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="font-family:'Amiri', serif;">
            <?php echo $expr['controlpanel'] ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i><?php echo $expr['mainmenu'] ?></a></li>
            <li class="active"><?php echo $expr['controlpanel'] ?></li>
          </ol>
        </section>
        <div class="search-container">
        <form method="post">
          <div class="row">
              <div class="col-xs-3">
                <label for="txtsearch">بحث</label>
                <input type="text" placeholder="<?php echo $expr['search'] ?>" class="form-control" name="txtsearch">
              </div>
              <div class="col-xs-3">
                <label for="date1">من</label>
                <input type="date" class="form-control" name="date1">
              </div>
              <div class="col-xs-3">
                <label for="date2">الى</label>
                <input type="date" class="form-control" name="date2">
              </div>
              <div class="col-xs-1">
                <button type="submit" style="margin-top:15px;margin-<?php echo $expr['right'] ?>:15px;" class="btn btn-default" name="search"><i class="glyphicon glyphicon-search"></i></button>
                <?php                    
                    if(isset($_POST["txtsearch"])){
                      if($_POST['txtsearch'] == null){
                        $x="null";
                      }else{
                        $x=$_POST["txtsearch"];
                      }
                        $f=date('Y-m-d',strtotime($_POST['date1']));
                        $t=date('Y-m-d',strtotime($_POST['date2']));
                        echo("<script> window.open('searchresults.php?n=$x&f=$f&t=$t' , '_self') </script>");
                    }
                ?>
              </div>
          </div>
        </form>
      </div>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                <?php
                  $sql = "CALL getRequests()";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  
                  $num =$stmt->rowCount();
                ?>
                  <h3><?php echo $num ?></h3>
                  <p><?php echo $expr['numberofrequests'] ?></p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer"><?php echo $expr['show'] ?> <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                <?php
                    $sql = "CALL getReservedCarsNum()";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    
                    $bk =$stmt->rowCount();
                ?>
                  <h3><?php echo $bk ?></h3>
                  <p><?php echo $expr['rate'] ?></p>
                </div>
                <div class="icon" dir="<?php echo $expr['direction'] ?>">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer"><?php echo $expr['show'] ?> <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                <?php
                $sql = "CALL getAllUsers()";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
                $users_num =$stmt->rowCount();
                ?>
                  <h3><?php echo $users_num ?></h3>
                  <p><?php echo $expr['numberofusers'] ?></p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer"><?php echo $expr['show'] ?> <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box" style="background-color: #5B5BF0;color:white;">
                <div class="inner">
                <?php
                $sql = "CALL getReturnedCars()";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
                $bkk =$stmt->rowCount();
              ?>
                  <h3><?php echo $bkk ?></h3>
                  <p><?php echo $expr['statistics'] ?></p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer"><?php echo $expr['show'] ?> <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-md-12 m-auto">
              <table class="table bg-default">
                <thead>
                  <tr>
                    <th scope="col"><?php echo $expr['reqid'] ?></th>
                    <th scope="col"><?php echo $expr['createdon'] ?></th>
                    <th scope="col"><?php echo $expr['reqstatus'] ?></th>
                    <th scope="col"><?php echo $expr['requser'] ?></th>
                    <th scope="col"><?php echo $expr['platenum'] ?></th>
                    <th scope="col"><?php echo $expr['chassis'] ?></th>
                    <th scope="col"><?php echo $expr['reqdetails'] ?></th>
                  </tr>
                </thead>
                <?php
                $sql = "CALL searchQuery(? , ? , ?)";
                $stmt = $conn->prepare($sql);
                $f = $_GET["f"];
                $t = $_GET["t"];
                $word = $_GET["n"];
                $stmt->bindParam(1, $word, PDO::PARAM_STR, 100);
                $stmt->bindParam(2, $f, PDO::PARAM_STR, 100);
                $stmt->bindParam(3, $t, PDO::PARAM_STR, 100);
                $stmt->execute();

                  foreach ($stmt as $row) {
                    $date = (new hijri\datetime($row['created_at'], NULL,"ar" ))->format("D _j _F _Y هـ");

                ?>
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo ($row["id"]); ?></th>
                        <td><?php echo ($date); ?></td>
                        <td><?php echo ($row["status_name"]) ?></td>
                        <td><?php echo ($row["name"]) ?></td>
                        <td><?php echo ($row["plate_number"]); ?></td>
                        <td><?php echo ($row["chassis"]); ?></td>
                        <td><a style="text-align: center;text-decoration: none;color: black;" href="24-1-2021/request.php?n=<?php echo ($row["id"]); ?>"><p>&#8592;</p></a></td>
                      </tr>
                    </tbody>
                <?php
                  }
                ?>
              </table>
            </div>

          </div>
          <!-- Main row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-left hidden-xs">
          <b>Version</b> 2.2.0
        </div>
        <strong>Copyright &copy; 2021 <a href="">Al-saif</a>.</strong> All rights reserved.
      </footer>
      <!-- Add the sidebar's background. This div must be placed
          immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <?php require 'layoutjs.php'; ?>
  </body>

  </html>
<?php
} else {
  header('location:http://www.alsaifit.com');
}
} else {
  header('location:http://www.alsaifit.com');
}
?>

<?php
include 'lang.php';
include_once '../../hijri.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "2") {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['pendingrequests'] ?></title>
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
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

  <body class="skin-green sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;text-align:<?php echo $expr['align']?>">
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

        <!-- Main content -->
        <section class="content">
        <div class="row">
        <?php
          $sql = "CALL getNumberOfAccept()";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $row2 = $stmt->fetch();
        ?>

          <div class="row">
            <div class="col-md-12 m-auto">
                <div class="table-responsive">
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
                $sql = "CALL getDirectRequests()";
                $stmt = $conn->prepare($sql);
                $rs = $stmt->execute();
                
                if ($rs == 1) {
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
                        <td><a style="text-align: center;text-decoration: none;color: black;" href="request.php?n=<?php echo ($row["id"]); ?>"><p>&#8592;</p></a></td>
                      </tr>
                    </tbody>
                <?php
                  }  
                } else {
                  ?>
                  <tbody>
                      <tr>
                        <th scope="row"><?php echo ($expr["norequests"]); ?></th>
                      </tr>
                    </tbody>
                    <?php
                } ?>
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

    <?php require 'layoutjs.php'; ?>
    <script>
      $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
    </script>
  </body>

  </html>
<?php
 } }else{
  header('location:http://alsaifit.com/');
}
?>

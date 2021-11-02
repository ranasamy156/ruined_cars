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
    <title><?php echo $expr['carslist'] ?></title>
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
              font-size: 14px;
              margin-top: 0px;
            background-color: white;
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
            <form method="post">
          <div class="adminpanel">
          <div><h3 style="font-size:x-large;text-align:center;font-family:'Amiri', serif;" class="navbar-brand" ><?php echo $expr['carslist'] ?></h3></div>
          <a style="float:left;margin:15px;" href="reportcar.php" class="btn btn-default">طباعة تقرير</a>

        <div class="row">
          <div class="col-md-12 m-auto">
          <div class="table-responsive">
        <table style="width:100%;text-align:<?php echo $expr['align'] ?>;" class="table bg-default">
        <thead>
                  <tr>
                    <th scope="col"><?php echo $expr['carnum'] ?></th>
                    <th scope="col" colspan="2"  style="text-align:center;"><?php echo $expr['carman'] ?></th>
                    <th scope="col"><?php echo $expr['edit'] ?></th>
                    <th scope="col"><?php echo $expr['remove'] ?></th>
                  </tr>
                </thead>
                <?php
                $sql = "CALL getCarManufactures()";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                foreach($stmt as $row){
                        ?>
                    <tbody>
                      <tr>
                        <td scope="row"><?php echo ($row["id"]); ?></td>
                        <td scope="row"><a href="cardetails.php?n=<?php echo ($row["id"]); ?>"><?php echo ($row["name"]); ?></a></td>
                        <td scope="row"><a href="cardetails.php?n=<?php echo ($row["id"]); ?>"><?php echo ($row["ar_name"]); ?></a></td>
                        <td scope="row"><a href="editcarman.php?n=<?php echo ($row["id"]); ?>"><?php echo $expr['edit'] ?></a></td>
                        <td scope="row"><a href=""><?php echo $expr['remove'] ?></a></td>
                      </tr>
                    </tbody>
                    <?php
                
                    }
                        ?>
            <tr>
            <td  style="text-align:<?php echo $expr['align'] ?>"><button class="btn btn-default" name="btnman"> <?php echo $expr['add'] ?> <?php echo $expr['carman'] ?></button></td>
            <td  style="text-align:<?php echo $expr['align'] ?>"><button class="btn btn-default" name="btnmo"><?php echo $expr['add'] ?> <?php echo $expr['carmodel'] ?></button></td>
                </tr>
                <?php
                
                if(isset($_POST['btnman'])){
                ?>
            </div>		
          </table>
          </div>
          </div>
          </div>
          <form method="post">
          <div class="box box-info" style="text-align:center;">
            <div class="box-body">
                <div>
                  <input type="text" name="manf" placeholder="<?php echo $expr['add'] ?> <?php echo $expr['carman'] ?>" maxlength="400" style="width: 100%; height: 50px;font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                </div>
                <div>
                  <input type="text" name="enmanf" placeholder="Add car manufacturer in english" maxlength="400" style="width: 100%;margin-top:15px; height: 50px;font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-<?php echo $expr['left'] ?> btn btn-default" name="btnsave"><?php echo $expr['save'] ?> <i class="fa fa-arrow-circle-<?php echo $expr['left'] ?>"></i></button>
                </div>
                <?php
                }
                    if(isset($_POST["btnsave"]))
                    {
                          $sql = "CALL insertCarManufacture(? , ?)";
                          $manf = $_POST['manf'];
                          $enmanf = $_POST['enmanf'];
              
                          $stmt = $conn->prepare($sql);
                          $stmt->bindParam(1, $manf, PDO::PARAM_STR, 100);
                          $stmt->bindParam(2, $enmanf, PDO::PARAM_STR, 100);
                          $rs = $stmt->execute();
                          if($rs){
                            echo("<div class='alert alert-success'>".$expr['carsuccess']."</div>");
                          }else{
                            echo("<div class='alert alert-danger'> Error </div>");	
                          }
                    }
                    if(isset($_POST['btnmo'])){
                          $sql = "CALL getCarManufactures()";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute();
                            
                      ?>
                      <div>
                      <div style="margin-top:65px;">
                      <select name="model" style="float:<?php echo $expr['right'] ?>;" required>
                        <option value="<?php echo $expr['choose'] ?> <?php echo $expr['carman'] ?>" selected disabled><?php echo $expr['choose'] ?> <?php echo $expr['carman'] ?></option>
                        <?php
                        foreach($stmt as $row1){
                          ?>
                        <option value="<?php echo($row1['id']); ?>" ><?php echo($row1['name']); ?></option>
                        <?php
                        }
                        ?>
                      </select>
                      </div>
                      <div>
                        <input type="text" name="mod" placeholder="<?php echo $expr['add'] ?> <?php echo $expr['carmodel'] ?>" maxlength="400" style="width: 100%;margin-top:15px; height: 50px;font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                      </div>
                      <div>
                        <input type="text" name="enmod" placeholder="Add car model in english" maxlength="400" style="width: 100%;margin-top:15px; height: 50px;font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                      </div>
                      </div>
                <div class="box-footer clearfix">
                  <button class="pull-left btn btn-default" name="savebtn"><?php echo $expr['save'] ?> <i class="fa fa-arrow-circle-<?php echo $expr['left'] ?>"></i></button>
                </div>
                    
                    <?php
                            
                    
                  }if(isset($_POST['savebtn'])){
                    $sql = "CALL insertCarModel(? , ? , ?)";
                    $typeID = $_POST['model'];
                    $model = $_POST['mod'];
                    $enmod = $_POST['enmod'];
        
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $typeID, PDO::PARAM_INT);
                    $stmt->bindParam(2, $model, PDO::PARAM_STR, 100);
                    $stmt->bindParam(3, $enmod, PDO::PARAM_STR, 100);
                    $rs = $stmt->execute();
                    if($rs){
                      echo("<div class='alert alert-success'>".$expr['carsuccess']."</div>");
                    }else{
                      echo("<div class='alert alert-danger'> Error </div>");	
                    }
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
} }else {
  header('location:http://alsaifit.com/');
}
?>

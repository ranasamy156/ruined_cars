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
    <title><?php echo $expr['mainmenu'] ?></title>
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
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
        }
    </style>
  </head>
  <body>
<div class="row">
    <div class="col-md-12 m-auto">
    <?php
                $itemID = $_GET['n'];

                $sql = "CALL getCarManufactureByID(?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $itemID, PDO::PARAM_INT);
                $stmt->execute();
                $row2 = $stmt->fetch();

                $sql = "CALL getCarModelsByManID(?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $itemID, PDO::PARAM_INT);
                $stmt->execute();
            ?>
    <button style="float:right;margin-left:15px;" onclick = "window.print()" class="btn btn-primary">طباعة تقرير</button>
<a style="float:left;margin-left:15px;" href="cardetails.php?n=<?php echo $_GET['n']; ?>" class="btn btn-success">رجوع للسيارات</a></br>
    <label for="myInputlabel" style="font-size:large;margin:15px;">بحث</label>
    <input class="form-control" id="myInput" style="width:50%" type="text" placeholder="بحث..">
  <br>
        <div class="table-responsive print-container">
        <h1><?php echo $row2['name']; ?></h1>
        <table class="table table-bordered">
            <thead>
            <tr>
              <th><?php echo $expr['carmodel'] ?></th>
              <th><?php echo $expr['releaseyear'] ?></th>
            </tr>
            </thead>
            <tbody id="myTable">
            <?php
                    foreach($stmt as $row){
            ?>
            <tr>
              <td><?php echo ($row["name"]); ?> </td>
              <td><?php echo ($row["release_year"]); ?></td>
            </tr>
            <?php
                        }
                        
                        ?>
                        <tr>
            </tbody>
        </table>
                    </div>
                </div>

          </div>
          <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
          </body>
          </html>
          <?php
    }else{
        header("location:alsaifit.com");
    } }else{
        header("location:alsaifit.com");
    }
          ?>
<?php
include 'lang.php';
include_once '../hijri.php';
include "../hijri/Hijri_GregorianConvert.php";
include '../database.php';
$DateConv=new Hijri_GregorianConvert;
if (isset($_SESSION["id"])) {
    if($_SESSION["type_id"] == "3") {
      $mapQuery = "CALL getAreas()";
      $stmt = $conn->prepare($mapQuery);
      $stmt->execute();
      
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['mainmenu'] ?></title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link href="../hijri/css/bootstrap.rtl.css" rel="stylesheet" />
    <link href="../hijri/css/bootstrap-datetimepicker.css" rel="stylesheet" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php if($expr['direction'] == 'rtl'){ ?>
      <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
      <!-- <link rel="stylesheet" href="../assets/dist/fonts/fonts-fa.css"> -->
      <link rel="stylesheet" href="../assets/dist/css/bootstrap-rtl.min.css">
      <link rel="stylesheet" href="../assets/dist/css/rtl.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
          folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
    <?php }else{ ?>
       <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
      <!-- <link rel="stylesheet" href="../assets/dist/fonts/fonts-fa.css"> -->
      <link rel="stylesheet" href="../assets/disten/css/bootstrap-rtl.min.css">
      <link rel="stylesheet" href="../assets/disten/css/rtl.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="../assets/disten/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
          folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="../assets/disten/css/skins/_all-skins.min.css">
    <?php
     }?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
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
                visibility: visible;
            }
            .print-container, .print-container * {
                visibility: hidden;
            }
        }
    </style>
  </head>
  <body style="font-family:'Amiri', serif;">
  <div class="row ">
        <div class="col-xs-6">
            <h3 style="text-align:center;font-family:'Amiri', serif;padding: 40px;">مشروع السيارات الخربة</h3>
        </div>
        <div class="col-xs-6">
        <center><img src="../images/logo.png" width="200px" height="170px"></center>
        </div>
  </div>
  <center><h2 class="" style="font-family:'Amiri', serif">تقرير بطلبات المدن و البلديات</h2></center>
  <form autocomplete="off" method="post">
<div class="row">
    <div class="col-xs-2 print-container">
        <select name="area" id="areaselect" class="form-control">
            <option value="none" selected disabled>اختر الحي</option>
            <?php foreach($stmt as $rowarea){ ?>
            <option value="<?php echo $rowarea['id'] ?>"><?php echo $rowarea['name'] ?></option>    
            <?php } ?>
        </select>
    </div>
    <div class="col-xs-2 print-container">
      <input class="form-control" name="baladya" type="text" placeholder="ادخل البلدية">
    </div>
    <div class="col-xs-1 print-container">
      <label style="float:left;">من</label>
    </div>
    <div class="col-xs-2 print-container">
      <input class="form-control hijri-date-input" required type="text" name="from">
    </div>
    <div class="col-xs-1 print-container">
      <label style="float:left;">الي</label>
    </div>
    <div class="col-xs-2 print-container">
      <input class="form-control hijri-date-input" required type="text" name="to">
    </div>
    <div class="col-xs-1 print-container">
      <button style="float:left;margin-left:15px;" name="se" class="btn btn-success"><i class="fa fa-search"></i></button>
    </div>
    <div class="col-xs-1 print-container">
      <button style="float:left;margin-left:15px;" onclick = "window.print()" class="btn btn-danger"><i class="fa fa-print"></i></button>
    </div>
    <?php
      if(isset($_POST['se'])){
        $ex = explode("-", $_POST['from']);
      if($ex[0] <= 1900){
          $format="YYYY-MM-DD";
          $result=$DateConv->HijriToGregorian($_POST['from'],$format);
          $result2=$DateConv->HijriToGregorian($_POST['to'],$format);
      }elseif($ex[0] > 1900){
          $result=$_POST['from'];
          $result2=$_POST['to'];
      }
        // $f = $_POST['from'];
        // $t = $_POST['to'];
        // echo ("<script> window.open('reportcarsse.php?f=$f&t=$t' , '_self') </script>");
      
    ?>
    <div class="col-md-12">
        <div class="">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align:center;"><?php echo $expr['reqid'] ?></th>
                <th style="text-align:center;">المحضر</th>
                <th style="text-align:center;"><?php echo $expr['createdon'] ?></th>
                <th style="text-align:center;"><?php echo $expr['carman'] ?></th>
                <th style="text-align:center;"><?php echo $expr['platenum'] ?></th>
                <th style="text-align:center;"><?php echo $expr['chassis'] ?></th>
                <th style="text-align:center;"><?php echo $expr['reqstatus'] ?></th>
                <th style="text-align:center;">بلدية</th>
                <th class="print-container" style="text-align:center;" scope="col"><?php echo $expr['reqdetails'] ?></th>
                

            </tr>
            </thead>
            <tbody id="myTable">
            <?php
              $baladeya = $_POST['baladya'];
              $areaID = $_POST['area'];
              $sql = "CALL searchAreaReport(? , ? , ? ,?)";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(1, $result, PDO::PARAM_STR, 100);
              $stmt->bindParam(2, $result2, PDO::PARAM_STR, 100);
              $stmt->bindParam(3, $baladeya, PDO::PARAM_STR, 100);
              $stmt->bindParam(4, $areaID, PDO::PARAM_INT);
              $stmt->execute();

              foreach ($stmt as $row) {
                $date = (new hijri\datetime($row['created_at'], NULL,"ar" ))->format("D _j _F _Y هـ");

            ?>
            <tr>
                <th style="text-align:center;"><?php echo ($row["id"]); ?></th>
                <th style="text-align:center;"><?php echo ($row["lifting_procedure"]); ?></th>
                <td style="text-align:center;"><?php echo ($date); ?></td>
                <td style="text-align:center;"><?php echo ($row["man_arname"]); ?> <?php echo ($row["model_arname"]); ?></td>
                <td style="text-align:center;"><?php echo ($row["plate_number"]); ?></td>
                <td style="text-align:center;"><?php echo ($row["chassis"]); ?></td>
                <td style="text-align:center;"><?php echo ($row["status_name"]) ?></td>
                <td style="text-align:center;"><?php echo ($row["baladya"]); ?></td>
                <td class="print-container"><a style="text-align: center;text-decoration: none;color: black;" href="24-1-2021/request.php?n=<?php echo ($row["id"]); ?>"><p>&#8592;</p></a></td>

            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
                    </div>
                </div>
          </div>
          <footer class="" style="border-top: double; bottom : 0;
     height:60px;
     margin-top : 40px;
     text-align: center ;
     font-size: 10px ;
     font-family: 'Lato' ;">
        <h5>امانة منطقة المدينة المنورة</h5>
  </footer>
          <?php } ?>
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
         <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('#areaselect').select2();
</script>
<script src="../hijri/js/jquery-3.3.1.js"></script>
    <script src="../hijri/js/bootstrap.js"></script>
    <script src="../hijri/js/momentjs.js"></script>
    <script src="../hijri/js/moment-with-locales.js"></script>
    <script src="../hijri/js/moment-hijri.js"></script>
    <script src="../hijri/js/bootstrap-hijri-datetimepicker.js"></script>

    <script type="text/javascript">


        $(function () {

            initHijrDatePicker();

            //initHijrDatePickerDefault();

            $('.disable-date').hijriDatePicker({

                minDate:"2020-01-01",
                maxDate:"2021-01-01",
                viewMode:"years",
                hijri:true,
                debug:true
            });

        });

        function initHijrDatePicker() {

            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "YYYY-MM-DD",
                hijriFormat:"iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
                showSwitcher: true,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode:'months',
                keepOpen: false,
                hijri: false,
                debug: true,
                showClear: true,
                showTodayButton: true,
                showClose: true
            });
        }

        function initHijrDatePickerDefault() {

            $(".hijri-date-input").hijriDatePicker();
        }


    </script>
</form>
          </body>
          </html>
  <?php
      
    }else{
      header('location:http://alsaifit.com/');
    } }else{
      header('location:http://alsaifit.com/');
    }
  ?>
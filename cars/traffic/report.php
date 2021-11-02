<?php
include 'lang.php';
include "../hijri/Hijri_GregorianConvert.php";
$DateConv=new Hijri_GregorianConvert;
include '../database.php';
if (isset($_SESSION["id"])) {
    if($_SESSION["type_id"] == "4") {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['mainmenu'] ?></title>
    <link href="../hijri/css/bootstrap.rtl.css" rel="stylesheet" />
    <link href="../hijri/css/bootstrap-datetimepicker.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
    <?php if($expr['direction'] == 'rtl'){ ?>
      <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
      <!-- <link rel="stylesheet" href="dist/fonts/fonts-fa.css"> -->
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
      <!-- <link rel="stylesheet" href="dist/fonts/fonts-fa.css"> -->
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
      body {
        direction: rtl;
      }
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
  <body style="font-family:'Amiri', serif;">
  <form method="post">
  <div class="row print-container">
        <div class="col-xs-6">
            <h3 style="text-align:center;font-family:'Amiri', serif;padding: 40px;">مشروع السيارات الخربة</h3>
        </div>
        <div class="col-xs-6">
        <center><img src="../images/logo.png" width="200px" height="170px"></center>
        </div>
  </div>
<div class="row">
    <div class="col-md-12 m-auto">
    <center><h3 class="print-container" style="font-family:'Amiri', serif;">طباعة تقرير بالمدة الزمنية</h3></center>
    <button style="float:left;margin-left:15px;" onclick = "window.print()" class="btn btn-primary"><?php echo $expr['printreport'] ?></button>
<div class="row">
    <div class="col-xs-3">
        <label for="date1">من</label>
        <input type="text" class="form-control hijri-date-input" required name="date1">
    </div>
    <div class="col-xs-3">
        <label for="date2">الى</label>
        <input type="text" class="form-control hijri-date-input" required name="date2">
    </div>
    <div class="col-xs-3">
      </br>
        <button class="btn btn-success" name="search"><i class="fa fa-search"></i></button>
    </div>
</div> <br>
<?php
if(isset($_POST['search'])){
    $ex = explode("-", $_POST['date1']);
      if($ex[0] <= 1900){
          $format="YYYY-MM-DD";
          $result=$DateConv->HijriToGregorian($_POST['date1'],$format);
          $result2=$DateConv->HijriToGregorian($_POST['date2'],$format);
      }elseif($ex[0] > 1900){
          $result=$_POST['date1'];
          $result2=$_POST['date2'];
      }

  $sql = "CALL searchReportByTime(? , ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $result, PDO::PARAM_STR, 100);
  $stmt->bindParam(2, $result2, PDO::PARAM_STR, 100);
  $stmt->execute();
  
?>
        <div class="table-responsive print-container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col"><?php echo $expr['reqid'] ?></th>
                <th scope="col"><?php echo $expr['createdon'] ?></th>
                <th scope="col"><?php echo $expr['reqstatus'] ?></th>
                <th scope="col"><?php echo $expr['platenum'] ?></th>
            </tr>
            </thead>
            <tbody id="myTable">
            <?php
                        foreach ($stmt as $row) {
                        ?>
            <tr>
                <th scope="row"><?php echo ($row["id"]); ?></th>
                <td><?php echo ($row["created_at"]); ?></td>
                <td><?php echo ($row["sts_name"]) ?></td>
                <td><?php echo ($row["plate_number"]); ?></td>
            </tr>
            <?php
                        }
                        } ?>
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
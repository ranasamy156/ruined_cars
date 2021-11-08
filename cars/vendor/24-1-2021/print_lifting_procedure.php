<?php
include 'lang.php';
include '../../hijri.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "1") {
    $reqID = $_GET['r'];
    $liftID =  $_GET['n'];

    $sql = "CALL getLiftingProcedureByID(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $liftID, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    $date = (new hijri\datetime($row['created_at'], NULL,"ar" ))->format("D _j _F _Y هـ h:i a");

    $mapQuery = "CALL getMapById(?)";
    $stmt = $conn->prepare($mapQuery);
    $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
    $stmt->execute();
    $rowmap = $stmt->fetch();
    
    
    if($rowmap['model_id'] == 0 && $rowmap['man_id'] == 0){
      $reqQuery = "CALL getReqById2(?)";
    }elseif($rowmap['man_id'] != 0 && $rowmap['model_id'] == 0){
      $reqQuery = "CALL getReqById3(?)";
    }else{
      $reqQuery = "CALL getReqById(?)";
    }
    try{

      $stmt = $conn->prepare($reqQuery);
      $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
      $stmt->execute();
      $row2 = $stmt->fetch();
      // print("<pre>".print_r($row2,true)."</pre>");
      // exit;
    }catch(PDOException $e){
      print("Exception".$e->getMessage());
    };
    

?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['mainmenu'] ?></title>
   <!-- CSS FILES --> 
   <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <style>
    @media print {
            body * {
                visibility: visible;
            }
            .print-container, .print-container * {
                visibility: hidden;
            }
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
        text-align:<?php echo $expr['align'] ?>;
      font-size: 12px;
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
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.progressbar li {
      list-style-type: none;
      width: 20%;
      float: <?php echo $expr['right'] ?>;
      font-size: 12px;
      position: relative;
      text-align: center;
      text-transform: uppercase;
      color: #7d7d7d;
  }
  .progressbar li:before {
      width: 30px;
      height: 30px;
      content: ' \2714';
      counter-increment: step;
      line-height: 30px;
      border: 2px solid #7d7d7d;
      display: block;
      text-align: center;
      margin: 0 auto 10px auto;
      border-radius: 50%;
      background-color: white;
  }
  .progressbar li:after {
      width: 100%;
      height: 2px;
      content: '';
      position: absolute;
      background-color: #7d7d7d;
      top: 15px;
      left: 50%;
      z-index: -1;
  }
  .progressbar li:first-child:after {
      content: none;
  }
  .progressbar li.active {
      color: green;
  }
  .progressbar li.active:before {
      border-color: #55b776;
  } 
  .progressbar li.active + li:after {
      background-color: #55b776;
  }

  .progressbar li.refuse {
      color: red;
      content: '\2715';
  }
  .progressbar li.refuse:before {
      border-color: #D60015;
      content: '\2715';
  } 
  .progressbar li.refuse + li:after {
      background-color: #D60015;
      content: '\2715';
  }

  .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    padding-right: 0; 
    padding-left: 0;
}
    </style>
  </head>

  <body class="skin-blue sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;font-size: 12px;">
      <form autocomplete="off" method="post">
      <!-- Content Wrapper. Contains page content -->
      <div class="row">
      <div class="col-xs-4">
          <h5 style="font-family:'Amiri', serif;text-align:center;">المملكة العربية السعودية</br>وزارة الشئون البلدية و القروية</br>امانة منطقة المدينة المنورة</br>وكالة الاستثمار</br>ادارة المنافسات الاستثمارية</h5>
      </div>
      <div class="col-xs-4">
        <center><img src="../../images/logo.png" width="75%" height="100%"></center>  
      </div>
      <div class="col-xs-4">
        <h5 style="font-family:'Amiri', serif;text-align:center">مؤسسة عين العرب للتجارة</h5><h6 style="font-family:'Amiri', serif;text-align:center">و المقاولات و صيانة و نظافة</br>و تأجير الونشات و الناقلات</br>المدينة المنورة شارع الامير عبد المجيد</br>جوار المرور - ت 0148382405</br>ت 0148381459 - فاكس 0148391258</br>ص.ب: 1677 الرمز 41441</h6>
      </div>
      </div>
        <div class="row">
          <div class="col-xs-1"></div>
          <div class="col-xs-3">            
            <h4>حالة الطلب: <?php echo $row2['sts_name'] ?></h4>
          </div>
          <div class="col-xs-4">            
            <h3 style="font-family:'Amiri'; text-align:center">محضر رفع للطلب رقم <?php echo $_GET['r'] ?></h3>
          </div><div class="col-xs-3">            
            <button onclick="window.print()" class="btn btn-primary print-container" style="float:left;">طباعة</button>
          </div>
          <div class="col-xs-1"></div>
        </div>
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <h5>إشارة للعقد رقم ٤٢/٠٣ بتاريخ ١٤٤٢/٠٢/٠٤ه المبرم بين أمانة المدينة المنورة ومؤسسة عين العرب للتجارة بخصوص جمع ورفع الأعيان الموضحة ادناه من مداخل المدينة المنورة وشوارعها العامة و الداخلية إلي موقع التجميع الخاص بالمؤسسة  وما تضمنه العقد من إلتزام الطرف الثاني برفع الأعيان طبقاً لتعليمات الأمانة وبموجب محاضر يومية مايتم نقله تحت إشراف أمانة المدينة المنورة وبناءاً عليه فقد تم الوقوف على الطبيعة.</h5>
            </div>
            <div class="col-xs-1"></div>
        </div>
        <div class="row">
        <div class="col-xs-1"></div>
          <div class="col-xs-5">
            <label for="date">التاريخ: </label>
            <?php echo $date ?>
          </div>
          <div class="col-xs-3">
            <label for="date">جري رفع: </label>
            <?php echo $row['type'] ?>
          </div>
          <div class="col-xs-3">
            <label for="date">من نطاق بلدية: </label>
            <?php echo $row2['baladya'] ?>
          </div>
        </div>
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <thead>
                    <th>النوع</th>
                    <th>رقم اللوحة</th>
                    <th>رقم الهيكل</th>
                    <th>اللون</th>
                    <th>الموقع</th>
                  </thead>
                  
                  <tbody>
                    <td><?php echo $row2['man_name'] ?> - <?php echo $row2['model_name'] ?></td>
                    <td><?php echo $row2['plate_number'] ?></td>
                    <td><?php echo $row2['chassis'] ?></td>
                    <td><div style=<?php echo "'width: 50px; height: 20px; background-color:#".$row2['color'].";text-align:".$expr['align']. "margin-right:45%;'";?>></div></td>
                    <td><?php echo $row2['st_name'] ?> - <?php echo $row2['ct_name'] ?> - <?php echo $row2['baladya'] ?> - <?php echo $row2['ar_name'] ?></td>
                  </tbody>
                  
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">الهيكل</th>
                    <th>السقف</td>
                    <th> الرفارف </td>
                    <th> الكبوت </td>
                  </tr>
                  <tr>
                    <td><?php echo $row['structure_top'] ?></td>
                    <td><?php echo $row['structure_fenders'] ?></td>
                    <td><?php echo $row['structure_engine_hood'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">الزجاج</th>
                    <th>الامامي</td>
                    <th> الخلفي </td>
                    <th> الجانبي </td>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_glass'] ?></td>
                    <td><?php echo $row['back_glass'] ?></td>
                    <td><?php echo $row['side_glass'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">الابواب</th>
                    <th>الامامية</td>
                    <th>الخلفية</td>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_doors'] ?> <?php if($row['front_doors'] == "تالف"){ echo "العدد: ".$row['front_doors_no']; } ?></td>
                    <td><?php echo $row['back_doors'] ?> <?php if($row['back_doors'] == "تالف"){ echo "العدد: ".$row['back_doors_no']; } ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">الاطارات</th>
                    <th>الامامية</td>
                    <th> الخلفية </td>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_tires'] ?> <?php if($row['front_tires'] == "تالف"){ echo "العدد: ".$row['front_tires_no']; } ?></td>
                    <td><?php echo $row['back_tires'] ?> <?php if($row['back_tires'] == "تالف"){ echo "العدد: ".$row['back_tires_no']; } ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">الانوار</th>
                    <th>الامامية</td>
                    <th> الخلفية </td>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_lights'] ?> <?php if($row['front_lights'] == "تالف"){ echo "العدد: ".$row['front_lights_no']; } ?></td>
                    <td><?php echo $row['back_lights'] ?> <?php if($row['back_lights'] == "تالف"){ echo "العدد: ".$row['back_lights_no']; } ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الدهانات</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['paints'] ?></td>
                  </tr>               
                </table>
              </div>
            </div>
            <div class="col-xs-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>المرايا 1</th>
                    <th>المرايا 2</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['mirrors_1'] ?></td>
                    <td><?php echo $row['mirrors_2'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>المقاعد</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['seats'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الجيربوكس</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['gear_box'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الدفرنس</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['difference'] ?></td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-xs-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الشبك الامامي</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['grille'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الصدام الامامي</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_bumper'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الطبلون</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['dashboard'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الديكورات الداخلية</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['internal_decorations'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الراديو و المسجل</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['radio'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الصدام الخلفي</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['back_bumper'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>اللوحات</th>
                  </tr>
                  <?php if($row['plates'] === "يوجد"){ ?>
                  <tr>
                    <td><?php echo $row['plates'] ?></td>
                    <td>العدد: <?php echo $row['number_of_plates'] ?></td>
                  </tr>
                  <?php }else{ ?>
                    <td><?php echo $row['plates'] ?></td>
                  <?php } ?>
                </table>
              </div>
            </div>
            <div class="col-xs-6 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>المحرك</th>
                  </tr>
                  <?php if($row['engine'] === "لا يوجد"){ ?>
                  <tr>
                    <td><?php echo $row['engine'] ?></td>
                  </tr>
                  <?php }else{ ?>
                    <td><?php echo $row['engine'] ?></td>
                    <td>ما عدا: <?php echo $row['engine_exception'] ?></td>
                  <?php } ?>
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          <!-- <p style="page-break-after: always;"></p> -->

          <div class="row">
            <div class="col-xs-1"></div>
            <?php if($row['car_condition'] != ""){ ?>
            <div class="col-xs-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>حالة السيارة</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['car_condition'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <?php } ?>
            <?php if($row['is_armed'] != ""){ ?>
            <div class="col-xs-6 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>السيارة مشلحة</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['is_armed'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <?php } ?>
            <div class="col-xs-1"></div>
          </div>
          <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>السيارة محصنة</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['is_protected'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          <div class="row">
              <div class="col-xs-1"></div>
              <div class="col-xs-10">
                <h6>(1) الحاله العامه للهيكل : غير صالحه وتستوجب النقل.</h6>
              </div>
              <div class="col-xs-1"></div>
          </div>
          <div class="row">
              <div class="col-xs-1"></div>
              <div class="col-xs-10">
                <h6>(2) التوصية: تنقل الى المكان المخصص و قد تم تسليمها الى المقاول لنقلها بالطريقة المتفق عليها و قد تم تسليم اللوحات لمندوب ادارة المرور في حينه و تم البحث عنها من الناحية الامنية بواسطة مندوب البحث الجنائي. و بناءا على ما ذكر جرى تنظيم المحضر. و بالله التوفيق.</h6>
              </div>
              <div class="col-xs-1"></div>
          </div>
      </form>
      <!-- Content Header (Page header) -->

    <?php require 'layoutjs.php'; ?>
  </body>

  </html>
  <?php
  }else {
    header('location:../index.php');
} } else {
  header('location:http://alsaifit.com/');
}
?>
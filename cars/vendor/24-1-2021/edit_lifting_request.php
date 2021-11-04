<?php
include 'lang.php';
include '../../database.php';
include '../../hijri.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["permission_des"] == 'admin' && $_SESSION["type_id"] == "1") {
    if((time() - $_SESSION['last_login_timestamp']) > 21600) // 6 hours  
            {  
                  header("location:../logout.php");  
            }  
            else  
            {  
                $_SESSION['last_login_timestamp'] = time();

                $reqID = $_GET['r'];
                $liftID = $_GET['n'];
                $sql = "CALL getLiftingProcedureByID(?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $liftID, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();
                
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
    $date = (new hijri\datetime($row['created_at'], NULL,"ar" ))->format("D _j _F _Y هـ h:i a");
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['mainmenu'] ?></title>
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
      font-size: medium;
      margin-top: 0px;
    background-color: white;
    text-align:right;
        }
        .fa-search{
      color:white;
    }
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
}
@media (min-width: 992px){  
.col-md-12 {
    width: 55%;
}
}
/* Chrome, Safari, Edge, Opera */
input required::-webkit-outer-spin-button,
input required::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input required[type=number] {
  -moz-appearance: textfield;
}
    </style>
  </head>

  <body class="skin-blue sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
    <div class="wrapper" >
      <?php
        include_once 'header.php';
      ?>
      
      <!-- Content Wrapper. Contains page content -->
      <form autocomplete="off" method="post" enctype="multipart/form-data">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- <div class="row">
            <img src="../../images/pro_header.jpeg" width="100%" height="500px">  
        </div> -->
        <div class="row">
          <div class="col-sm-12">
            <h1 style="font-family:'Amiri'; text-align:center">تعديل محضر رفع للطلب رقم <?php echo $_GET['r'] ?></h1>
          </div>
        </div></br>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-4">
            <label for="date">التاريخ</label>
            <input type="datetime-local" name="date" class="form-control" value="<?php echo str_replace(" ","T",$row['created_at']); ?>">
          </div>
          <div class="col-sm-2">
            <label for="date">جري رفع</label></br>
            <input required type="radio" <?php if($row['type'] == "سيارة خربة") { echo "checked";} ?> name="type" value="سيارة خربة"> سيارة خربة</br>
            <input required type="radio" <?php if($row['type'] == "هيكل تالف") { echo "checked";} ?> name="type" value="هيكل تالف"> هيكل تالف</br>
            <input required type="radio" <?php if($row['type'] == "خلاطة تالفة") { echo "checked";} ?> name="type" value="خلاطة تالفة"> خلاطة تالفة</br>
            <input required type="radio" <?php if($row['type'] == "معدة ثقيلة تالفة") { echo "checked";} ?> name="type" value="معدة ثقيلة تالفة"> معدة ثقيلة تالفة</br>
            <input required type="radio" <?php if($row['type'] == "خردة معدنية") { echo "checked";} ?> name="type" value="خردة معدنية"> خردة معدنية</br>
          </div>
          <div class="col-sm-2" style="font-size:large">
            <label for="date">من نطاق بلدية: </label>
            <?php echo $row2['baladya'] ?>
          </div>
        </div></br>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10 m-auto">
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
                  <?php
                    if($rowmap['model_id'] == 0 && $rowmap['man_id'] == 0){
                      echo 'لا يوجد';
                    }elseif($rowmap['man_id'] != 0 && $rowmap['model_id'] == 0){
                      echo '<td>'.$row2['man_arname'].' </td>';
                    }else{
                      echo '<td>'.$row2['man_arname'].' - '.$row2['model_arname'].' </td>';
                    }
                  ?>
                  <td><?php echo $row2['plate_number'] ?></td>
                  <td><?php echo $row2['chassis'] ?></td>
                  <td><div style=<?php echo "'width: 50px; height: 20px; background-color:#".$row2['color'].";text-align:".$expr['align']. "margin-right:45%;'";?>></div></td>
                  <td><?php echo $row2['ct_name'] ?> - <?php echo $row2['baladya'] ?> - <?php echo $row2['ar_name'] ?></td>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div></br>

          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">الهيكل</th>
                    <th>السقف</td>
                    <th> الرفارف </td>
                    <th> الكبوت </td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['structure_top'] == "سليم") { echo "checked";} ?> name="structure_top" value="سليم" /> سليم</td>
                    <td><input required type="radio" <?php if($row['structure_fenders'] == "سليم") { echo "checked";} ?> name="structure_fenders" value="سليم" /> سليم</td>
                    <td><input required type="radio" <?php if($row['structure_engine_hood'] == "سليم") { echo "checked";} ?> name="structure_engine_hood" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['structure_top'] == "تالف") { echo "checked";} ?> name="structure_top" value="تالف" /> تالف</td>
                    <td><input required type="radio" <?php if($row['structure_fenders'] == "تالف") { echo "checked";} ?> name="structure_fenders" value="تالف" /> تالف</td>
                    <td><input required type="radio" <?php if($row['structure_engine_hood'] == "تالف") { echo "checked";} ?> name="structure_engine_hood" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['structure_top'] == "غير موجود") { echo "checked";} ?> name="structure_top" value="غير موجود" /> غير موجود</td>
                    <td><input required type="radio" <?php if($row['structure_fenders'] == "غير موجود") { echo "checked";} ?> name="structure_fenders" value="غير موجود" /> غير موجود</td>
                    <td><input required type="radio" <?php if($row['structure_engine_hood'] == "غير موجود") { echo "checked";} ?> name="structure_engine_hood" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['structure_top'] == "موجود") { echo "checked";} ?> name="structure_top" value="موجود" /> موجود</td>
                    <td><input required type="radio" <?php if($row['structure_fenders'] == "موجود") { echo "checked";} ?> name="structure_fenders" value="موجود" /> موجود</td>
                    <td><input required type="radio" <?php if($row['structure_engine_hood'] == "موجود") { echo "checked";} ?> name="structure_engine_hood" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">الزجاج</th>
                    <th>الامامي</td>
                    <th> الخلفي </td>
                    <th> الجانبي </td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_glass'] == "سليم") { echo "checked";} ?> name="front_glass" value="سليم" /> سليم</td>
                    <td><input required type="radio" <?php if($row['back_glass'] == "سليم") { echo "checked";} ?> name="back_glass" value="سليم" /> سليم</td>
                    <td><input required type="radio" <?php if($row['side_glass'] == "سليم") { echo "checked";} ?> name="side_glass" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_glass'] == "تالف") { echo "checked";} ?> name="front_glass" value="تالف" /> تالف</td>
                    <td><input required type="radio" <?php if($row['back_glass'] == "تالف") { echo "checked";} ?> name="back_glass" value="تالف" /> تالف</td>
                    <td><input required type="radio" <?php if($row['side_glass'] == "تالف") { echo "checked";} ?> name="side_glass" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_glass'] == "غير موجود") { echo "checked";} ?> name="front_glass" value="غير موجود" /> غير موجود</td>
                    <td><input required type="radio" <?php if($row['back_glass'] == "غير موجود") { echo "checked";} ?> name="back_glass" value="غير موجود" /> غير موجود</td>
                    <td><input required type="radio" <?php if($row['side_glass'] == "غير موجود") { echo "checked";} ?> name="side_glass" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_glass'] == "موجود") { echo "checked";} ?> name="front_glass" value="موجود" /> موجود</td>
                    <td><input required type="radio" <?php if($row['back_glass'] == "موجود") { echo "checked";} ?> name="back_glass" value="موجود" /> موجود</td>
                    <td><input required type="radio" <?php if($row['side_glass'] == "موجود") { echo "checked";} ?> name="side_glass" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">الابواب</th>
                    <th>الامامية</td>
                    <th>الخلفية</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_doors'] == "سليم") { echo "checked";} ?> name="front_doors" value="سليم" /> سليم</td>
                    <td><input required type="radio" <?php if($row['back_doors'] == "سليم") { echo "checked";} ?> name="back_doors" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_doors'] == "تالف") { echo "checked";} ?> name="front_doors" value="تالف" /> تالف <input type="number" name="front_doors_no" value="<?php echo $row['front_doors_no'] ?>" style="width:25%"></td>
                    <td><input required type="radio" <?php if($row['back_doors'] == "تالف") { echo "checked";} ?> name="back_doors" value="تالف" /> تالف <input type="number" name="back_doors_no" value="<?php echo $row['back_doors_no'] ?>" style="width:25%"></td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_doors'] == "غير موجود") { echo "checked";} ?> name="front_doors" value="غير موجود" /> غير موجود</td>
                    <td><input required type="radio" <?php if($row['back_doors'] == "غير موجود") { echo "checked";} ?> name="back_doors" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_doors'] == "موجود") { echo "checked";} ?> name="front_doors" value="موجود" /> موجود</td>
                    <td><input required type="radio" <?php if($row['back_doors'] == "موجود") { echo "checked";} ?> name="back_doors" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">الاطارات</th>
                    <th>الامامية</td>
                    <th> الخلفية </td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_tires'] == "سليم") { echo "checked";} ?> name="front_tires" value="سليم" /> سليم</td>
                    <td><input required type="radio" <?php if($row['back_tires'] == "سليم") { echo "checked";} ?> name="back_tires" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_tires'] == "تالف") { echo "checked";} ?> name="front_tires" value="تالف" /> تالف <input type="number" name="front_tires_no" value="<?php echo $row['front_tires_no'] ?>" style="width:25%"></td>
                    <td><input required type="radio" <?php if($row['back_tires'] == "تالف") { echo "checked";} ?> name="back_tires" value="تالف" /> تالف <input type="number" name="back_tires_no" value="<?php echo $row['back_tires_no'] ?>" style="width:25%"></td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_tires'] == "غير موجود") { echo "checked";} ?> name="front_tires" value="غير موجود" /> غير موجود</td>
                    <td><input required type="radio" <?php if($row['back_tires'] == "غير موجود") { echo "checked";} ?> name="back_tires" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_tires'] == "موجود") { echo "checked";} ?> name="front_tires" value="موجود" /> موجود</td>
                    <td><input required type="radio" <?php if($row['back_tires'] == "موجود") { echo "checked";} ?> name="back_tires" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">الانوار</th>
                    <th>الامامية</td>
                    <th> الخلفية </td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_lights'] == "سليم") { echo "checked";} ?> name="front_lights" value="سليم" /> سليم</td>
                    <td><input required type="radio" <?php if($row['back_lights'] == "سليم") { echo "checked";} ?> name="back_lights" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_lights'] == "تالف") { echo "checked";} ?> name="front_lights" value="تالف" /> تالف <input type="number" name="front_lights_no" value="<?php echo $row['front_lights_no'] ?>" style="width:25%"></td>
                    <td><input required type="radio" <?php if($row['back_lights'] == "تالف") { echo "checked";} ?> name="back_lights" value="تالف" /> تالف <input type="number" name="back_lights_no" value="<?php echo $row['back_lights_no'] ?>" style="width:25%"></td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_lights'] == "غير موجود") { echo "checked";} ?> name="front_lights" value="غير موجود" /> غير موجود</td>
                    <td><input required type="radio" <?php if($row['back_lights'] == "غير موجود") { echo "checked";} ?> name="back_lights" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_lights'] == "موجود") { echo "checked";} ?> name="front_lights" value="موجود" /> موجود</td>
                    <td><input required type="radio" <?php if($row['back_lights'] == "موجود") { echo "checked";} ?> name="back_lights" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الدهانات</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['paints'] == "جيدة") { echo "checked";} ?> name="paints" value="جيدة" /> جيدة</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['paints'] == "رديئة") { echo "checked";} ?> name="paints" value="رديئة" /> رديئة</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['paints'] == "محروقة") { echo "checked";} ?> name="paints" value="محروقة" /> محروقة</td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>المرايا 1</th>
                    <th>المرايا 2</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['mirrors_1'] == "سليم") { echo "checked";} ?> name="mirrors_1" value="سليم" /> سليم</td>
                    <td><input required type="radio" <?php if($row['mirrors_2'] == "سليم") { echo "checked";} ?> name="mirrors_2" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['mirrors_1'] == "تالف") { echo "checked";} ?> name="mirrors_1" value="تالف" /> تالف</td>
                    <td><input required type="radio" <?php if($row['mirrors_2'] == "تالف") { echo "checked";} ?> name="mirrors_2" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['mirrors_1'] == "غير موجود") { echo "checked";} ?> name="mirrors_1" value="غير موجود" /> غير موجود</td>
                    <td><input required type="radio" <?php if($row['mirrors_2'] == "غير موجود") { echo "checked";} ?> name="mirrors_2" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['mirrors_1'] == "موجود") { echo "checked";} ?> name="mirrors_1" value="موجود" /> موجود</td>
                    <td><input required type="radio" <?php if($row['mirrors_2'] == "موجود") { echo "checked";} ?> name="mirrors_2" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>المقاعد</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['seats'] == "سليم") { echo "checked";} ?> name="seats" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['seats'] == "تالف") { echo "checked";} ?> name="seats" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['seats'] == "غير موجود") { echo "checked";} ?> name="seats" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['seats'] == "موجود") { echo "checked";} ?> name="seats" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الجيربوكس</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['gear_box'] == "سليم") { echo "checked";} ?> name="gear_box" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['gear_box'] == "تالف") { echo "checked";} ?> name="gear_box" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['gear_box'] == "غير موجود") { echo "checked";} ?> name="gear_box" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['gear_box'] == "موجود") { echo "checked";} ?> name="gear_box" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الدفرنس</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['difference'] == "سليم") { echo "checked";} ?> name="difference" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['difference'] == "تالف") { echo "checked";} ?> name="difference" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['difference'] == "غير موجود") { echo "checked";} ?> name="difference" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['difference'] == "موجود") { echo "checked";} ?> name="difference" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الشبك الامامي</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['grille'] == "سليم") { echo "checked";} ?> name="grille" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['grille'] == "تالف") { echo "checked";} ?> name="grille" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['grille'] == "غير موجود") { echo "checked";} ?> name="grille" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['grille'] == "موجود") { echo "checked";} ?> name="grille" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الصدام الامامي</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_bumper'] == "سليم") { echo "checked";} ?> name="front_bumper" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_bumper'] == "تالف") { echo "checked";} ?> name="front_bumper" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_bumper'] == "غير موجود") { echo "checked";} ?> name="front_bumper" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['front_bumper'] == "موجود") { echo "checked";} ?> name="front_bumper" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الطبلون</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['dashboard'] == "سليم") { echo "checked";} ?> name="dashboard" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['dashboard'] == "تالف") { echo "checked";} ?> name="dashboard" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['dashboard'] == "غير موجود") { echo "checked";} ?> name="dashboard" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['dashboard'] == "موجود") { echo "checked";} ?> name="dashboard" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الديكورات الداخلية</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['internal_decorations'] == "سليم") { echo "checked";} ?> name="internal_decorations" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['internal_decorations'] == "تالف") { echo "checked";} ?> name="internal_decorations" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['internal_decorations'] == "غير موجود") { echo "checked";} ?> name="internal_decorations" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['internal_decorations'] == "موجود") { echo "checked";} ?> name="internal_decorations" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الراديو و المسجل</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['radio'] == "سليم") { echo "checked";} ?> name="radio" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['radio'] == "تالف") { echo "checked";} ?> name="radio" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['radio'] == "غير موجود") { echo "checked";} ?> name="radio" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['radio'] == "موجود") { echo "checked";} ?> name="radio" value="موجود" /> موجود</td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الصدام الخلفي</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['back_bumper'] == "سليم") { echo "checked";} ?> name="back_bumper" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['back_bumper'] == "تالف") { echo "checked";} ?> name="back_bumper" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['back_bumper'] == "غير موجود") { echo "checked";} ?> name="back_bumper" value="غير موجود" /> غير موجود</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['back_bumper'] == "موجود") { echo "checked";} ?> name="back_bumper" value="موجود" /> موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>اللوحات</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['plates'] == "يوجد") { echo "checked";} ?> name="plates" value="يوجد" /> يوجد: العدد <input type="number" name="number_of_plates" value="<?php echo $row['number_of_plates'] ?>" style="width:25%"></td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['plates'] == "لا يوجد") { echo "checked";} ?> name="plates" value="لا يوجد" /> لا يوجد</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-6 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>المحرك</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['engine'] == 'لا يوجد'){ echo "checked"; } ?> name="engine" value="لا يوجد" /> لا يوجد</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['engine'] == ' يوجد'){ echo "checked"; } ?> name="engine" value=" يوجد" /> يوجد ما عدا: <input type="text" name="engine_exception" style="width:50%" value="<?php echo $row['engine_exception'] ?>"></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>حالة السيارة</th>
                  </tr>
                  <tr>
                    <td><input type="radio" <?php if($row['car_condition'] == "مصدومة") { echo "checked";} ?> name="car_condition" value="مصدومة" /> مصدومة</td>
                  </tr>
                  <tr>
                    <td><input type="radio" <?php if($row['car_condition'] == "محروقة") { echo "checked";} ?> name="car_condition" value="محروقة" /> محروقة</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>السيارة مشلحة</th>
                  </tr>
                  <tr>
                    <td><input type="radio" <?php if($row['is_armed'] == "نعم") { echo "checked";} ?> name="is_armed" value="نعم" /> نعم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" <?php if($row['is_armed'] == "جزء منها") { echo "checked";} ?> name="is_armed" value="جزء منها" />جزء منها</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>السيارة محصنة</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['is_protected'] == "نعم") { echo "checked";} ?> name="is_protected" value="نعم" /> نعم</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" <?php if($row['is_protected'] == "لا") { echo "checked";} ?> name="is_protected" value="لا" /> لا</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الملاحظات</th>
                  </tr>
                  <tr>
                    <td><textarea name="notes" class="form-control" cols="15" rows="5"><?php echo $row['notes'] ?></textarea></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-3">
                  <input type="file" name="upload[]" multiple="multiple">
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
            <label>الصور لحظة الرفع</label></br>

              <!-- Full-width images with number and caption text -->
              <?php

              $rs = $db->GetData("select * from lifting_images where procedure_id=".$_GET['n']);

              if ($rowphoto = mysqli_fetch_assoc($rs)) {
                foreach ($rs as $rowphoto) {
                  $image = $rowphoto['location'];
              ?>
            <div class="img-thumbnail" title="<?php echo $expr['photoinstruction'] ?>">
                <img src="<?php echo $rowphoto['location']; ?>" alt="" class="img-rounded"  data-toggle="modal" data-target="#largeImgPanel<?php echo $rowphoto['id'] ?>" width="100" height="100"></br>
                <center><a href="delphoto.php?img=<?php echo $image?>&n=<?php echo $_GET['n'] ?>&r=<?php echo $_GET['r'] ?>" class="btn btn-danger btn-xs" name="remove"><?php echo $expr['remove'] ?> </a></center>
            </div>
              <!-- Modal -->
              <div class="modal" id="largeImgPanel<?php echo $rowphoto['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <img src="<?php echo $rowphoto['location'] ?>" style="height:100%;width:100%;">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end of modal -->
              <?php
                }
              }
              ?>
              
            </div>
            <div class="col-lg-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-6">
              <button class="btn btn-primary btn-lg" style="float:left" name="save"><?php echo $expr['save'] ?></button>
            </div>
            <div class="col-sm-6">
              <a class="btn btn-success" href="view_lifting_request.php?n=<?php echo $_GET['n'] ?>&r=<?php echo $_GET['r'] ?>">الرجوع</a>
            </div>
          </div>
          </br>
            <!-- <img src="../../images/pro_footer.jpeg" width="100%" height="200px">   -->
          <?php
            if(isset($_POST['save'])){
              require_once '../database.php';
              $database = new Database();

              $save = $database->RunDML("update lifting_procedures set structure_top = '".$_POST['structure_top']."',
              structure_fenders = '".$_POST['structure_fenders']."', structure_engine_hood = '".$_POST['structure_engine_hood']."',
              front_doors = '".$_POST['front_doors']."', back_doors = '".$_POST['back_doors']."',front_doors_no = '".$_POST['front_doors_no']."', back_doors_no = '".$_POST['back_doors_no']."', front_lights = '".$_POST['front_lights']."',
              back_lights = '".$_POST['back_lights']."', gear_box = '".$_POST['gear_box']."', back_lights_no = '".$_POST['back_lights_no']."', front_lights_no = '".$_POST['front_lights_no']."', difference = '".$_POST['difference']."',
              dashboard = '".$_POST['dashboard']."',internal_decorations = '".$_POST['internal_decorations']."',
              front_glass = '".$_POST['front_glass']."',back_glass = '".$_POST['back_glass']."', side_glass = '".$_POST['side_glass']."',
              front_tires = '".$_POST['front_tires']."', back_tires = '".$_POST['back_tires']."', front_tires_no = '".$_POST['front_tires_no']."', back_tires_no = '".$_POST['back_tires_no']."', paints = '".$_POST['paints']."',
              mirrors_1 = '".$_POST['mirrors_1']."', mirrors_2 = '".$_POST['mirrors_2']."', seats = '".$_POST['seats']."', grille = '".$_POST['grille']."', radio = '".$_POST['radio']."',
              front_bumper = '".$_POST['front_bumper']."', back_bumper = '".$_POST['back_bumper']."', plates = '".$_POST['plates']."',
              number_of_plates = '".$_POST['number_of_plates']."', engine = '".$_POST['engine']."', engine_exception = '".$_POST['engine_exception']."',
              is_protected = '".$_POST['is_protected']."', car_condition = '".$_POST['car_condition']."', is_armed = '".$_POST['is_armed']."',
              created_at = '".$_POST['date']."', type = '".$_POST['type']."' where id=".$_GET['n']);

              $last_id = $database->mysqli_insert_id();

              if($save == "ok"){
                $extensions = ['jpeg','jpg','gif','png','swf','tiff'];
                // Count # of uploaded files in array
                $total = count($_FILES['upload']['name']);
                
                // Loop through each file
                for( $i=0 ; $i < $total ; $i++ ) {
                  $ext = pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);
                    if (in_array($ext, $extensions)) {
                  $dir ="../../images/";
  
                  //Get the temp file path
                  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
  
                  //Make sure we have a file path
                  if ($tmpFilePath != ""){
                    //Setup our new file path
                    $newFilePath = $dir . $_FILES['upload']['name'][$i];
  
                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
  
                      $img = $database->RunDML("insert into lifting_images values (default, '".$newFilePath."', '".$_GET['n']."')");
  
                    }
                  }
                }else{
                  echo "<script> alert('الملف غير مدعوم. الملفات المدعومة هي pdf ، jpg ، jpeg ، gif ، swf ، tiff') </script>";
                }
                }

                $message = "تم تعديل محضر رفع للطلب رقم ".$_GET['r'];
                $msg2 = $database->RunDML("insert into notification values (Default, '".$_GET['r']."' , '".$message."' , '0' , '3')");
                $msg3 = $database->RunDML("insert into notification values (Default, '".$_GET['r']."' , '".$message."' , '0' , '4')");
                $msg4 = $database->RunDML("insert into notification values (Default, '".$_GET['r']."' , '".$message."' , '0' , '2')");
                echo("<script> alert('تم تعديل محضر الرفع بنجاح')</script>");
                echo("<script> window.open('edit_lifting_request.php?n=".$_GET['n']."&r=".$_GET['r']."' , '_self') </script>");
              }else{
                echo "error is ".$save;
              }
            }
          ?>
      </div>
      </form>
      
        <!-- Content Header (Page header) -->

        <?php require 'layoutjs.php'; ?>
  </body>

  </html>
  <?php
} }else {
    header('location:../index.php');
} } else {
  header('location:http://alsaifit.com/');
}
?>
<?php
include 'lang.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["permission_des"] == 'admin' && $_SESSION["type_id"] == "2") {
    include_once '../database.php';
    $db = new Database();
    $request = $db->GetData("select  rq.* ,sts.description as sts_name,model.name as model_name ,man.name as man_name,us.name , ct.name as ct_name, ar.name as ar_name, st.name as st_name 
      
    from request rq ,models as model, manufactures man,users us ,areas ar ,cities ct,statuses sts,states st 
    
    where rq.id='".$_GET["n"]."' and rq.model_id=model.id and model.manufacture_id=man.id	 and rq.user_id = us.id and rq.city_id=ct.id and rq.area_id =ar.id and rq.state_id=st.id and rq.status_id=sts.id");
    $row = mysqli_fetch_assoc($request);
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
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <?php if($expr['direction'] == 'rtl'){ ?>
      <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <!-- <link rel="stylesheet" href="dist/fonts/fonts-fa.css"> -->
      <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
      <link rel="stylesheet" href="dist/css/rtl.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
          folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <?php }else{ ?>
       <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <!-- <link rel="stylesheet" href="dist/fonts/fonts-fa.css"> -->
      <link rel="stylesheet" href="disten/css/bootstrap-rtl.min.css">
      <link rel="stylesheet" href="disten/css/rtl.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="disten/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
          folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="disten/css/skins/_all-skins.min.css">
    <?php
     }?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
      <form autocomplete="off" method="post">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <div class="row">
          <div class="col-xs-12">
            <h1 style="font-family:'Amiri'; text-align:center">انشاء محضر رفع</h1>
          </div>
        </div></br>
        <div class="row">
          <div class="col-xs-1"></div>
          <div class="col-xs-4">
            <label for="date">التاريخ</label>
            <input type="datetime-local" name="date" class="form-control">
          </div>
          <div class="col-xs-2">
            <label for="date">جري رفع</label></br>
            <input type="radio" name="type" value="سيارة خربة"> سيارة خربة</br>
            <input type="radio" name="type" value="هيكل تالف"> هيكل تالف</br>
            <input type="radio" name="type" value="خلاطة تالفة"> خلاطة تالفة</br>
            <input type="radio" name="type" value="معدة ثقيلة تالفة"> معدة ثقيلة تالفة</br>
            <input type="radio" name="type" value="خردة معدنية"> خردة معدنية</br>
          </div>
          <div class="col-xs-4" style="font-size:large">
            <label for="date">من نطاق بلدية: </label>
            <?php echo $row['baladya'] ?>
          </div>
          <div class="col-xs-1"></div>
        </div></br>
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
                <?php foreach($request as $row){ ?>
                <tbody>
                  <td><?php echo $row['man_name'] ?> - <?php echo $row['model_name'] ?></td>
                  <td><?php echo $row['plate_number'] ?></td>
                  <td><?php echo $row['chassis'] ?></td>
                  <td><div style=<?php echo "'width: 50px; height: 20px; background-color:#".$row['color'].";text-align:".$expr['align']. "margin-right:45%;'";?>></div></td>
                  <td><?php echo $row['st_name'] ?> - <?php echo $row['ct_name'] ?> - <?php echo $row['baladya'] ?> - <?php echo $row['ar_name'] ?></td>
                </tbody>
                <?php } ?>
              </table>
            </div>
          </div>
          <div class="col-xs-1"></div>
        </div></br>

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
                    <td><input type="radio" name="structure_top" value="سليم" /> سليم</td>
                    <td><input type="radio" name="structure_fenders" value="سليم" /> سليم</td>
                    <td><input type="radio" name="structure_engine_hood" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="structure_top" value="تالف" /> تالف</td>
                    <td><input type="radio" name="structure_fenders" value="تالف" /> تالف</td>
                    <td><input type="radio" name="structure_engine_hood" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="structure_top" value="غير موجود" /> غير موجود</td>
                    <td><input type="radio" name="structure_fenders" value="غير موجود" /> غير موجود</td>
                    <td><input type="radio" name="structure_engine_hood" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="front_glass" value="سليم" /> سليم</td>
                    <td><input type="radio" name="back_glass" value="سليم" /> سليم</td>
                    <td><input type="radio" name="side_glass" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_glass" value="تالف" /> تالف</td>
                    <td><input type="radio" name="back_glass" value="تالف" /> تالف</td>
                    <td><input type="radio" name="side_glass" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_glass" value="غير موجود" /> غير موجود</td>
                    <td><input type="radio" name="back_glass" value="غير موجود" /> غير موجود</td>
                    <td><input type="radio" name="side_glass" value="غير موجود" /> غير موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          </br>
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
                    <td><input type="radio" name="front_doors" value="سليم" /> سليم</td>
                    <td><input type="radio" name="back_doors" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_doors" value="تالف" /> تالف</td>
                    <td><input type="radio" name="back_doors" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_doors" value="غير موجود" /> غير موجود</td>
                    <td><input type="radio" name="back_doors" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="front_tires" value="سليم" /> سليم</td>
                    <td><input type="radio" name="back_tires" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_tires" value="تالف" /> تالف</td>
                    <td><input type="radio" name="back_tires" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_tires" value="غير موجود" /> غير موجود</td>
                    <td><input type="radio" name="back_tires" value="غير موجود" /> غير موجود</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          </br>
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
                    <td><input type="radio" name="front_lights" value="سليم" /> سليم</td>
                    <td><input type="radio" name="back_lights" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_lights" value="تالف" /> تالف</td>
                    <td><input type="radio" name="back_lights" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_lights" value="غير موجود" /> غير موجود</td>
                    <td><input type="radio" name="back_lights" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="paints" value="جيدة" /> جيدة</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="paints" value="رديئة" /> رديئة</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="paints" value="محروقة" /> محروقة</td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-xs-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>المرايا</th>
                  </tr>
                  <tr>
                    <td><input type="radio" name="mirrors" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="mirrors" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="mirrors" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="seats" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="seats" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="seats" value="غير موجود" /> غير موجود</td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الجيربوكس</th>
                  </tr>
                  <tr>
                    <td><input type="radio" name="gear_box" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="gear_box" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="gear_box" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="difference" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="difference" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="difference" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="grille" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="grille" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="grille" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="front_bumper" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_bumper" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="front_bumper" value="غير موجود" /> غير موجود</td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>الطبلون</th>
                  </tr>
                  <tr>
                    <td><input type="radio" name="dashboard" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="dashboard" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="dashboard" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="internal_decorations" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="internal_decorations" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="internal_decorations" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="radio" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="radio" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="radio" value="غير موجود" /> غير موجود</td>
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
                    <td><input type="radio" name="back_bumper" value="سليم" /> سليم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="back_bumper" value="تالف" /> تالف</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="back_bumper" value="غير موجود" /> غير موجود</td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>اللوحات</th>
                  </tr>
                  <tr>
                    <td><input type="radio" name="plates" value="يوجد" /> يوجد: العدد <input type="number" name="number_of_plates" style="width:25%"></td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="plates" value="لا يوجد" /> لا يوجد</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-6 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>المحرك</th>
                  </tr>
                  <tr>
                    <td><input type="radio" name="engine" value="لا يوجد" /> لا يوجد</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="engine" value=" يوجد" /> يوجد ما عدا: <input type="text" name="engine_exception" style="width:50%"></td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-xs-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>السيارة محصنة</th>
                  </tr>
                  <tr>
                    <td><input type="radio" name="is_protected" value="نعم" /> نعم</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="is_protected" value="لا" /> لا</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-xs-3">
                  <button class="btn btn-primary btn-lg" name="save"><?php echo $expr['save'] ?></button>
            </div>
            <div class="col-xs-1"></div>
          </div>
          </br>
          <?php
            if(isset($_POST['save'])){
              $save = $db->RunDML("insert into lifting_procedures values (Default, '".$_GET['n']."', '".$_POST['structure_top']."', '".$_POST['structure_fenders']."', '".$_POST['structure_engine_hood']."', '".$_POST['front_doors']."', '".$_POST['back_doors']."', '".$_POST['front_lights']."', '".$_POST['back_lights']."', '".$_POST['gear_box']."', '".$_POST['difference']."', '".$_POST['dashboard']."', '".$_POST['internal_decorations']."', '".$_POST['front_glass']."', '".$_POST['back_glass']."', '".$_POST['side_glass']."', '".$_POST['front_tires']."', '".$_POST['back_tires']."', '".$_POST['paints']."', '".$_POST['mirrors']."', '".$_POST['seats']."', '".$_POST['grille']."', '".$_POST['radio']."', '".$_POST['front_bumper']."', '".$_POST['back_bumper']."', '".$_POST['plates']."', '".$_POST['number_of_plates']."', '".$_POST['engine']."', '".$_POST['engine_exception']."', '".$_POST['is_protected']."', default, default, default, default, '".$_POST['date']."', '".$_POST['type']."')");
              $last_id = $db->insert_id;

              if($save == "ok"){
                $message = "تم انشاء محضر رفع للطلب رقم ".$_GET['n'];
                $req = $db-RunDML("update request set lifting_procedure = '".$last_id."' where id=".$_GET['n']);
                $msg2 = $db5->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$message."' , '0' , '3')");
                $msg3 = $db5->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$message."' , '0' , '4')");
                $msg4 = $db5->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$message."' , '0' , '1')");
                echo("<script> alert('تم انشاء محضر الرفع بنجاح')</script>");
                echo("<script> window.open('view_lifting_request.php?n=".$last_id."&r=".$_GET['n']."' , '_self') </script>");
              }else{
                echo "error is ".$save;
              }
            }
          ?>
      </div>
      </form>
      <!-- Content Header (Page header) -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.4 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>

  </html>
  <?php
  }else {
    header('location:../index.php');
} } else {
  header('location:http://alsaifit.com/');
}
?>
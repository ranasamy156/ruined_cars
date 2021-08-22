<html>
<head>
<style>
.container {
      width: 100%;
      margin-bottom:40px;
  }
  .progressbar {
      counter-reset: step;
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
      content: counter(step);
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

</style>
</head>
<body>
<?php
          include_once '../RequestClass.php';
          $db = new Requests();
          $rs = $db->GetReqById();
        
          if($row = mysqli_fetch_array($rs)) {
         
      ?>
<div class="container">
  <ul class="progressbar">
 <?php if($row['sts_name'] == "تم الطلب") { ?>
    <li class="active">تم الطلب</li>
    <li>تحت مراجعة المرور</li>
    <li>تحت مراجعة المباحث</li>
    <li>تم قبول السيارة</li>
    <?php }
    if($row['sts_name'] == "تحت مراجعة المرور") { ?>
      <li class="active">تم الطلب</li>
      <li class="active">تحت مراجعة المرور</li>
      <li>تحت مراجعة المباحث</li>
      <li>تم قبول السيارة</li>
    <?php }elseif($row['sts_name'] == "تم الرفض من قبل الامانة"){ ?>
      <li class="active">تم الطلب</li>
      <li class="active">تم الرفض من قبل الامانة</li>
      <?php }
      if($row['sts_name'] == "تحت مراجعة المباحث") {
      ?>
      <li class="active">تم الطلب</li>
      <li class="active">تحت مراجعة المرور</li>
      <li class="active">تحت مراجعة المباحث</li>
      <li>تم قبول السيارة</li>
      <?php }elseif($row['sts_name'] == "تم الرفض من قبل المرور"){ ?>
      <li class="active">تم الطلب</li>
      <li class="active">تحت مراجعة المرور</li>
      <li class="active">تم الرفض من قبل المرور</li>
      <?php }
      if($row['sts_name'] == "تم قبول السيارة") {
        ?>
        <li class="active">تم الطلب</li>
        <li class="active">تحت مراجعة المرور</li>
        <li class="active">تحت مراجعة المباحث</li>
        <li class="active">تم قبول السيارة</li>
        <?php }elseif($row['sts_name'] == "تم الرفض من قبل المباحث"){ ?>
        <li class="active">تم الطلب</li>
        <li class="active">تحت مراجعة المرور</li>
        <li class="active">تحت مراجعة المباحث</li>
        <li class="active">تم الرفض من قبل المباحث</li>
        <?php }
        if($row['sts_name'] == "تم استرداد السيارة") {
          ?>
          <li class="active">تم الطلب</li>
          <li class="active">تحت مراجعة المرور</li>
          <li class="active">تحت مراجعة المباحث</li>
          <li class="active">تم قبول السيارة</li>
          <li class="active">تم استرداد السيارة</li>
          <?php }elseif($row['sts_name'] == "تم الاستحواذ على السيارة"){ ?>
            <li class="active">تم الطلب</li>
          <li class="active">تحت مراجعة المرور</li>
          <li class="active">تحت مراجعة المباحث</li>
          <li class="active">تم قبول السيارة</li>
          <li class="active">تم الاستحواذ على السيارة</li>
          <?php } ?>
          <li class="active">تم الطلب</li>
          <li class="active">تحت مراجعة المرور</li>
          <li class="active">تحت مراجعة المباحث</li>
          <li class="active">تم قبول السيارة</li>
          <li class="active">تم استرداد السيارة</li>
  </ul>
</div>
<?php } ?>
</body>
</html>
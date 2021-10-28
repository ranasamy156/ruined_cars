<?php
  session_start();
  require 'database.php';
  $db = new Database();

  $news = $db->GetData("select * from news");
  $row_news = mysqli_fetch_array($news);

  $photos = $db->GetData("select * from slider");
  $row_photos = mysqli_fetch_array($photos);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>السيارات الخربة</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Vibes&display=swap"
      rel="stylesheet"
    />

    <!-- bootstrap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <!-- style -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav class="d-flex justify-content-between align-items-center">
      <div class="menuBtn" onclick="openSidebar()">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </div>
      <section
        class="
          nav-items-container
          d-flex
          justify-content-between
          align-items-center
        "
      >
        <ul class="nav-list d-flex justify-content-start align-items-center">
          <li
            class="list-item signin"
            style="
              color: #9e9e9e;
              padding-right: 5px;
              border-right: 2px solid #9e9e9e;
            "
            data-toggle="modal" data-target=".bd-example-modal-sm"
          >
            تسجيل الدخول
          </li>
          <li class="list-item">تواصل معنا</li>
          <li class="list-item">فريق العمل</li>
          <li class="list-item">من نحن</li>
          <li class="list-item">أهدافنا</li>
          <li class="list-item">عن المنصة</li>
          <li class="list-item" data-toggle="modal" data-target=".bd-example-modal-smm">استعلام</li>
          <li class="list-item"><a href="index.php" style="color: #3a7d33">الرئيسية</a></li>
        </ul>
      </section>
      <section
        class="nav-photos d-flex justify-content-between align-items-center"
      >
        <img src="./assets/assets/logo.png" alt="" />
        <img src="./assets/assets/000.png" alt="" />
        <p class="ain-nav m-0"><span style="color: #3a7d33">عين</span> العرب</p>
        <img src="assets/assets/img_2030.png" alt="" />
      </section>
    </nav>

    <!-- NEWS TICKER -->
    <div class="hwrap d-flex justify-content-between align-items-center">
      <div class="hmove">
        <div class="hitem">
        بدعم ورعاية خادم الحرمين الشريفين حفظه الله، أُطلقت رؤية المملكة 2030، وهي رؤية سمو ولي العهد لمستقبل هذا الوطن العظيم، والتي تسعى لاستثمار مكامن قوّتنا التي حبانا الله بها، من موقع استراتيجي متميز، وقوة استثمارية رائدة، وعمق عربيّ وإسلاميّ، حيث تولي القيادة لذلك كل الاهتمام، وتسخّر كل الإمكانات لتحقيق الطموحات.
        </div>
        <div class="hitem">
        بدعم ورعاية خادم الحرمين الشريفين حفظه الله، أُطلقت رؤية المملكة 2030، وهي رؤية سمو ولي العهد لمستقبل هذا الوطن العظيم، والتي تسعى لاستثمار مكامن قوّتنا التي حبانا الله بها، من موقع استراتيجي متميز، وقوة استثمارية رائدة، وعمق عربيّ وإسلاميّ، حيث تولي القيادة لذلك كل الاهتمام، وتسخّر كل الإمكانات لتحقيق الطموحات.
        </div>
        <div class="hitem">
        بدعم ورعاية خادم الحرمين الشريفين حفظه الله، أُطلقت رؤية المملكة 2030، وهي رؤية سمو ولي العهد لمستقبل هذا الوطن العظيم، والتي تسعى لاستثمار مكامن قوّتنا التي حبانا الله بها، من موقع استراتيجي متميز، وقوة استثمارية رائدة، وعمق عربيّ وإسلاميّ، حيث تولي القيادة لذلك كل الاهتمام، وتسخّر كل الإمكانات لتحقيق الطموحات.
        </div>
        <div class="hitem">
        بدعم ورعاية خادم الحرمين الشريفين حفظه الله، أُطلقت رؤية المملكة 2030، وهي رؤية سمو ولي العهد لمستقبل هذا الوطن العظيم، والتي تسعى لاستثمار مكامن قوّتنا التي حبانا الله بها، من موقع استراتيجي متميز، وقوة استثمارية رائدة، وعمق عربيّ وإسلاميّ، حيث تولي القيادة لذلك كل الاهتمام، وتسخّر كل الإمكانات لتحقيق الطموحات.
        </div>
        <div class="hitem">
        بدعم ورعاية خادم الحرمين الشريفين حفظه الله، أُطلقت رؤية المملكة 2030، وهي رؤية سمو ولي العهد لمستقبل هذا الوطن العظيم، والتي تسعى لاستثمار مكامن قوّتنا التي حبانا الله بها، من موقع استراتيجي متميز، وقوة استثمارية رائدة، وعمق عربيّ وإسلاميّ، حيث تولي القيادة لذلك كل الاهتمام، وتسخّر كل الإمكانات لتحقيق الطموحات.
        </div>
        <div class="hitem">
        بدعم ورعاية خادم الحرمين الشريفين حفظه الله، أُطلقت رؤية المملكة 2030، وهي رؤية سمو ولي العهد لمستقبل هذا الوطن العظيم، والتي تسعى لاستثمار مكامن قوّتنا التي حبانا الله بها، من موقع استراتيجي متميز، وقوة استثمارية رائدة، وعمق عربيّ وإسلاميّ، حيث تولي القيادة لذلك كل الاهتمام، وتسخّر كل الإمكانات لتحقيق الطموحات.
        </div>
        <div class="hitem">
        بدعم ورعاية خادم الحرمين الشريفين حفظه الله، أُطلقت رؤية المملكة 2030، وهي رؤية سمو ولي العهد لمستقبل هذا الوطن العظيم، والتي تسعى لاستثمار مكامن قوّتنا التي حبانا الله بها، من موقع استراتيجي متميز، وقوة استثمارية رائدة، وعمق عربيّ وإسلاميّ، حيث تولي القيادة لذلك كل الاهتمام، وتسخّر كل الإمكانات لتحقيق الطموحات.
        </div>
        <div class="hitem">
        بدعم ورعاية خادم الحرمين الشريفين حفظه الله، أُطلقت رؤية المملكة 2030، وهي رؤية سمو ولي العهد لمستقبل هذا الوطن العظيم، والتي تسعى لاستثمار مكامن قوّتنا التي حبانا الله بها، من موقع استراتيجي متميز، وقوة استثمارية رائدة، وعمق عربيّ وإسلاميّ، حيث تولي القيادة لذلك كل الاهتمام، وتسخّر كل الإمكانات لتحقيق الطموحات.
        </div>
        <div class="hitem">
        بدعم ورعاية خادم الحرمين الشريفين حفظه الله، أُطلقت رؤية المملكة 2030، وهي رؤية سمو ولي العهد لمستقبل هذا الوطن العظيم، والتي تسعى لاستثمار مكامن قوّتنا التي حبانا الله بها، من موقع استراتيجي متميز، وقوة استثمارية رائدة، وعمق عربيّ وإسلاميّ، حيث تولي القيادة لذلك كل الاهتمام، وتسخّر كل الإمكانات لتحقيق الطموحات.
        </div>
      </div>
    </div>

    <!-- carusel -->
    <div
      id="carouselExampleIndicators"
      class="carousel slide carousel-Wrapper"
      data-ride="carousel"
      data-pause="false"
    >
      <ol class="carousel-indicators">
        <li
          data-target="#carouselExampleIndicators"
          data-slide-to="0"
          class="active"
        ></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img
            class="d-block w-100"
            src="assets/assets/2030_1.jpeg"
          />
        </div>
        <div class="carousel-item">
          <img
            class="d-block w-100"
            src="assets/assets/2030_2.jpeg"
          />
        </div>
        <div class="carousel-item">
          <img
            class="d-block w-100"
            src="assets/assets/2030_3.jpeg"
          />
        </div>
        <div class="carousel-item">
          <img
            class="d-block w-100"
            src="assets/assets/4.jpeg"
          />
        </div>
        <div class="carousel-item">
          <img
            class="d-block w-100"
            src="assets/assets/pic1.jpg"
          />
        </div>
        <div class="carousel-item">
          <img
            class="d-block w-100"
            src="assets/assets/pic2.jpg"
          />
        </div>
        <div class="carousel-item">
          <img
            class="d-block w-100"
            src="assets/assets/pic3.jpg"
          />
        </div>
      </div>
    </div>
    <!-- instructions -->
    <div class="instructions">
      <h3>الارشادات المتبعة لاسترداد السيارة</h3>
      <p>
        الاتصال المباشر بالمقاول للاستعلام عن حالة السيارة
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
      </p>
      <p>
        عند وخود اي مخالفة امنية يتم التوجه الى الجهة الامنية المستعلم عنها من
        خلال المقاول لتسديد المخالفة الامنية واسترداد السيارة
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
      </p>
      <p>
        في حالة عدم وجود مخالفات امنية يتم التوجه الى مكتب المقاول لاسترداد
        السيارة
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
      </p>
    </div>
    <!-- who are us -->
    <div class="aboutus">
      <h3>من نحن</h3>
      <p>
        مؤسسة عين العرب للنظافة والمقاولات هي مؤسسة سعودية تقع في شارع الحزام
        ادارة مرور الحزام في المدينة المنورة تهدف الى الحفاظ على البيئة والتخلص
        من مخلفاتها وتساعد على اعادة السيارات الخربة لاصحابها
      </p>
    </div>

    <!-- footer -->
    <footer>
      <div class="header">
        <div class="left">
          <img src="./assets/assets/2030vision.jpeg" alt="" />
          <img
            style="width: 70px; height: 70px"
            src="./assets/assets/alsaif.jpeg"
            alt=""
          />
        </div>
        <div class="mid">
          <h5>تواصل معنا</h5>
          <p>رقم الهاتف: 0508260999</p>
          <p>رقم الهاتف: 0148260999</p>
          <p style="direction: rtl">البريد الالكتروني: info@sitksa.com</p>
        </div>
        <div class="right">
          <p class="ain"><span style="color: #3a7d33">عين</span> العرب</p>
          <p>
            شارع الحزام <br />المدينة المنورة <br />المملكة العربية السعودية
          </p>
        </div>
      </div>
      <div class="px-4 d-flex justify-content-between align-items-center">
        <div class="footerIcons">
          <i
            style="color: #24a1f2"
            class="fa fa-twitter-square"
            aria-hidden="true"
          ></i>
          <i
            style="color: #f38d55"
            class="fa fa-instagram"
            aria-hidden="true"
          ></i>
          <i
            style="color: #346499"
            class="fa fa-facebook-official"
            aria-hidden="true"
          ></i>
        </div>
        <div>جميع الحقوق محفوظة &copy; 2021</div>
      </div>
    </footer>

    <!-- sidebar -->
    <aside id="aside">
      <div class="login">
        <h4>تسجيل الدخول</h4>
        <i class="fa fa-sign-in" aria-hidden="true"></i>
      </div>
      <ul>
        <li>
          <p>الرئيسية</p>
          <i style="font-size: 25px" class="fa fa-home" aria-hidden="true"></i>
        </li>
        <li>
          <p>استعلام</p>
          <i
            style="font-size: 25px"
            class="fa fa-search"
            aria-hidden="true"
          ></i>
        </li>
        <li>
          <p>عن المنصة</p>
          <i
            style="font-size: 25px"
            class="fa fa-info-circle"
            aria-hidden="true"
          ></i>
        </li>
        <li>
          <p>اهدافنا</p>
          <i
            style="font-size: 25px"
            class="fa fa-area-chart"
            aria-hidden="true"
          ></i>
        </li>
        <li>
          <p>من نحن</p>
          <i style="font-size: 25px" class="fa fa-home" aria-hidden="true"></i>
        </li>
        <li>
          <p>فريق العمل</p>
          <i style="font-size: 25px" class="fa fa-users" aria-hidden="true"></i>
        </li>
        <li>
          <p>تواصل معنا</p>
          <i
            style="font-size: 45px"
            class="fa fa-mobile"
            aria-hidden="true"
          ></i>
        </li>
      </ul>
    </aside>

    <!-- backdrob -->

    <div id="backdrob" onclick="closeSidebar()"></div>

    <!-- ***************************************************************** -->
    <!-- jquery -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
      integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
      crossorigin="anonymous"
    ></script>
    <script src="index.js"></script>

    <!-- Login Modal -->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">تسجيل الدخول</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" autocomplete="off">
              <input type="text" placeholder="اسم المستخدم" class="form-control" name="username"></br>
              <input type="password" placeholder="كلمة المرور" class="form-control" name="password"> </br>
              <button type="submit" class="btn btn-success" name="login">دخول</button>
              <?php
                  if(isset($_POST['login'])){
                    $users = $db->GetData("select * from users where user_name = '".$_POST['username']."' and password = '".$_POST['password']."'");
                    if($row_users = mysqli_fetch_array($users)){
                        $_SESSION['id']=$row_users['id'];
                        $_SESSION["permission_des"]=$row_users["permission_des"];
                        $_SESSION["name"]=$row_users["name"];
                        $_SESSION["phone"]=$row_users["phone"];
                        $_SESSION["type_id"]=$row_users["type_id"];
                        $_SESSION["perm"]=$row_users["perm"];
                        $_SESSION['last_login_timestamp'] = time();  

                      switch ($row_users['type_id']) {
                        case '1':
                          echo "<script>window.open('cars/vendor/index.php','_self')</script>";
                          break;
                        
                        case '2':
                          echo "<script>window.open('cars/amana/index.php','_self')</script>";
                          break;
                        
                        case '3':
                          echo "<script>window.open('cars/investigation/index.php','_self')</script>";
                          break;
                      
                        case '4':
                          echo "<script>window.open('cars/traffic/index.php','_self')</script>";
                          break;
                      }
                    }else {
                      echo("<script>alert('بيانات غير صحيحة .. اعد المحاولة')</script>");
                    }
                  }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->

    <!-- search Modal -->
    <div class="modal fade bd-example-modal-smm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">لوحة السيارة</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" autocomplete="off">
              <input type="text" placeholder="رقم اللوحة" name="plate_number" class="form-control"></br>
              <button type="submit" class="btn btn-success" name="search">استعلام</button>
              <?php
                  if(isset($_POST['search'])){
                    $plate_number = $_POST['plate_number'];
                    $search = $db->GetData("select rq.* ,st.description as status_name ,us.name as user_name from request rq ,statuses st, users us where (rq.plate_number like '%".$plate_number."%' or rq.en_platenum like '%".$plate_number."%') and rq.user_id = us.id and rq.status_id=st.id");
                    $row_search = mysqli_fetch_array($search);
                    echo("<script>window.open('search.php?n=".$row_search['id']."','_self')</script>");
                  }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->
  </body>
</html>

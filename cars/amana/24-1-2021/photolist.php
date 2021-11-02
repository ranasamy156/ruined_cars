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
    <title><?php echo $expr['photoslider'] ?></title>
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
    <style>
      .icons { 
            color: #AF121E; 
            width: 500px; 
            height: 200px; 
            border: 5px solid #AF121E; 
        } 
        .main-header .navbar-brand {
            color: #fff;
        /*    <!-- margin-right: 500px; -->*/
        }
        .box.box-info {
            border-top-color: #222d32;
        }
                .main-header {
            position: relative;
            max-height: 100px;
            z-index: 1030;
        }
        * {box-sizing:border-box}

        /* Slideshow container */
        .slideshow-container {
          max-width: 1000px;
          position: relative;
          margin: auto;
        }

        /* Hide the images by default */
        .mySlides {
          display: none;
        }

        /* Next & previous buttons */
        .prev{
          cursor: pointer;
          position: absolute;
          top: 50%;
          width: auto;
          margin-top: -22px;
          padding: 16px;
          color: black;
          font-weight: bold;
          font-size: 18px;
          transition: 0.6s ease;
          border-radius: 0 3px 3px 0;
          user-select: none;
          right: 0;
          border-radius: 3px 0 0 3px;
        }
        .fa-search{
      color:white;
      }

        .next {
          margin-right: 185px;
          cursor: pointer;
          position: absolute;
          top: 50%;
          width: auto;
          margin-top: -22px;
          padding: 16px;
          color: black;
          font-weight: bold;
          font-size: 18px;
          transition: 0.6s ease;
          border-radius: 0 3px 3px 0;
          user-select: none;
            left: 0;
            border-radius: 3px 0 0 3px;
          
        }
        /* Position the "next button" to the right */


        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
          background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text {
          color: #f2f2f2;
          font-size: 15px;
          padding: 8px 12px;
          position: absolute;
          bottom: 8px;
          width: 100%;
          text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
          color: #f2f2f2;
          font-size: 12px;
          padding: 8px 12px;
          position: absolute;
          top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
          cursor: pointer;
          height: 15px;
          width: 15px;
          margin: 0 2px;
          background-color: #bbb;
          border-radius: 50%;
          display: inline-block;
          transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
          background-color: #717171;
        }

        /* Fading animation */
        .fade {
          -webkit-animation-name: fade;
          -webkit-animation-duration: 1.5s;
          animation-name: fade;
          animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
          from {opacity: .4}
          to {opacity: 1}
        }

        @keyframes fade {
          from {opacity: .4}
          to {opacity: 1}
        }
        .slideshow-container {
            max-width: 700px;
            position: relative;
            margin: 30px;
            padding:50px;
        border:1px solid #ddd;
        width:100%;
        color:#000;
        margin:30px auto 0;
        padding:50px;
        border:1px solid #ddd;
        text-align:left;
      font-size: 14px;
        }
                
        .col-md-8 {
            width: 80%;
                
        }
        .carousel-indicators.carousel-indicators--thumbnails li {
          width: 40px;
          height: 20px;
          margin: 0;
          border: none;
          border-radius: 0;
        }
        .carousel-indicators.carousel-indicators--thumbnails .active {
          background-color: transparent;
        }
        .carousel-indicators.carousel-indicators--thumbnails .active .thumbnail {
          border-color: #337ab7;
        }
      .row {
        margin-right: 100px;
        /* margin-left: -100px; */
        padding: 20px;
        padding-right: 60px;
        padding-top: 0px;
      }
      .img-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 100%;
    height: 35px;
}
.thumbnail {
    display: block;
    padding: 4px;
    margin-bottom: 20px;
    line-height: 1.42857143;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    -webkit-transition: border .2s ease-in-out;
    -o-transition: border .2s ease-in-out;
    transition: border .2s ease-in-out;
    height: 45px;
}
      .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
}
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <style>
        @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
        /* font-family: 'Amiri', serif; */
    </style>
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
        text-align:left;
      font-size: 14px;
      margin-top: 0px;
    background-color: white;
        }
        .fa-search{
      color:white;
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
      <div class="content-wrapper" >
    
      <div class="adminpanel">
      <h3 style="margin-top: -25px;font-size: xx-large;font-family:'Amiri', serif;" class="navbar-brand"><?php echo $expr['photoslider'] ?></h3>
    <form method="post" enctype="multipart/form-data">
            <!-- Slideshow container -->
            <div class="slideshow-container">

              <!-- Full-width images with number and caption text -->
                <?php
                    $sql = "CALL getSliderImages()";        
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    
                    foreach($stmt as $row){
                    $image = $row['userfile'];
                ?>
              <div class="mySlides">
                <img src="<?php echo $image; ?>" style="height: 300px;width:100%;">
                <ol class="carousel-indicators carousel-indicators--thumbnails">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active">
                <div class="thumbnail">
                  <img src="<?php echo $image; ?>" class="img-responsive">
                </div>
              </li>
              </ol>
              <a href="delphoto.php?n=<?php echo $image ?>" class="btn btn-danger" name="remove"><?php echo $expr['remove'] ?> </a>
              </div>
              <!-- Next and previous buttons -->
              <a class="next" onclick="plusSlides(1)">&#10095;</a>
              <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <?php
                  }
                ?>
            </div>
            <br>

            <!-- The dots/circles -->
            <!-- <div style="text-align:center">
              <span class="dot" onclick="currentSlide(1)"></span>
              <span class="dot" onclick="currentSlide(2)"></span>
              <span class="dot" onclick="currentSlide(3)"></span>
            </div> -->
                <script>
                var slideIndex = 1;
                    showSlides(slideIndex);

                    // Next/previous controls
                    function plusSlides(n) {
                      showSlides(slideIndex += n);
                    }

                    // Thumbnail image controls
                    function currentSlide(n) {
                      showSlides(slideIndex = n);
                    }

                    function showSlides(n) {
                      var i;
                      var slides = document.getElementsByClassName("mySlides");
                      var dots = document.getElementsByClassName("dot");
                      if (n > slides.length) {slideIndex = 1}
                      if (n < 1) {slideIndex = slides.length}
                      for (i = 0; i < slides.length; i++) {
                          slides[i].style.display = "none";
                      }
                      for (i = 0; i < dots.length; i++) {
                          dots[i].className = dots[i].className.replace(" active", "");
                      }
                      slides[slideIndex-1].style.display = "block";
                      dots[slideIndex-1].className += " active";
                    }
                </script>
                <?php if($_SESSION['permission_des'] == "admin"){ ?>
                <div id="photo">
                
            <div style="text-align:center;margin:50px;width:100%;color: #000;margin: 30px auto 0;padding: 50px;text-align: left;font-size: 14px;">
              <form  method="post" enctype="multipart/form-data">
              <div class="form-group row" style="text-align:center;margin:auto;">
              <h2><?php echo $expr['photoupload'] ?>:</h2>
                <input class="form-control" type="file" name="userfile" id="userfile" style="margin-right:auto;" >
                <input class="form-control" type="submit" value="<?php echo $expr['photoupload'] ?>" name="submit" style="width: 110px;float:<?php echo $expr['left'] ?>;">
                </div>
              </form>
                </div>
            <?php
                if(isset($_POST['submit'])){
                  $extensions = ['jpeg','jpg','gif','png','swf','tiff'];
                  $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                  
                  if (in_array($ext, $extensions)) {
                    $dir ="../../images/";
                    $image=$_FILES['userfile']['name'];
                    $temp_name=$_FILES['userfile']['tmp_name'];
                    //$size=filesize($temp_name);
                    //echo($size);
                    
                    $img= basename($_FILES['userfile']['name']);
                    if($image!=""){
                      $fdir=$dir.$img;
                      move_uploaded_file($temp_name , $fdir);
                    }
                    $sql = "CALL insertSliderImage(?)";

                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $fdir, PDO::PARAM_LOB);
                    $stmt->execute();
                    echo "<script> alert('تم الرفع بنجاح') </script>";
                    echo "<meta http-equiv='refresh' content='0.1'>";
                  }else{
                    echo "<script> alert('الملف غير مدعوم. الملفات المدعومة هي pdf ، jpg ، jpeg ، gif ، swf ، tiff') </script>";
                  }
              }

                
            ?>
        </div>
</div>
  <?php }else{ ?>
  <div style="text-align: right;">
          <h4>لا يوجد صلاحية لرفع صورة</h4>
  <?php } ?>
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

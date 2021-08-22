<?php
session_start();
if (isset($_SESSION["id"])) {
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<title>Photos List</title>
    <meta charset="UTF-8">
     <meta name="description" content="">  
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">   
     <link rel="stylesheet"  href="bootstrap-5.0.0-beta1-dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href= 
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="../dist/fonts/fonts-fa.css">
    <link rel="stylesheet" href="../dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="../dist/css/rtl.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" />
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <style>
        @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
        /* font-family: 'Amiri', serif; */
    </style>
    <style>
    .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
    color: #fff;
    background: #1e282c;
    border-left-color: #00a65a;
}
.fa-search{
      color:white;
    }

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
        width:700px;
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
        </style>
    </head>
    <body>  
    <body class="skin-red sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
        <div class="wrapper">
    <form method="post" enctype="multipart/form-data">
        <header class="main-header">
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-icon-top navbar-expand-lg" style="background-color: #00a65a;">
          <h3 style="font-size: xx-large;" class="navbar-brand">عرض الصور </h3>
        </nav>
      </header>
      <?php
       include_once 'aside.php';
       ?>
        </div>
   
            <!-- Slideshow container -->
            <div class="slideshow-container">

              <!-- Full-width images with number and caption text -->
                <?php
                  $dir_name = "../../images/";
                  $images = glob($dir_name."*.jpg");
                  foreach($images as $image) {
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
              <input type="submit" class="btn btn-danger" value="حذف" name="remove">
              </div>
                <?php
                if(isset($_POST['remove']))
                {

                    unlink($_FILES['userfile']['tmp_name']);
                } 
                }
                  
                ?>
                
              <!-- Next and previous buttons -->
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
              <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
              
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
                </div>
                <div id="photo">
                
            <div style="text-align:center;margin:50px;width: 700px;color: #000;margin: 30px auto 0;padding: 50px;text-align: left;font-size: 14px;">
            <form  method="post" enctype="multipart/form-data">
            <div class="form-group row" style="text-align:center;margin:50px;">
            <h2>اختر صورة:</h2>
              <input class="form-control" type="file" name="userfile" id="userfile" style="margin-right: -95px;" >
              <input class="form-control" type="submit" value="Upload Image" name="submit" style="width: 110px;margin-top: -35px;margin-right: 440px;">
              </div>
            </form>
                </div>
            <?php
                if(isset($_POST['submit'])){
                    $dir ="../../images/";
                    $image=$_FILES['userfile']['name'];
                    $temp_name=$_FILES['userfile']['tmp_name'];
                    //$size=filesize($temp_name);
                    //echo($size);
                    
                    $img= basename($_FILES['userfile']['name']);
                    if($image!=""){
                    $fdir=$dir.$img.".jpg";
                    move_uploaded_file($temp_name , $fdir);
                    }
                }
            ?>
        </div>
</div>
</form>
    </body>
</html>  
<?php
} else {
  header('location:../login.php');
}
?>          
            
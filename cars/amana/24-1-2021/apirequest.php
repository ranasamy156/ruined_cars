<?php
include 'lang.php';
include '../../database.php';
  $reqID = $_GET['n'];
  
  $coordinates = array();
  $latitudes = array();
  $longitudes = array();

  $mapQuery = "CALL getMapById(?)";
  $stmt = $conn->prepare($mapQuery);
  $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
  $stmt->execute();
  $rowmap = $stmt->fetch();    
  $latitudes[] = $rowmap['lat'];
  $longitudes[] = $rowmap['lng'];
  $coordinates[] = 'new google.maps.LatLng(' . $rowmap['lat'] .','. $rowmap['lng'] .'),';

 //remove the comaa ',' from last coordinate
 $lastcount = count($coordinates)-1;
 $coordinates[$lastcount] = trim($coordinates[$lastcount], ",");	
?>
  <!DOCTYPE html>

  <html>
  
  <head>
  <meta charset="UTF-8">
    <title><?php echo $expr['requestdetails'] ?></title>
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

      * {
        box-sizing: border-box
      }

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
      .prev {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
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
        color: white;
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
      .prev:hover,
      .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
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

      /* Fading animation */
      .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
      }

      @-webkit-keyframes fade {
        from {
          opacity: .4
        }

        to {
          opacity: 1
        }
      }

      @keyframes fade {
        from {
          opacity: .4
        }

        to {
          opacity: 1
        }
      }

      .slideshow-container {
        max-width: 700px;
        position: relative;
        margin: auto;
      }

      /* .col-md-8 {
    width: 80%;
} */
      .row {
        margin-right: 100px;
        margin-left: -100px;
      }
      .dropbtn {
  background-color: black;
  color: white;
  padding: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: white;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
}
.fa-search{color:white;}
.dropdown-content a:hover {background-color: #f1f1f1;}
.dropdown:hover .dropdown-content {display: block;}
.dropdown:hover .dropbtn {background-color: grey;}
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

.adminpanel{
        width:100%;
        color:#000;
        margin:30px auto 0;
        padding:50px;
        text-align: <?php echo $expr['align'] ?>;
      font-size: 14px;
      margin-top: 0px;
    /* background-color: white; */
        }
        .fa-search{
      color:white;
    }
.progressbar li.active:before {
      border-color: #55b776;
  }
  .progressbar li.active + li:after {
      background-color: #55b776;
  }
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <style>
        @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
        /* font-family: 'Amiri', serif; */
    </style>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    </head>

  <body style="font-family:'Amiri', serif;">
 
  <div class="adminpanel">
  <?php
      include_once 'stepper.php';
      ?>
      <?php
          $mapQuery = "CALL getReqById(?)";
          $stmt = $conn->prepare($mapQuery);
          $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
          $stmt->execute();
          $requests = [];
        
          foreach($stmt as $row) {
              $req = array();
              $req["id"] = $row['id'];
              $req["sts_name"] = $row['sts_name'];
              $req["name"] = $row['name'];
              $req["plate_number"] = $row['plate_number'];
              $req["en_platenum"] = $row['en_platenum'];
              $req["color"] = $row['color'];
              $req["ar_name"] = $row['ar_name'];
              $req["ct_name"] = $row['ct_name'];
              $req["st_name"] = $row['st_name'];
              $req["man_name"] = $row['man_name'];
              $req["model_name"] = $row['model_name'];
              $req["chassis"] = $row['chassis'];
                array_push($requests, $req);
            }
      ?>
      <form method="post">
      <div class="row">
      
      <div class="col-md-8 m-auto" style="margin-top: 20px;margin-left: 85px;">
      <dl class="dl-horizontal">
      <h3 style="font-size: xx-large;font-family:'Amiri', serif;" class="navbar-brand"><?php echo $expr['requestdetails'] ?></h3>
      <dd><span style="font-size: medium;" class="label label-primary"><?php echo $req["sts_name"] ?></span></dd>
      </dl>
    
            
      <div>
          <table style="text-align:<?php echo $expr['align'] ?>;font-size:medium;width:100%" class="table">
            <tr>
              <td><?php echo $expr['requestnum'] ?></td>
              <td><?php echo $req["id"] ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['requestsender'] ?></td>
              <td><?php echo $req["name"] ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['platenum'] ?></td>
              <td><?php echo $req["plate_number"] ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['platenum'] ?></td>
              <td><?php echo $req["en_platenum"] ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['carcolor'] ?></td>
              <td>
              <div style=<?php

               echo "'width: 50px; height: 20px; background-color:#".$req["color"].";text-align:".$expr['align']. "margin-right:45%;'";
                            ?>>

                </div>
              </td>
            </tr>
            <tr>
              <td><?php echo $expr['area'] ?></td>
              <td><?php echo $req["ar_name"] ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['city'] ?></td>
              <td><?php echo $req["ct_name"] ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['state'] ?></td>
              <td>المدينة المنورة </td>
            </tr>
            <tr>
            <tr>
              <td><?php echo $expr['carman'] ?></td>
              <td><?php echo $req["man_name"] ?> </td>
            </tr>
            <tr>
              <td> <?php echo $expr['carmodel'] ?></td>
              <td><?php echo $req["model_name"] ?> </td>
            </tr>
            <tr>
              <td> <?php echo $expr['chassis'] ?></td>
              <td><?php echo $req["chassis"] ?> </td>
            </tr>
          </table>
          </div>
      <div class="outer-scontainer">
         
         <div id="map" style="width: 100%; height: 80vh;"></div>
     
         <script>
           function initMap() {
             var mapOptions = {
               zoom: 18,
               center: {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>}, //{lat: --- , lng: ....}
               mapTypeId: google.maps.MapTypeId.SATELITE
             };
     
             var map = new google.maps.Map(document.getElementById('map'),mapOptions);
     
             var RouteCoordinates = [
               <?php
                 $i = 0;
               while ($i < count($coordinates)) {
                 echo $coordinates[$i];
                 $i++;
               }
               ?>
             ];
     
             var RoutePath = new google.maps.Polyline({
               path: RouteCoordinates,
               geodesic: true,
               strokeColor: '#1100FF',
               strokeOpacity: 1.0,
               strokeWeight: 10
             });
     
             flag = 'img/flagg.png';
     
             startPoint = {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>};
             endPoint = {<?php echo'lat:'.$latitudes[$lastcount] .', lng:'. $longitudes[$lastcount] ;?>};
     
             var marker = new google.maps.Marker({
             position: endPoint,
              map: map,
              icon: flag,
              title:"End point!",
              animation: google.maps.Animation.DROP
           });
     
             RoutePath.setMap(map);
           }
     
           google.maps.event.addDomListener(window, 'load', initialize);
           </script>
      </div>
          <!-- Slideshow container -->
          <div class="slideshow-container">

            <!-- Full-width images with number and caption text -->
            <?php
            $sql = "CALL getReqImages(?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();

            
              foreach ($stmt as $rowphoto) {

            ?>

                <div class="mySlides">
                  <img src=<?php echo $rowphoto['path'] ?> style="height: 300px;width:100%;">
                </div>

            <?php
              }
            
            ?>

            <!-- Next and previous buttons -->
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <div style="text-align:center;padding:25px;">
              <?php
              for ($i = 0; $i < $count; $i++) { ?>
                <span class="dot" onclick="currentSlide($i)"></span>

              <?php }
              ?>

            </div>
          </div>
          <br>

          <!-- The dots/circles -->



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
              if (n > slides.length) {
                slideIndex = 1
              }
              if (n < 1) {
                slideIndex = slides.length
              }
              for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
              }
              for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex - 1].style.display = "block";
              dots[slideIndex - 1].className += " active";
            }
          </script>
      </div>
      </div>



      <?php require 'layoutjs.php'; ?>
  </form>
  </body>

  </html>

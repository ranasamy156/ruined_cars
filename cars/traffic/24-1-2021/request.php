<?php
include 'lang.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "4"){
  
    include_once '../database.php';
    $newdb = new Database();
    $new = $newdb->RunDML("update notification set seen = '1' where type_id = '4' and request_id =".$_GET['n']);
    
  $coordinates = array();
  $latitudes = array();
  $longitudes = array();

 // Select all the rows in the markers table
   // $query = "SELECT  `lat`, `lng` FROM `requests` WHERE ";
   // $mysqli->query($query) or die('data selection for google map failed: ' . $mysqli->error);
   include_once '../RequestClass.php';
   $db = new Requests();
 $result = $db->GetMapById();

  while ($row = mysqli_fetch_array($result)) {

   $latitudes[] = $row['lat'];
   $longitudes[] = $row['lng'];
   $coordinates[] = 'new google.maps.LatLng(' . $row['lat'] .','. $row['lng'] .'),';
 }

 //remove the comaa ',' from last coordinate
 $lastcount = count($coordinates)-1;
 $coordinates[$lastcount] = trim($coordinates[$lastcount], ",");	
?>
  <!DOCTYPE html>

  <html>
  
  <head>
  <meta charset="UTF-8">
    <title><?php echo $expr['requestdetails'] ?></title>
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

      /* .active,
      .dot:hover {
        background-color: #717171;
      } */

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
        /* margin-right: 100px; */
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
        text-align: <?php echo $expr['align'] ?>;
      font-size: 14px;
      margin-top: 0px;
    background-color: white;
        }
        .fa-search{
      color:white;
    }
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <style>
        @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
        /* font-family: 'Amiri', serif; */
    </style>
     <script>
   $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
<style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
        }
        .box{
        color: #fff;
        padding: 20px;
        display: none;
        border-top: white;
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
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>
  </head>

  <body class="skin-red sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
    <div class="wrapper">
    <?php
        include_once 'header.php';
      ?>
      
      <div class="content-wrapper">
      <?php
          include_once '../RequestClass.php';
          $req1 = new Requests();
          $modelcheck = $req1->GetMapById();
          $rowmodel = mysqli_fetch_assoc($modelcheck);
          if($rowmodel['model_id'] == 0 && $rowmodel['man_id'] == 0){
            $rs = $req1->GetReqById2();
          }elseif($rowmodel['man_id'] != 0 && $rowmodel['model_id'] == 0){
            $rs = $req1->GetReqById3();
          }else{
            $rs = $req1->GetReqById();
          }

          if ($row = mysqli_fetch_assoc($rs)) {
      ?>
      <form method="post">
    <div class="adminpanel">
      <div class="row">
     
      <div class="col-md-8 m-auto" style="margin-top: 20px;margin-left: 85px;">
      <h3 style="margin-top: -25px;font-size: xx-large;font-family:'Amiri', serif;" class="navbar-brand print-container"><?php echo $expr['requestdetails'] ?></h3>
      <button style="float:<?php echo $expr['left'] ?>;margin-<?php echo $expr['left'] ?>:15px;" onclick = "window.print()" class="btn btn-danger"><?php echo $expr['printreport'] ?></button>
      <img class="print-container" src=<?php echo $row['qr_path'] ?> style="height: 140px;float:<?php echo $expr['left']; ?>">
      <?php if ($row['lifting_procedure'] != 0) { ?>
        <!-- Button trigger modal -->
        <a class="btn btn-danger" href="view_lifting_request.php?n=<?php echo $row['lifting_procedure'] ?>&r=<?php echo $_GET['n'] ?>">عرض محضر الرفع</a>
        <?php } ?>
        <!-- acceptance table -->
        <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
                
              </div>
              <div class="col-sm-2"></div>
            </div>
          <!-- end of table -->
          <div class="print-container table-responsive">
          <table style="text-align:<?php echo $expr['align'] ?>;font-size:medium;width:100%" class="table table-borderd table-striped">
            <tr>
              <td><?php echo $expr['requestnum'] ?></td>
              <td><?php echo ($row["id"]); ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['requeststatus'] ?></td>
              <td> <?php echo ($row["sts_name"]); ?> </td>
            </tr>
            <?php
              if($row['reason'] != ""){
            ?>
            <tr>
              <td><?php echo $expr['reason'] ?></td>
              <td> <?php echo ($row["reason"]); ?> </td>
            </tr>
            <?php
              }
            ?>
            <tr>
              <td><?php echo $expr['requestsender'] ?></td>
              <td><?php echo ($row["name"]); ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['platenum'] ?></td>
              <td><?php echo ($row["plate_number"]); ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['platenum'] ?></td>
              <td><?php echo ($row["en_platenum"]); ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['carcolor'] ?></td>
              <td>
                <?php
                // $colorVal = (int)str_replace('ff', '', dechex($row['color']));
                //  $colorVal=0x795548;
                // $colorVal = "#" . $colorVal;


                ?>
                <div style=<?php

               echo "'width: 50px; height: 20px; background-color:#".$row['color'].";text-align:" .$expr['align']. "; margin-right:45%;'"
                            ?>>

                </div>
              </td>


            </tr>
            <!-- <tr> <td colspan="2" style="text-align:center"> موقع السيارة  </td></tr> -->
            <tr>
              <td><?php echo $expr['area'] ?></td>
              <td><?php echo ($row["ar_name"]); ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['city'] ?></td>
              <td><?php echo ($row["ct_name"]); ?> </td>
            </tr>
            <tr>
              <td><?php echo $expr['state'] ?></td>
              <td>المدينة المنورة </td>
            </tr>
            <tr>
              <td><?php echo $expr['baladya'] ?></td>
              <td><?php echo ($row["baladya"]); ?> </td>
            </tr>
            <?php if($rowmodel['man_id'] != 0){ ?>
            <tr>
              <td><?php echo $expr['carman'] ?></td>
              <td><?php echo ($row["man_arname"]); ?> </td>
            </tr>
            <?php } ?>
            <?php if($rowmodel['model_id'] != 0){ ?>
            <tr>
              <td> <?php echo $expr['carmodel'] ?></td>
              <td><?php echo ($row["model_arname"]); ?> </td>
            </tr>
            <?php } ?>
            <tr>
              <td> <?php echo $expr['chassis'] ?></td>
              <td><?php echo ($row["chassis"]); ?> </td>
            </tr>
          </table>
          </div>
          <!--
         <table style="margin:25px;text-align:center;" class="table table-borderd">
          <tr> <td> <a href="#" class="btn btn-primary" style="width:75px"> قبول </a> </td>
          <td> <a href="../delreq.php?n=<?php //echo ($row["id"]); 
            ?>" class="btn btn-danger" style="width:75px"> الغاء </a> </td></tr>
          <tr> <td> Google Map </td><td><a href="map.php?n=<?php // echo ($row["id"]); ?>">Map</a>  </td></tr>
          </table>

            delete comment:
            
            <?php //if($row1['user_id'] == $_SESSION['id']){ ?>
              <td> <a href="delcomment.php?n=<?php //echo ($row1['id']) ?>"> حذف </a> </td>
              <?php // } ?>

-->
<p style="page-break-after: always;"></p>
<div class="outer-scontainer print-container">
         
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
     
             //mark = 'img/mark.png';
             flag = 'img/flagg.png';
     
             startPoint = {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>};
             endPoint = {<?php echo'lat:'.$latitudes[$lastcount] .', lng:'. $longitudes[$lastcount] ;?>};
     
           //   var marker = new google.maps.Marker({
           //   	position: startPoint,
           //   	map: map,
           //   	icon: mark,
           //   	title:"Start point!",
           //   	animation: google.maps.Animation.BOUNCE
           //   });
     
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
<p style="page-break-after: always;"></p>
 <!-- Slideshow container -->
 <div class="container banner11 print-container">
          <div class="col-xs-6">

            <!-- Full-width images with number and caption text -->
            <?php

            $rs = $req1->GetReqImagesById();
            $count = $rs->num_rows;

            if ($rowphoto = mysqli_fetch_assoc($rs)) {
              foreach ($rs as $rowphoto) {

            ?>

          <div class="img-thumbnail" title="<?php echo $expr['photoinstruction'] ?>">
              <img src="<?php echo $rowphoto['path']; ?>" alt="Lights" class="img-rounded"  data-toggle="modal" data-target="#largeImgPanel<?php echo $rowphoto['id'] ?>" width="75" height="75">
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
                    <img src="<?php echo $rowphoto['path'] ?>" style="height:500px;width:100%;">
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
          </div>
          <center>
            <small><b>*<?php echo $expr['photoinstruction'] ?>*</b></small></br>
            <a href="printphotos.php?n=<?php echo $row['id'] ?>"><?php echo $expr['printphoto'] ?></a>
          </center>

            

           



          <!-- comments -->
          <!-- <form method="post"> -->
            <?php
          // include_once '../database.php';
          // $db = new Database();
          // $rs2 = $db->GetData("select com.* ,ustype.type as user_type, us.name from comments com, users_types ustype, users us where com.request_id = ".$_GET["n"]." and us.type_id = ustype.id and com.user_id = us.id");

              ?>

            
          <!-- <h2 class="print-container" style="font-family:'Amiri', serif;text-align:<?php //echo $expr['align'] ?>;"><?php //echo $expr['comments'] ?></h2>
          <table style="text-align:<?php //echo $expr['align'] ?>;font-size:medium;" class="table table-borderd table-striped print-container">
          <thead>
              <th> <?php //echo $expr['requestnum'] ?> </th>
              <th>  <?php //echo $expr['comment'] ?></th>
              <th>  <?php //echo $expr['usname'] ?></th>
              <th>  <?php //echo $expr['ustype'] ?></th>
            </thead>
          <?php
          // if ($row1 = mysqli_fetch_assoc($rs2)) {
          // foreach($rs2 as $row1){ ?>
            <tbody>
              <td> <?php //echo ($row1["request_id"]); ?> </td>
              <td> <?php //echo ($row1["description"]); ?>  </td>
              <td> <?php //echo ($row1["name"]); ?> </td>
               <td> <?php // echo ($row1["user_type"]); ?> </td>
            </tbody>
            <?php
                    //  }
                        ?>
              </table>
              <?php
           // }else{
              ?>
              <tbody>
              <td> <?php //echo $expr['nocomments'] ?> </td>
              </tbody>
           <?php 
            //}
            ?>
            </form>
          </table>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><?php //echo $expr['add'] ?> <?php //echo $expr['comment'] ?></button>
          <div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
              
              <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><?php //echo $expr['add'] ?> <?php //echo $expr['comment'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
              <form method="post">
          <div class="box box-info" style="text-align:<?php //echo $expr['align'] ?>;">
            <div class="box-body">
                <div>
                  <input type="text" name="comment" placeholder="<?php //echo $expr['add'] ?> <?php //echo $expr['comment'] ?>" maxlength="400" style="width: 100%; height: 125px; font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                </div>
            </div>
            <div class="box-footer clearfix">
              <button class="pull-<?php //echo $expr['left'] ?> btn btn-default" name="sendcomment"><?php //echo $expr['sendcomment'] ?> <i class="fa fa-arrow-circle-<?php //echo $expr['left'] ?>"></i></button>
            </div>
          </div>
          <?php
                    // if(isset($_POST["sendcomment"]))
                    // {
                    //     include_once "../database.php";
                    //     $db1=new Database();
                    //     $messageco = "تم اضافة تعليق جديد من المرور في طلب رقم ".$_GET['n'];
                    //     $rs1 = $db1->RunDML("insert into comments values (Default, '".$_POST['comment']."' , '".$_SESSION['id']."' , '".$_GET['n']."')");
                    //     $rs4 = $db1->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$messageco."' , '0' , '2')");
                    //     $rs5 = $db1->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$messageco."' , '0' , '3')");
                    //     $rs6 = $db1->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$messageco."' , '0' , '1')");
                    //     echo "<meta http-equiv='refresh' content='0.1'>";
                    //   }
                    ?>
          </form>
          </div>
              </div>
            </div>
          </div> -->
          <!-- end of comments -->

<!-- procedures -->
<!-- <div style="margin-bottom:5px;">
        <form method="post">
            <?php
          //  include_once '../Procedures.php';
          //  $req1 = new Procedures();
          //  $msg = $req1->GetReqProcedures();
          
               ?>
           
           <h2 class="print-container" style="font-family:'Amiri', serif;text-align:<?php //echo $expr['align'] ?>;"><?php //echo $expr['procedures'] ?></h2>
           <table style="text-align:<?php //echo $expr['align'] ?>;font-size:medium;" class="table table-borderd table-striped print-container">
           <thead>
               <th> <?php //echo $expr['requestnum'] ?> </th>
               <th>  <?php //echo $expr['prodesc'] ?></th>
               <th>  <?php //echo $expr['procedure'] ?></th>
               <th>  <?php //echo $expr['ustype'] ?></th>

             </thead>
           <?php 
          //   if ($row1 = mysqli_fetch_assoc($msg)) {
          //  foreach($msg as $row1){ ?>
             <tbody>
               <td> <?php //echo ($row1["request_id"]); ?> </td>
               <td> <?php //echo ($row1["prodesc"]); ?>  </td>
               <td> <?php //echo ($row1["description"]); ?>  </td>
               <td> <?php //echo ($row1["user_type"]); ?>  </td>
             </tbody>
             <?php
                       //}
                         ?>
               </table>
               <?php
             //}else{
               ?>
               <tbody>
               <td> <?php //echo $expr['noprocedures'] ?> </td>
               </tbody>
            <?php 
            // }
            ?>
            </form>
          </table>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lgg"><?php //echo $expr['add'] ?> <?php //echo $expr['procedure'] ?></button>
          <div class="modal bd-example-modal-lgg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="false">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><?php //echo $expr['choosepro'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
              <form method="post">
              <?php                
                // include_once '../Procedures.php';
                // $req1 = new Procedures();
                // $msg = $req1->GetAll(); 
              ?>
              <div class="dropdown">
                <select name="procedures" style="width:145px;">
                  <option value="choose" selected disabled><?php //echo $expr['choose'] ?> <?php //echo $expr['procedure'] ?></option>
                      <?php 
                        // if($row3 = mysqli_fetch_assoc($msg)){
                        //   foreach ($msg as $row3){ 
                      ?>
                  <option value="<?php //echo ($row3["id"]); ?>"><?php //echo ($row3["description"]); ?></option>
                      <?php //}} ?>
                </select>
                <div>
                  <input type="text" name="prodesc" placeholder="<?php //echo $expr['prodesc'] ?>" maxlength="400" style="width: 100%;margin-top:15px; height: 150px;font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                </div>
                <button class="btn btn-danger btn-sm" name="sendpro"><?php //echo $expr['save'] ?></button>
                <?php
                  // if(isset($_POST['sendpro'])){
                  //   $db5 = new database();
                  //   $messagepro = "تم اضافة اجراء جديد من المرور في طلب رقم ".$_GET['n'];
                  //   $msg = $db5->RunDML("insert into requests_procedures values (Default, '".$_POST['prodesc']."', '".$_POST['procedures']."', '".$_GET['n']."', '".$_SESSION['type_id']."')");
                  //   $msg2 = $db5->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$messagepro."' , '0' , '2')");
                  //   $msg3 = $db5->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$messagepro."' , '0' , '3')");
                  //   $msg4 = $db5->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$messagepro."' , '0' , '1')");
                  //     echo "<meta http-equiv='refresh' content='0.1'>";	
                  // }
                ?>
                </div>
           </form>
              </div>
            </div>
          </div>
        </div>
</div> -->
<!-- end of procedures -->
<!-- CHANGE STATUS BUTTON -->
<center>
<!-- <div style="margin-bottom:5px;">
          <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target=".bd-example-modal-lggg"><?php //echo $expr['changestatus'] ?></button>
          <div class="modal bd-example-modal-lggg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="false">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><?php // echo $expr['statuslist'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
              <form method="post">
              <?php                
                // include_once '../Status.php';
                // $hs = new Status();
                // $sh = $hs->GetAll(); 
              ?>
              <div class="dropdown">
                <select name="stat" style="width:145px;">
                  <option value="choose" selected disabled><?php //echo $expr['choose'] ?> <?php //echo $expr['onestatus'] ?></option>
                      <?php 
                        // if($roww = mysqli_fetch_assoc($sh)){
                        //   foreach ($sh as $roww){ 
                      ?>
                  <option value="<?php //echo ($roww["id"]); ?>"><?php //echo ($roww["description"]); ?></option>
                      <?php //}} ?>
                </select>
                </br></br><button class="btn btn-danger btn-md" name="chngests"><?php //echo $expr['changestatus'] ?></button>
                <?php
                  // if(isset($_POST['chngests'])){
                  //   include_once '../database.php';
                  //   $change = new Database();
                  //   $messagests = "تم تغيير حالة الطلب رقم ".$_GET['n'];
                  //   $stat = $change->RunDML("update request set status_id='".$_POST['stat']."' where id='".$_GET["n"]."' ");
                  //   $stat2 = $change->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$messagests."' , '0' , '2')");
                  //   $stat3 = $change->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$messagests."' , '0' , '3')");
                  //   $stat4 = $change->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$messagests."' , '0' , '1')");
                  //   echo "<meta http-equiv='refresh' content='0.1'>";
                  //  }
                ?>
                </div>
           </form>
              </div>
            </div>
          </div>
        </div>
</div> -->
</center>
<!-- end of change status button -->

          <!-- OLD STATUSES BUTTONS -->
          <?php
          //  include_once '../RequestClass.php';
          //  $req1 = new Requests();
          //  $rs = $req1->GetReqById();
 
          //  if ($row = mysqli_fetch_assoc($rs)) {
          //   if($row["sts_name"] == "تحت مراجعة المرور"){
              ?>
<!--               
            <button name="btnaccept" class="btn btn-success btn-lg" style="float:right"><?php //echo $expr['acceptrequest'] ?></button>
            <button name="btnreject" class="btn btn-danger btn-lg" style="float:left"><?php //echo $expr['rejectrequest'] ?></button>
            -->
            <?php
            //     if(isset($_POST['btnaccept'])){
            //       include_once '../database.php';
            //       $acc = new Database();
            //       $message = " طلب رقم ".$_GET['n']." تحت مراجعة المباحث.";
            //       // $log = $acc->RunDML("insert into investigation values (Default, ".$row['id']." , '13')");
            //       // $log2 = $acc->RunDML("update traffic set status_id='13' where request_id='".$row['id']."'");
            //       $log3 = $acc->RunDML("update request set status_id='13' where id='".$row['id']."'");
            //       $log7 = $acc->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$message."' , '0' , '3')");
            //       echo "<meta http-equiv='refresh' content='0.1'>";

            //     }elseif (isset($_POST['btnreject'])) {
            //       include_once '../database.php';
            //       $acc1 = new Database();
            //       $message1 = "  تم رفض الطلب رقم ".$_GET['n']." 
            //     من قبل المرور.";
            //       // $log1 = $acc1->RunDML("update traffic set status_id='18' where request_id='".$row['id']."'");
            //       $log2 = $acc1->RunDML("update request set status_id='18' where id='".$row['id']."'");
            //       $log4 = $acc1->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$message1."' , '0' , '2')");
            //     $log5 =  $acc1->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$message1."' , '0' , '3')");
            //     $log6 =  $acc1->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$message1."' , '0' , '1')");
            //       echo "<meta http-equiv='refresh' content='0.1'>";

            //     }
            // }elseif($row["sts_name"] == "تم قبول السيارة - تحت مراجعة المرور"){
              ?>
<!--               
            <button name="btnaccept1" class="btn btn-success btn-lg" style="float:right"><?php //echo $expr['acceptrequest'] ?></button>
            <button name="btnreject1" class="btn btn-danger btn-lg" style="float:left"><?php //echo $expr['rejectrequest'] ?></button>
            -->
            <?php
            //     if(isset($_POST['btnaccept1'])){
            //       include_once '../database.php';
            //       $acc = new Database();
                  
            //       // $log = $acc->RunDML("update investigation set status_id='20' where request_id='".$row['id']."'");
            //       // $log2 = $acc->RunDML("update traffic set status_id='20' where request_id='".$row['id']."'");
            //       $log4 = $acc->RunDML("update request set status_id='20' where id='".$row['id']."'");
            //       echo "<meta http-equiv='refresh' content='0.1'>";
            //     }elseif (isset($_POST['btnreject1'])) {
            //       include_once '../database.php';
            //       $acc1 = new Database();
            //     //   $log3 = $acc1->RunDML("update investigation set status_id='18' where request_id='".$row['id']."'");
            //     // $log1 = $acc1->RunDML("update traffic set status_id='18' where request_id='".$row['id']."'");
            //     $log2 = $acc1->RunDML("update request set status_id='18' where id='".$row['id']."'");
            //     echo "<meta http-equiv='refresh' content='0.1'>";

            //     }
            // }elseif ($row["sts_name"] == "تم قبول السيارة") {
              ?>
                    <!-- <button name="btntraffic" class="btn btn-default btn-lg" style="float:<?php //echo $expr['right'] ?>">استئناف المراجعة</button> -->
              <?php
            //        if(isset($_POST['btntraffic'])){
            //          include_once '../database.php';
            //          $not = new Database();
            //          $notification = " تستأنف المرور مراجعة الطلب رقم ".$_GET['n'];
            //          $mm = $not->RunDML("update request set status_id='25' where id='".$row['id']."'");
            //          $mm1 = $not->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$notification."' , '0' , '2')");
            //          $mm2 = $not->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$notification."' , '0' , '1')");
            //          $mm3 = $not->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$notification."' , '0' , '3')");
            //          echo "<meta http-equiv='refresh' content='0.1'>";
   
   
            //        }
            //  }elseif ($row["sts_name"] == "استئناف المراجعة من قبل المرور") {
              ?>
            <!-- <button name="btnaccept1" class="btn btn-success btn-lg" style="float:right"><?php //echo $expr['acceptrequest'] ?></button>
            <button name="btnreject1" class="btn btn-danger btn-lg" style="float:left"><?php //echo $expr['rejectrequest'] ?></button> -->
                         <?php
        //            if(isset($_POST['btntraffic'])){
        //              include_once '../database.php';
        //              $not = new Database();
        //              $notification = " تستأنف المرور مراجعة الطلب رقم ".$_GET['n'];
        //              $mm = $not->RunDML("update request set status_id='25' where id='".$row['id']."'");
        //              $mm1 = $not->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$notification."' , '0' , '2')");
        //              $mm2 = $not->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$notification."' , '0' , '1')");
        //              $mm3 = $not->RunDML("insert into notification values (Default, '".$_GET['n']."' , '".$notification."' , '0' , '3')");
        //              echo "<meta http-equiv='refresh' content='0.1'>";
   
   
        //            }
        //      }
        // }
              
              ?>
        </div>
        




      </div>
      </div>

      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


<!--remenber to put your google map key-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-dFHYjTqEVLndbN2gdvXsx09jfJHmNc8&callback=initMap"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    </form>
  </body>

  </html>
<?php
} ?>
<?php
} }else {
  header('location:http://alsaifit.com/');
}
?>
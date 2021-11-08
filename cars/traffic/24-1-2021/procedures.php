<?php
include 'lang.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "4"){
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['procedures'] ?></title>
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
    <style>
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
}
      .icons {
        color: #AF121E;
        width: 500px;
        height: 200px;
        border: 5px solid #AF121E;
      }
      .fa-search{
      color:white;
    }

      .main-header .navbar-brand {
        color: #fff;
        /*    <!-- margin-right: 500px; -->*/
      }

      .box.box-info {
        border-top-color: white;
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

      .active,
      .dot:hover {
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
        /* margin-left: -100px; */
        padding: 20px;
        padding-right: 60px;
        padding-top: 0px;
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
        text-align:<?php echo $expr['align'] ?>;
      font-size: 14px;
      margin-top: 0px;
    background-color: white;
        }
        .fa-search{
      color:white;
    }
    
    </style>
  </head>

  <body class="skin-red sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
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
          <div class="box box-info" style="text-align:center;">
          <h3 style="margin-top: -25px;font-size: xx-large;font-family:'Amiri', serif;" class="navbar-brand"><?php echo $expr['proadd'] ?></h3>

            <div class="box-body">
              <form method="post">
                <div>
                  <input type="text" name="des" placeholder="<?php echo $expr['proadd'] ?>" maxlength="400" style="width: 100%; height: 125px; font-size: medium; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" />
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-<?php echo $expr['left'] ?> btn btn-default" name="btnsave"><?php echo $expr['save'] ?> <i class="fa fa-arrow-circle-<?php echo $expr['left'] ?>"></i></button>
                </div>
                <?php
                    if(isset($_POST["btnsave"]))
                    {
                      $des = $_POST["des"];
                      $typeID = $_SESSION['type_id'];
                      $sql = "CALL insertProcedures(? , ?)";
  
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(1, $des, PDO::PARAM_STR, 100);
                      $stmt->bindParam(2, $typeID, PDO::PARAM_INT);
                      $rs = $stmt->execute();
                      if($rs){
                        echo("<div class='alert alert-success'>".$expr['proceduresuccess']."</div>");
                      }
                      else
                        echo("<div class='alert alert-danger'> Error is ".$rs."</div>");	
                      }
                    ?>
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

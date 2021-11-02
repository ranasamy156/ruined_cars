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
    <title><?php echo $expr['cardetails'] ?></title>
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
    <style>
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
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
        text-align:left;
      font-size: 14px;
      margin-top: 0px;
    background-color: white;
        }
        .fa-search{
      color:white;
    }
    .box.box-info {
    border-top-color: white;
}
    </style>
  </head>

  <body class="skin-green sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
    <div class="wrapper">
      <?php
        include_once 'header.php';
      ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php
        include_once 'aside.php';
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <div class="adminpanel">
      <div class="row">
        <div class="col-xs-12">
            <h3 style="float:right;">رقم الطلب</h3></br>
        </div>
      </div>
      <div class="row">
            <div class="col-xs-4">
                <input type="text" name="" class="form-control">
            </div>
            <div class="col-xs-4">
                <button class="btn btn-primary" style="float:right;">بحث</button>
            </div>
      </div>
          </div>
      </div>
      </div>
        <!-- Content Header (Page header) -->

        <?php require 'layoutjs.php'; ?>
  </body>

  </html>
  <?php
 }  } else {
    header('location:http://alsaifit.com/');
  }
?>
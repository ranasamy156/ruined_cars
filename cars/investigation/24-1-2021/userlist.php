<?php
include 'lang.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["permission_des"] == 'admin' &&  $_SESSION["type_id"] == "3") {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['uslist'] ?></title>
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
        text-align: <?php echo $expr['align'] ?>;
      font-size: 14px;
      margin-top: 0px;
    background-color: white;
        }
        .fa-search{
      color:white;
    }
    /* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	td:nth-of-type(1):before { content: "First Name"; }
	td:nth-of-type(2):before { content: "Last Name"; }
	td:nth-of-type(3):before { content: "Job Title"; }
	td:nth-of-type(4):before { content: "Favorite Color"; }
	td:nth-of-type(5):before { content: "Wars of Trek?"; }
	td:nth-of-type(6):before { content: "Secret Alias"; }
	td:nth-of-type(7):before { content: "Date of Birth"; }
	td:nth-of-type(8):before { content: "Dream Vacation City"; }
	td:nth-of-type(9):before { content: "GPA"; }
	td:nth-of-type(10):before { content: "Arbitrary Data"; }
}
    </style>
  </head>

  <body class="skin-yellow sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
    <div class="wrapper" >
      <?php
        include_once 'header.php';
      ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php
        include_once 'aside.php';
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
            <form method="post">
          <div class="adminpanel">
          <h2 style="font-family:'Amiri', serif;text-align:center;"><?php echo $expr['uslist'] ?></h2>
          <?php
            $sql = "CALL getUsers(? , ?)";
            $typeID = $_SESSION['type_id'];
            $userID = $_SESSION['id'];

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $typeID, PDO::PARAM_INT);
            $stmt->bindParam(2, $userID, PDO::PARAM_INT);
            $stmt->execute();
            
            
    ?>
          <table style="margin:25px;text-align:<?php echo $expr['align'] ?>;font-size:large;" class="table table-borderd table-striped">
          <thead>
              <th> <?php echo $expr['users'] ?> </th>
              <th> <?php echo $expr['edit'] ?> </th>
              <th> <?php echo $expr['remove'] ?> </th>
            </thead>
            <?php foreach($stmt as $row){ ?>
            <tbody>
              <td><?php echo ($row["name"]); ?></td>
              <td> <a href="useredit.php?n=<?php echo ($row["id"]); ?>" ><?php echo $expr['edit'] ?> </a></td>
              <td> <a href="deluser.php?n=<?php echo ($row["id"]); ?>" ><?php echo $expr['remove'] ?> </a></td>

            </tbody>
            <?php
              }
            ?>
              
            </table>
          </div>
      
        <!-- Content Header (Page header) -->

        <?php require 'layoutjs.php'; ?>
  </body>

  </html>
<?php
  }else {
    header('location:../index.php');
} } else {
  header('location:http://alsaifit.com/');
}
?>

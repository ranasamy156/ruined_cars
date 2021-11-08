<?php
include 'lang.php';
  include_once '../../database.php';
  $sql = "CALL getReqImages(?)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $_GET['n'], PDO::PARAM_INT);
  $stmt->execute();
  $count = $stmt->rowCount();

?>
<head>
<meta charset="UTF-8">
    <title><?php echo $expr['requestdetails'] ?></title>
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
<style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
        }
    </style>
</head>
<body>
    
<center><button onclick = "window.print()" class="btn btn-success"><?php echo $expr['printreport'] ?></button></br></br> </center>
<?php
      foreach ($stmt as $rowphoto) {
?>
<center>
<img class="print-container" src="<?php echo $rowphoto['path']; ?>" width="600px" height="600px">
<p style="page-break-after: always;"></p>
</center>
<?php
    }
?>
</body>
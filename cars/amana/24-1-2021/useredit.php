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
    <title> <?php echo $expr['edit'] ?> <?php echo $expr['profile'] ?></title>
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
      <div class="content-wrapper">
      <?php
            $sql = "CALL getUserByID(?)";
            $userID = $_GET['n'];

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $userID, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($row = $stmt->fetch()) {
          ?>
            <form method="post">
          <div class="adminpanel">
          <h2 style="font-family:'Amiri', serif;text-align:center;">  <?php echo $expr['edit'] ?> <?php echo $expr['profile'] ?> </h2>
          <table style="width:100%">
            <tr>
              <td style="width:180px;"><?php echo $expr['usname'] ?></td>
              <td><input value="<?php echo $row['name']; ?>" style="width:220px;" type="text" name="name" required autocomplete="name"></td>
            </tr>
            <tr>
              <td style="width:180px;"><?php echo $expr['usphone'] ?></td>
              <td><input value="<?php echo $row['phone']; ?>" style="width:150px;" type="text" name="phone" required autocomplete="phone"></td>
            </tr>
            <tr>
              <td style="width:180px;"><?php echo $expr['usemail'] ?></td>
              <td><input value="<?php echo $row['user_name']; ?>" style="width:150px;" type="text" name="username" required autocomplete="username"></td>
            </tr>
            <tr>
              <td style="width:180px;"><?php echo $expr['uspass'] ?></td>
              <td><input value="<?php echo $row['password']; ?>" style="width:150px;" type="password" name="password" required autocomplete="password"></td>
            </tr>
            <tr>
              <td style="width:180px;"><?php echo $expr['usconpass'] ?></td>
              <td><input value="<?php echo $row['password']; ?>" style="width:150px;" type="password" name="confirm" required autocomplete="confirm"></td>
            </tr>
          </table>
            <div>
            <button class="btn btn-primary" name="btnupdate" style="margin-top: 15px;margin-right: 120px;"><?php echo $expr['save'] ?></button>
            </div>
            
            <form method="post">
            
            <?php
              if(isset($_POST["btnupdate"]))
              {
                // $p="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
                // if(preg_match($p,$_POST["password"]))
                // {
                  if($_POST["password"] == $_POST["confirm"])
                  {
                    $name = $_POST["name"];
                    $phone = $_POST["phone"];
                    $userName = $_POST["username"];
                    $pass = $_POST["password"];
                    $userID = $_GET['n'];
                    $sql = "CALL updateUser(? , ? , ? , ? , ?)";

                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $name, PDO::PARAM_STR, 100);
                    $stmt->bindParam(2, $phone, PDO::PARAM_STR, 100);
                    $stmt->bindParam(3, $userName, PDO::PARAM_STR, 100);
                    $stmt->bindParam(4, $pass, PDO::PARAM_STR, 100);
                    $stmt->bindParam(5, $userID, PDO::PARAM_INT);
                    $stmt->execute();
                    echo("<div class='alert alert-success'>" .$expr['editsuccess']. "</div>");	
                    echo "<meta http-equiv='refresh' content='0.1'>";
                    // else if (strpos($msg,'user_name'))
                    //   echo("<div class='alert alert-warning'>" .$expr['usernamemessage']. "</div>");	
                  }else {
                    echo("<div class='alert alert-danger'>" .$expr['confirmpassmessage']. "</div>");

                  }
                    

                }
              
                // else
                // {
                //   echo("<div class='alert alert-danger'> Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</div>");
                // }
              ?>
            </form>
            <?php
            }else echo "error";
            ?>
          </table>
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

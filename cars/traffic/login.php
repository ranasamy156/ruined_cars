<?php
  session_start();
?>
<!DOCTYPE html>

<html dir="rtl" lang="ar">
   <head>
     <meta charset="UTF-8">
     <meta name="description" content="">  
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">   
     <link rel="stylesheet"  href="24-1-2021/bootstrap-5.0.0-beta1-dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="24-1-2021/css/style.css">
    <style>
        .adminpanel{
        width:700px;
        color:#000;
        margin:30px auto 0;
        padding:50px;
        border:1px solid #ddd;
        text-align:left;
      font-size: 14px;
        }
    </style>
    <title>Login</title>    
   </head>
    <body>
    <form method="POST">
        <div class="container  mt-5">
        <div class="row">
        <div class="col-md-8 m-auto">
          <h1> تسجيل الدخول </h1> </break></break>
          <div class="adminpanel">
          <table style="margin:25px;text-align:center;">
            <tr>
				<td>اسم المستخدم</td>
				<td><input type="text" name="username" required autocomplete="username"></td>
			</tr>
            <tr>
				<td>كلمة السر </td>
				<td><input type="password" name="password" required autocomplete="password"></td>
			</tr>
            <tr>
				<td colspan="2"><input type="submit" class="btn btn-warning" value="Login" name="btnlogin"></td>
			</tr>
                        <?php
                                               
                             if(isset($_POST["btnlogin"])){
                                    include_once 'users.php';
                                    $user1= new Users();
                                    
                                    $user1->setusername($_POST["username"]);
                                    $user1->setpassword($_POST["password"]);
                                    $log=$user1->Login();
                                    if($row=mysqli_fetch_assoc($log)){
                                        $_SESSION["id"]=$row["id"];
                                        $_SESSION["permission_des"]=$row["permission_des"];
                                        $_SESSION["name"]=$row["name"];
                                        $_SESSION["phone"]=$row["phone"];
                                       
                                    }
                                    echo("<script> window.open('index.php' , '_self')</script>");
                                    }
                    ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
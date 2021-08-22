<?php
  session_start();
?>

<html dir="rtl" lang="ar">
   <head>
     <meta charset="UTF-8">
     <meta name="description" content="">  
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">   
     <link rel="stylesheet"  href="bootstrap-5.0.0-beta1-dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href= 
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
      
    <style>
        .icons { 
            color: #AF121E; 
            width: 500px; 
            height: 200px; 
            border: 5px solid #AF121E; 
        } 
        
        </style>
    <title>Add Photo</title>    
   </head>
    
    <body>
    <form method="post" enctype="multipart/form-data">
        <div class="container  mt-5">
        <div class="row">
        <div class="col-md-8 m-auto">
          <a href="../index.php" class="btn btn-warning">Home</a>
          <h1>اضافة صورة </h1> </break></break>
          <form  method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="userfile" id="userfile">
  <input type="submit" value="Upload Image" name="submit">
</form>
            <div style="text-align:center;margin:50px;">
            <button name="btnsave" class="btn btn-danger">حفظ</button>
                </div>
            <?php
                if(isset($_POST['submit'])){
                    $dir ="uploads/";
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
        </div>

         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
   
    
        
</form>
    </body>
</html>
                                    
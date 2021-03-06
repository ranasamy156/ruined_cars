<?php
include 'lang.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["permission_des"] == 'admin' && $_SESSION["type_id"] == "1") {
    if((time() - $_SESSION['last_login_timestamp']) > 21600) // 6 hours  
           {  
                header("location:../logout.php");  
           }  
           else  
           {
              $_SESSION['last_login_timestamp'] = time();  
              
                $reqID = $_GET['r'];
                $mapQuery = "CALL getMapById(?)";
                $stmt = $conn->prepare($mapQuery);
                $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                $stmt->execute();
                $rowmap = $stmt->fetch();
                
                
                if($rowmap['model_id'] == 0 && $rowmap['man_id'] == 0){
                  $reqQuery = "CALL getReqById2(?)";
                }elseif($rowmap['man_id'] != 0 && $rowmap['model_id'] == 0){
                  $reqQuery = "CALL getReqById3(?)";
                }else{
                  $reqQuery = "CALL getReqById(?)";
                }
                try{
                  $stmt = $conn->prepare($reqQuery);
                  $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                  $stmt->execute();
                  $row = $stmt->fetch();
                  // print("<pre>".print_r($row2,true)."</pre>");
                  // exit;
                }catch(PDOException $e){
                  print("Exception".$e->getMessage());
                };
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title><?php echo $expr['mainmenu'] ?></title>
    <!-- CSS FILES --> 
    <?php require 'layout.php'; ?>
    <!-- CSS FILES --> 
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
        text-align:left;
      font-size: medium;
      margin-top: 0px;
    background-color: white;
    text-align:right;
        }
        .fa-search{
      color:white;
    }
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    padding: 5px;
    text-align: center;
}
@media (min-width: 992px){  
.col-md-12 {
    width: 55%;
}
}
/* Chrome, Safari, Edge, Opera */
input required::-webkit-outer-spin-button,
input required::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input required[type=number] {
  -moz-appearance: textfield;
}
    </style>
  </head>

  <body class="skin-blue sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
    <div class="wrapper" >
      <?php
        include_once 'header.php';
      ?>
      
      <!-- Content Wrapper. Contains page content -->
      <form autocomplete="off" method="post" enctype="multipart/form-data">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- <div class="row">
            <img src="../../images/pro_header.jpeg" width="100%" height="500px">  
        </div> -->
        <div class="row">
          <div class="col-sm-12">
            <h1 style="font-family:'Amiri'; text-align:center">?????????? ???????? ?????? ?????????? ?????? <?php echo $_GET['r'] ?></h1>
          </div>
        </div></br>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-4">
            <label for="date">??????????????</label>
            <input required type="datetime-local" name="date" class="form-control">
          </div>
          <div class="col-sm-2">
            <label for="date">?????? ??????</label></br>
            <input required type="radio" name="type" value="?????????? ????????"> ?????????? ????????</br>
            <input required type="radio" name="type" value="???????? ????????"> ???????? ????????</br>
            <input required type="radio" name="type" value="?????????? ??????????"> ?????????? ??????????</br>
            <input required type="radio" name="type" value="???????? ?????????? ??????????"> ???????? ?????????? ??????????</br>
            <input required type="radio" name="type" value="???????? ????????????"> ???????? ????????????</br>
          </div>
          <div class="col-sm-2" style="font-size:large">
            <label for="date">???? ???????? ??????????: </label>
            <?php echo $row['baladya'] ?>
          </div>
          <div class="col-sm-3">
            <input required type="file" name="upload[]" multiple="multiple">
          </div>
        </div></br>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10 m-auto">
            <div class="table-responsive">
              <table class="table adminpanel">
                <thead>
                  <th>??????????</th>
                  <th>?????? ????????????</th>
                  <th>?????? ????????????</th>
                  <th>??????????</th>
                  <th>????????????</th>
                </thead>
                
                <tbody>
                  <?php
                    if($rowmap['model_id'] == 0 && $rowmap['man_id'] == 0){
                      echo '???? ????????';
                    }elseif($rowmap['man_id'] != 0 && $rowmap['model_id'] == 0){
                      echo '<td>'.$row['man_arname'].' </td>';
                    }else{
                      echo '<td>'.$row['man_arname'].' - '.$row['model_arname'].' </td>';
                    }
                  ?>
                  <td><?php echo $row['plate_number'] ?></td>
                  <td><?php echo $row['chassis'] ?></td>
                  <td><div style=<?php echo "'width: 50px; height: 20px; background-color:#".$row['color'].";text-align:".$expr['align']. "margin-right:45%;'";?>></div></td>
                  <td><?php echo $row['ct_name'] ?> - <?php echo $row['baladya'] ?> - <?php echo $row['ar_name'] ?></td>
                </tbody>
                
              </table>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div></br>

          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">????????????</th>
                    <th>??????????</td>
                    <th> ?????????????? </td>
                    <th> ???????????? </td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="structure_top" value="????????" /> ????????</td>
                    <td><input required type="radio" name="structure_fenders" value="????????" /> ????????</td>
                    <td><input required type="radio" name="structure_engine_hood" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="structure_top" value="????????" /> ????????</td>
                    <td><input required type="radio" name="structure_fenders" value="????????" /> ????????</td>
                    <td><input required type="radio" name="structure_engine_hood" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="structure_top" value="?????? ??????????" /> ?????? ??????????</td>
                    <td><input required type="radio" name="structure_fenders" value="?????? ??????????" /> ?????? ??????????</td>
                    <td><input required type="radio" name="structure_engine_hood" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="structure_top" value="??????????" /> ??????????</td>
                    <td><input required type="radio" name="structure_fenders" value="??????????" /> ??????????</td>
                    <td><input required type="radio" name="structure_engine_hood" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">????????????</th>
                    <th>??????????????</td>
                    <th> ???????????? </td>
                    <th> ?????????????? </td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_glass" value="????????" /> ????????</td>
                    <td><input required type="radio" name="back_glass" value="????????" /> ????????</td>
                    <td><input required type="radio" name="side_glass" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_glass" value="????????" /> ????????</td>
                    <td><input required type="radio" name="back_glass" value="????????" /> ????????</td>
                    <td><input required type="radio" name="side_glass" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_glass" value="?????? ??????????" /> ?????? ??????????</td>
                    <td><input required type="radio" name="back_glass" value="?????? ??????????" /> ?????? ??????????</td>
                    <td><input required type="radio" name="side_glass" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_glass" value="??????????" /> ??????????</td>
                    <td><input required type="radio" name="back_glass" value="??????????" /> ??????????</td>
                    <td><input required type="radio" name="side_glass" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">??????????????</th>
                    <th>????????????????</td>
                    <th>??????????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_doors" value="????????" /> ????????</td>
                    <td><input required type="radio" name="back_doors" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_doors" value="????????" /> ???????? ??????????: <input type="number" name="front_doors_no" style="width:25%"/></td>
                    <td><input required type="radio" name="back_doors" value="????????" /> ???????? ??????????: <input type="number" name="back_doors_no" style="width:25%"/></td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_doors" value="?????? ??????????" /> ?????? ??????????</td>
                    <td><input required type="radio" name="back_doors" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_doors" value="??????????" /> ??????????</td>
                    <td><input required type="radio" name="back_doors" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">????????????????</th>
                    <th>????????????????</td>
                    <th> ?????????????? </td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_tires" value="????????" /> ????????</td>
                    <td><input required type="radio" name="back_tires" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_tires" value="????????" /> ???????? ??????????: <input type="number" name="front_tires_no" style="width:25%"/></td>
                    <td><input required type="radio" name="back_tires" value="????????" /> ???????? ??????????: <input type="number" name="back_tires_no" style="width:25%"/></td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_tires" value="?????? ??????????" /> ?????? ??????????</td>
                    <td><input required type="radio" name="back_tires" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_tires" value="??????????" /> ??????????</td>
                    <td><input required type="radio" name="back_tires" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="5">??????????????</th>
                    <th>????????????????</td>
                    <th> ?????????????? </td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_lights" value="????????" /> ????????</td>
                    <td><input required type="radio" name="back_lights" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_lights" value="????????" /> ???????? ??????????: <input type="number" name="front_lights_no" style="width:25%"/></td>
                    <td><input required type="radio" name="back_lights" value="????????" /> ???????? ??????????: <input type="number" name="back_lights_no" style="width:25%"/></td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_lights" value="?????? ??????????" /> ?????? ??????????</td>
                    <td><input required type="radio" name="back_lights" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_lights" value="??????????" /> ??????????</td>
                    <td><input required type="radio" name="back_lights" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>????????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="paints" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="paints" value="??????????" /> ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="paints" value="????????????" /> ????????????</td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????? 1</th>
                    <th>?????????????? 2</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="mirrors_1" value="????????" /> ????????</td>
                    <td><input required type="radio" name="mirrors_2" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="mirrors_1" value="????????" /> ????????</td>
                    <td><input required type="radio" name="mirrors_2" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="mirrors_1" value="?????? ??????????" /> ?????? ??????????</td>
                    <td><input required type="radio" name="mirrors_2" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="mirrors_1" value="??????????" /> ??????????</td>
                    <td><input required type="radio" name="mirrors_2" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="seats" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="seats" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="seats" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="seats" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="gear_box" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="gear_box" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="gear_box" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="gear_box" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="difference" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="difference" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="difference" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="difference" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????? ??????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="grille" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="grille" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="grille" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="grille" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>???????????? ??????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_bumper" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_bumper" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_bumper" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="front_bumper" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="dashboard" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="dashboard" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="dashboard" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="dashboard" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????????? ????????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="internal_decorations" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="internal_decorations" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="internal_decorations" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="internal_decorations" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????? ?? ????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="radio" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="radio" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="radio" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="radio" value="??????????" /> ??????????</td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>???????????? ????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="back_bumper" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="back_bumper" value="????????" /> ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="back_bumper" value="?????? ??????????" /> ?????? ??????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="back_bumper" value="??????????" /> ??????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="plates" value="????????" /> ????????: ?????????? <input type="number" name="number_of_plates" style="width:25%"></td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="plates" value="???? ????????" /> ???? ????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-6 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>????????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="engine" value="???? ????????" /> ???? ????????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="engine" value=" ????????" /> ???????? ???? ??????: <input type="text" name="engine_exception" style="width:50%"></td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>???????? ??????????????</th>
                  </tr>
                  <tr>
                    <td><input type="radio" name="car_condition" value="????????????" /> ????????????</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="car_condition" value="????????????" /> ????????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????? ??????????</th>
                  </tr>
                  <tr>
                    <td><input type="radio" name="is_armed" value="??????" /> ??????</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="is_armed" value="?????? ????????" />?????? ????????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????? ??????????</th>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="is_protected" value="??????" /> ??????</td>
                  </tr>
                  <tr>
                    <td><input required type="radio" name="is_protected" value="????" /> ????</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????</th>
                  </tr>
                  <tr>
                    <td><textarea name="notes" class="form-control" cols="15" rows="5"></textarea></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-3">
                  <button class="btn btn-primary btn-lg" name="save"><?php echo $expr['save'] ?></button>
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
            <!-- <img src="../../images/pro_footer.jpeg" width="100%" height="200px">   -->
          <?php
            if(isset($_POST['save'])){
              try{
                  $reqID = $_GET['r'];
                  $structure_top = $_POST['structure_top'];
                  $structure_fenders = $_POST['structure_fenders'];
                  $structure_engine_hood = $_POST['structure_engine_hood'];
                  $front_doors = $_POST['front_doors'];
                  $back_doors = $_POST['back_doors'];
                  $front_doors_no = $_POST['front_doors_no'];
                  $back_doors_no = $_POST['back_doors_no'];
                  $front_lights = $_POST['front_lights'];
                  $back_lights = $_POST['back_lights'];
                  $gear_box = $_POST['gear_box'];
                  $back_lights_no = $_POST['back_lights_no'];
                  $front_lights_no = $_POST['front_lights_no'];
                  $difference = $_POST['difference'];
                  $dashboard = $_POST['dashboard'];
                  $internal_decorations = $_POST['internal_decorations'];
                  $front_glass = $_POST['front_glass'];
                  $back_glass = $_POST['back_glass'];
                  $side_glass = $_POST['side_glass'];
                  $front_tires = $_POST['front_tires'];
                  $back_tires = $_POST['back_tires'];
                  $front_tires_no = $_POST['front_tires_no'];
                  $back_tires_no = $_POST['back_tires_no'];
                  $paints = $_POST['paints'];
                  $mirrors_1 = $_POST['mirrors_1'];
                  $mirrors_2 = $_POST['mirrors_2'];
                  $seats = $_POST['seats'];
                  $grille = $_POST['grille'];
                  $radio = $_POST['radio'];
                  $front_bumper = $_POST['front_bumper'];
                  $back_bumper = $_POST['back_bumper'];
                  $plates = $_POST['plates'];
                  $number_of_plates = $_POST['number_of_plates'];
                  $engine = $_POST['engine'];
                  $engine_exception = $_POST['engine_exception'];
                  $is_protected = $_POST['is_protected'];
                  $car_condition = $_POST['car_condition'];
                  $is_armed = $_POST['is_armed'];
                  $date = $_POST['date'];
                  $type = $_POST['type'];
                  $notes = $_POST['notes'];
                  
                  $sql = "CALL insertLiftingProcedures(? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                  $stmt->bindParam(2, $structure_top, PDO::PARAM_STR, 100);
                  $stmt->bindParam(3, $structure_fenders, PDO::PARAM_STR, 100);
                  $stmt->bindParam(4, $structure_engine_hood, PDO::PARAM_STR, 100);
                  $stmt->bindParam(5, $front_doors, PDO::PARAM_STR, 100);
                  $stmt->bindParam(6, $back_doors, PDO::PARAM_STR, 100);
                  $stmt->bindParam(7, $front_doors_no, PDO::PARAM_STR, 100);
                  $stmt->bindParam(8, $back_doors_no, PDO::PARAM_STR, 100);
                  $stmt->bindParam(9, $front_lights, PDO::PARAM_STR, 100);
                  $stmt->bindParam(10, $back_lights, PDO::PARAM_STR, 100);
                  $stmt->bindParam(11, $gear_box, PDO::PARAM_STR, 100);
                  $stmt->bindParam(12, $back_lights_no, PDO::PARAM_STR, 100);
                  $stmt->bindParam(13, $front_lights_no, PDO::PARAM_STR, 100);
                  $stmt->bindParam(14, $difference, PDO::PARAM_STR, 100);
                  $stmt->bindParam(15, $dashboard, PDO::PARAM_STR, 100);
                  $stmt->bindParam(16, $internal_decorations, PDO::PARAM_STR, 100);
                  $stmt->bindParam(17, $front_glass, PDO::PARAM_STR, 100);
                  $stmt->bindParam(18, $back_glass, PDO::PARAM_STR, 100);
                  $stmt->bindParam(19, $side_glass, PDO::PARAM_STR, 100);
                  $stmt->bindParam(20, $front_tires, PDO::PARAM_STR, 100);
                  $stmt->bindParam(21, $back_tires, PDO::PARAM_STR, 100);
                  $stmt->bindParam(22, $front_tires_no, PDO::PARAM_STR, 100);
                  $stmt->bindParam(23, $back_tires_no, PDO::PARAM_STR, 100);
                  $stmt->bindParam(24, $paints, PDO::PARAM_STR, 100);
                  $stmt->bindParam(25, $mirrors_1, PDO::PARAM_STR, 100);
                  $stmt->bindParam(26, $mirrors_2, PDO::PARAM_STR, 100);
                  $stmt->bindParam(27, $seats, PDO::PARAM_STR, 100);
                  $stmt->bindParam(28, $grille, PDO::PARAM_STR, 100);
                  $stmt->bindParam(29, $radio, PDO::PARAM_STR, 100);
                  $stmt->bindParam(30, $front_bumper, PDO::PARAM_STR, 100);
                  $stmt->bindParam(31, $back_bumper, PDO::PARAM_STR, 100);
                  $stmt->bindParam(32, $plates, PDO::PARAM_STR, 100);
                  $stmt->bindParam(33, $number_of_plates, PDO::PARAM_STR, 100);
                  $stmt->bindParam(34, $engine, PDO::PARAM_STR, 100);
                  $stmt->bindParam(35, $engine_exception, PDO::PARAM_STR, 100);
                  $stmt->bindParam(36, $is_protected, PDO::PARAM_STR, 100);
                  $stmt->bindParam(37, $car_condition, PDO::PARAM_STR, 100);
                  $stmt->bindParam(38, $is_armed, PDO::PARAM_STR, 100);
                  $stmt->bindParam(39, $date, PDO::PARAM_STR, 100);
                  $stmt->bindParam(40, $type, PDO::PARAM_STR, 100);
                  $stmt->bindParam(41, $notes, PDO::PARAM_STR, 250);
                  $stmt->execute();

                  // get last id inserted
                  $sql = "CALL getLiftingProcedureByReqID(?)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                  $stmt->execute();
                  $last_id = $stmt->fetch();
                  
                  $sql = "CALL insertLiftingProceduresIdInReq(? , ?)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(1, $last_id['id'], PDO::PARAM_INT);
                  $stmt->bindParam(2, $reqID, PDO::PARAM_INT);
                  $stmt->execute();
                  
                  $extensions = ['jpeg','jpg','gif','png','swf','tiff'];
                  
                  // Count # of uploaded files in array
                  $total = count($_FILES['upload']['name']);
                  // Loop through each file
                  for( $i=0 ; $i < $total ; $i++ ) {
                    $ext = pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);
                    if (in_array($ext, $extensions)) {
                      $dir ="../../images/";
                      //Get the temp file path
                      $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
      
                      //Make sure we have a file path
                      if ($tmpFilePath != ""){
                        //Setup our new file path
                        $newFilePath = $dir . $_FILES['upload']['name'][$i];
      
                        //Upload the file into the temp dir
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
      
                          $sql = "CALL insertLiftingImages(? , ?)";
                          $stmt = $conn->prepare($sql);
                          $stmt->bindParam(1, $newFilePath, PDO::PARAM_LOB);
                          $stmt->bindParam(2, $last_id['id'], PDO::PARAM_INT);
                          $stmt->execute();
      
                        }
                      }
                    }else{
                      echo "<script> alert('?????????? ?????? ??????????. ?????????????? ???????????????? ???? pdf ?? jpg ?? jpeg ?? gif ?? swf ?? tiff') </script>";
                    }
                  }

                  $messagepro = "???? ?????????? ???????? ?????? ?????????? ?????? ".$_GET['r'];
                // investigation not
                  $sql = "CALL insertInvestigationsNotifications(? , ?)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                  $stmt->bindParam(2, $messagepro, PDO::PARAM_STR, 100);
                  $stmt->execute();
              
                // Amana not
                  $sql = "CALL insertAmanaNotifications(? , ?)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                  $stmt->bindParam(2, $messagepro, PDO::PARAM_STR, 100);
                  $stmt->execute();

                // traffic not
                  $sql = "CALL insertTrafficNotifications(? , ?)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                  $stmt->bindParam(2, $messagepro, PDO::PARAM_STR, 100);
                  $stmt->execute();
                  echo("<script> alert('???? ?????????? ???????? ?????????? ??????????')</script>");
                  echo("<script> window.open('view_lifting_request.php?n=".$last_id['id']."&r=".$_GET['r']."' , '_self') </script>");

              } catch(PDOException $e){
                print "Error!: " . $e->getMessage() . "</br>";
              }
            }
          ?>
      </div>
      </form>
      
        <!-- Content Header (Page header) -->

        <?php require 'layoutjs.php'; ?>
  </body>

  </html>
  <?php
}  }else {
    header('location:../index.php');
} } else {
  header('location:http://alsaifit.com/');
}
?>
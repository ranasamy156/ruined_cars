<?php
include 'lang.php';
include '../../database.php';
if (isset($_SESSION["id"])) {
  if($_SESSION["type_id"] == "1") {
    $reqID = $_GET['r'];
    $liftID =  $_GET['n'];

    $sql = "CALL getLiftingProcedureByID(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $liftID, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();

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
      $row2 = $stmt->fetch();
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
                  text-align:<?php echo $expr['align'] ?>;
                font-size: medium;
                margin-top: 0px;
              background-color: white;
              
                  }
                  .fa-search{
                color:white;
              }
              .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
              height: 150px;
              padding: 5px;
              text-align: center;
          }
          /* Chrome, Safari, Edge, Opera */
          input::-webkit-outer-spin-button,
          input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
          }

          /* Firefox */
          input[type=number] {
            -moz-appearance: textfield;
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
                color: white;
                font-size: larger;

            }
            .progressbar li.active:before {
                border-color: #55b776;
                background-color: #55b776;
            } 
            .progressbar li.active + li:after {
                background-color: #55b776;
            }

            .progressbar li.refuse {
                color: white;
                font-size: large;
                content: '\2715';
            }
            .progressbar li.refuse:before {
                border-color: #D60015;
                background-color: #D60015;
                content: '\2715';
            } 
            .progressbar li.refuse + li:after {
                background-color: #D60015;
                content: '\2715';
            }
    </style>
    <script>
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".reason").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".reason").hide();
            }
        });
    }).change();
});
</script>
  </head>

  <body class="skin-blue sidebar-mini" class="bodycss"  style="font-family:'Amiri', serif;">
    <div class="wrapper" >
      <?php
        include_once 'header.php';
      ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php
        include_once 'aside.php';
      ?>
      <form autocomplete="off" method="post">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="font-size:large">
      <div class="row">
      <div class="col-lg-4">
          <h3 style="font-family:'Amiri', serif;text-align:center;">?????????????? ?????????????? ????????????????</br>?????????? ???????????? ?????????????? ?? ??????????????</br>?????????? ?????????? ?????????????? ??????????????</br>?????????? ??????????????????</br>?????????? ?????????????????? ??????????????????????</h3>
      </div>
      <div class="col-lg-4">
        <center><img src="../../images/logo.png" width="100%" height="100%"></center>  
      </div>
      <div class="col-lg-4">
        <h3 style="font-family:'Amiri', serif;text-align:center">?????????? ?????? ?????????? ??????????????</h3><h4 style="font-family:'Amiri', serif;text-align:center">?? ?????????????????? ?? ?????????? ?? ??????????</br>?? ?????????? ?????????????? ?? ????????????????</br>?????????????? ?????????????? ???????? ???????????? ?????? ????????????</br>???????? ???????????? - ?? 0148382405</br>?? 0148381459 - ???????? 0148391258</br>??.??: 1677 ?????????? 41441</h4>
      </div>
      </div>
        <div class="row">
          <div class="col-lg-12">
            <a target="_blank" href="print_lifting_procedure.php?n=<?php echo $_GET['n'] ?>&r=<?php echo $_GET['r'] ?>" class="btn btn-primary" style="float:left;">??????????</a>
            <h1 style="font-family:'Amiri'; text-align:center">???????? ?????? ?????????? ?????? <?php echo $_GET['r'] ?></h1>
          </div>
        </div></br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <th>?????????? ?????????? ?????? ??????????</th>
                    <th>??????????????</th>
                    <th>?????????? ??????????????</th>
                    <th>????????????</th>
                  </thead>
                  <tbody>
                  <!-- vendor -->
                    <?php if($row['vendor_status'] == 1){ ?>
                    <td class="progressbar"><li class="active"></li></td>
                    <?php }elseif($row['vendor_status'] == 2){ ?>
                    <td class="progressbar"><li class="refuse"></li></td>
                    <?php }else{ ?>
                    <td class="progressbar"><li></li></td>
                    <?php } ?>
                  <!-- amana -->
                    <?php if($row['amana_status'] == 1){ ?>
                    <td class="progressbar"><li class="active"></li></td>
                    <?php }elseif($row['amana_status'] == 2){ ?>
                      <td class="progressbar"><li class="refuse"></li></td>
                    <?php }else{ ?>
                      <td class="progressbar"><li></li></td>
                    <?php } ?>
                  <!-- criminal -->
                    <?php if($row['inv_status'] == 1){ ?>
                    <td class="progressbar"><li class="active"></li></td>
                    <?php }elseif($row['inv_status'] == 2){ ?>
                    <td class="progressbar"><li class="refuse"></li></td>
                    <?php }else{ ?>
                    <td class="progressbar"><li></li></td>
                    <?php } ?>
                  <!-- traffic -->
                    <?php if($row['traffic_status'] == 1){ ?>
                    <td class="progressbar"><li class="active"></li></td>
                    <?php }elseif($row['traffic_status'] == 2){ ?>
                    <td class="progressbar"><li class="refuse"></li></td>
                    <?php }else{ ?>
                    <td class="progressbar"><li></li></td>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          </br>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-3">
            <label for="date">??????????????: </label>
            <?php echo $row['created_at'] ?>
          </div>
          <div class="col-sm-4">
            <label for="date">?????? ??????: </label>
            <?php echo $row['type'] ?>
          </div>
          <div class="col-sm-3">
            <label for="date">???? ???????? ??????????: </label>
            <?php echo $row2['baladya'] ?>
          </div>
          <div class="col-sm-1"></div>
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
                      echo '<td>'.$row2['man_arname'].' </td>';
                    }else{
                      echo '<td>'.$row2['man_arname'].' - '.$row2['model_arname'].' </td>';
                    }
                  ?>
                  <td><?php echo $row2['plate_number'] ?></td>
                  <td><?php echo $row2['chassis'] ?></td>
                  <td><div style=<?php echo "'width: 50px; height: 20px; background-color:#".$row2['color'].";text-align:".$expr['align']. "margin-right:45%;'";?>></div></td>
                  <td><?php echo $row2['st_name'] ?> - <?php echo $row2['ct_name'] ?> - <?php echo $row2['baladya'] ?> - <?php echo $row2['ar_name'] ?></td>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div></br>

        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">????????????</th>
                    <th>??????????</td>
                    <th> ?????????????? </td>
                    <th> ???????????? </td>
                  </tr>
                  <tr>
                    <td><?php echo $row['structure_top'] ?></td>
                    <td><?php echo $row['structure_fenders'] ?></td>
                    <td><?php echo $row['structure_engine_hood'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">????????????</th>
                    <th>??????????????</td>
                    <th> ???????????? </td>
                    <th> ?????????????? </td>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_glass'] ?></td>
                    <td><?php echo $row['back_glass'] ?></td>
                    <td><?php echo $row['side_glass'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">??????????????</th>
                    <th>????????????????</td>
                    <th>??????????????</td>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_doors'] ?> <?php if($row['front_doors'] == "????????"){ echo "??????????: ".$row['front_doors_no']; } ?></td>
                    <td><?php echo $row['back_doors'] ?> <?php if($row['back_doors'] == "????????"){ echo "??????????: ".$row['back_doors_no']; } ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">????????????????</th>
                    <th>????????????????</td>
                    <th> ?????????????? </td>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_tires'] ?> <?php if($row['front_tires'] == "????????"){ echo "??????????: ".$row['front_tires_no']; } ?></td>
                    <td><?php echo $row['back_tires'] ?> <?php if($row['back_tires'] == "????????"){ echo "??????????: ".$row['back_tires_no']; } ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th rowspan="4">??????????????</th>
                    <th>????????????????</td>
                    <th> ?????????????? </td>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_lights'] ?> <?php if($row['front_lights'] == "????????"){ echo "??????????: ".$row['front_lights_no']; } ?></td>
                    <td><?php echo $row['back_lights'] ?> <?php if($row['back_lights'] == "????????"){ echo "??????????: ".$row['back_lights_no']; } ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>????????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['paints'] ?></td>
                  </tr>               
                </table>
              </div>
            </div>
            <div class="col-lg-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????? 1</th>
                    <th>?????????????? 2</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['mirrors_1'] ?></td>
                    <td><?php echo $row['mirrors_2'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['seats'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['gear_box'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['difference'] ?></td>
                  </tr>                
                </table>
              </div>
            </div>
            <div class="col-lg-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????? ??????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['grille'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>???????????? ??????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['front_bumper'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['dashboard'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????????? ????????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['internal_decorations'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-2 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????? ?? ????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['radio'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>???????????? ????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['back_bumper'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????</th>
                  </tr>
                  <?php if($row['plates'] === "????????"){ ?>
                  <tr>
                    <td><?php echo $row['plates'] ?></td>
                    <td>??????????: <?php echo $row['number_of_plates'] ?></td>
                  </tr>
                  <?php }else{ ?>
                    <td><?php echo $row['plates'] ?></td>
                  <?php } ?>
                </table>
              </div>
            </div>
            <div class="col-lg-6 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>????????????</th>
                  </tr>
                  <?php if($row['engine'] === "???? ????????"){ ?>
                  <tr>
                    <td><?php echo $row['engine'] ?></td>
                  </tr>
                  <?php }else{ ?>
                    <td><?php echo $row['engine'] ?></td>
                    <td>???? ??????: <?php echo $row['engine_exception'] ?></td>
                  <?php } ?>
                </table>
              </div>
            </div>
            <div class="col-lg-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-lg-1"></div>
            <?php if($row['car_condition'] != ""){ ?>
            <div class="col-lg-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>???????? ??????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['car_condition'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <?php } ?>
            <?php if($row['is_armed'] != ""){ ?>
            <div class="col-lg-3 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????? ??????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['is_armed'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <?php } ?>
            <div class="col-sm-4 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>?????????????? ??????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['is_protected'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-5 m-auto">
              <div class="table-responsive">
                <table class="table adminpanel">
                  <tr>
                    <th>??????????????????</th>
                  </tr>
                  <tr>
                    <td><?php echo $row['notes'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <?php 
            if($row['vendor_status'] == 0){ 
              if($row['traffic_status'] == 2 || $row['inv_status'] == 2 || $row['amana_status'] == 2){
            ?>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-1">
            </div>
            <?php }else{ ?>
            <div class="col-sm-2">
                <select name="procedures" class="form-control">
                    <option selected disabled>???????? ????????????</option>
                    <option value="1">???????? ????????????</option>
                    <option value="2">?????? ????????????</option>
                </select>
            </div>
            <div class="col-sm-2 2 reason">
              <textarea class="form-control" name="reason" id="reason" cols="30" rows="10" placeholder="?????? ??????????"></textarea>
            </div>
            <div class="col-sm-1">
                  <button class="btn btn-primary" name="sendpro"><?php echo $expr['save'] ?></button>
            </div>
            <?php } }else{ ?>
            <div class="col-sm-2"></div>
            <div class="col-sm-1"></div>
            <?php } ?>
            <div class="col-sm-1"></div>
          </div>
            <?php
              if(isset($_POST['sendpro'])){
                $liftID = $_GET['n'];
                $reqID = $_GET['r'];
                $messagepro = "???? ?????????? ???????? ???????? ?????????? ?????????? ?????? ".$_GET['r']." ???? ?????? ?????????? ?????????? ?????? ??????????";


                  if($_POST['procedures'] == 1){
                    $sql = "CALL changeVendorStatus1(?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $liftID, PDO::PARAM_INT);
                    $stmt->execute();

                    if($row['traffic_status'] == 1 && $row['inv_status'] == 1 && $row['vendor_status'] == 1){
                      $sql = "CALL changeVendorStatus2(?)";
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                      $stmt->execute();
                      
                    }else{
                      $sql = "CALL changeVendorStatus3(?)";
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                      $stmt->execute();
                      
                    }
                  }elseif($_POST['procedures'] == 2){
                      $reason = $_POST['reason'];
                      $sql = "CALL changeVendorStatus4(? , ?)";
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(1, $reason, PDO::PARAM_STR, 100);
                      $stmt->bindParam(2, $reqID, PDO::PARAM_INT);
                      $stmt->execute();

                      $sql = "CALL changeVendorStatus5(?)";
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(1, $liftID, PDO::PARAM_INT);
                      $stmt->execute();
                  }
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

                echo "<meta http-equiv='refresh' content='0.1'>";	                  
              }
            ?>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
            <label>?????????? ???????? ??????????</label></br>

              <!-- Full-width images with number and caption text -->
              <?php
                $sql = "CALL getReqImages(?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
                $stmt->execute();
                // $rowph = $stmt->fetchAll();
                $count = $stmt->rowCount();

                
                  foreach ($stmt as $rowphoto) {

              ?>
            <div class="img-thumbnail" title="<?php echo $expr['photoinstruction'] ?>">
                <img src="<?php echo $rowphoto['path']; ?>" alt="Lights" class="img-rounded"  data-toggle="modal" data-target="#largeImggPanel<?php echo $rowphoto['id'] ?>" width="100" height="100">
            </div>
              <!-- Modal -->
              <div class="modal" id="largeImggPanel<?php echo $rowphoto['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <img src="<?php echo $rowphoto['path'] ?>" style="height:100%;width:100%;">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end of modal -->
              <?php
                }
              
              ?>
              
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
            <label>?????????? ???????? ??????????</label></br>

              <!-- Full-width images with number and caption text -->
              <?php

                $sql = "CALL getLiftingProcedureImages(?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $liftID, PDO::PARAM_INT);
                $stmt->execute();
                foreach ($stmt as $rowphoto) {

              ?>
            <div class="img-thumbnail" title="<?php echo $expr['photoinstruction'] ?>">
                <img src="<?php echo $rowphoto['location']; ?>" alt="Lights" class="img-rounded"  data-toggle="modal" data-target="#largeImgPanel<?php echo $rowphoto['id'] ?>" width="100" height="100">
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
                      <img src="<?php echo $rowphoto['location'] ?>" style="height:100%;width:100%;">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end of modal -->
              <?php
                }
              
              ?>
              
            </div>
            <div class="col-sm-1"></div>
          </div>
          </br>
          <div class="row">
              <div class="col-xs-1"></div>
              <div class="col-xs-10">
                <h4>(1) ???????????? ???????????? ???????????? : ?????? ?????????? ?????????????? ??????????.</h4>
              </div>
              <div class="col-xs-1"></div>
          </div>
          <div class="row">
              <div class="col-lg-1"></div>
              <div class="col-lg-10">
                <h4>(2) ??????????????: ???????? ?????? ???????????? ???????????? ?? ???? ???? ?????????????? ?????? ?????????????? ???????????? ???????????????? ???????????? ?????????? ?? ???? ???? ?????????? ?????????????? ???????????? ?????????? ???????????? ???? ???????? ?? ???? ?????????? ???????? ???? ?????????????? ?????????????? ???????????? ?????????? ?????????? ??????????????. ?? ?????????? ?????? ???? ?????? ?????? ?????????? ????????????. ?? ?????????? ??????????????.</h4>
              </div>
              <div class="col-lg-1"></div>
          </div>
      </div>
      </form>
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
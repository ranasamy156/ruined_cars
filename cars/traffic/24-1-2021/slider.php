<div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <th>امانة</th>
                    <th>مرور</th>
                    <th>البحث الجنائي</th>
                    <th>مندوب مؤسسة عين العرب</th>
                  </thead>
                  <tbody>
                  <!-- amana -->
                    <?php if($row['amana_status'] == 1){ ?>
                    <td class="progressbar"><li class="active"></li></td>
                    <?php }elseif($row['amana_status'] == 2){ ?>
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
                  <!-- criminal -->
                    <?php if($row['inv_status'] == 1){ ?>
                    <td class="progressbar"><li class="active"></li></td>
                    <?php }elseif($row['inv_status'] == 2){ ?>
                    <td class="progressbar"><li class="refuse"></li></td>
                    <?php }else{ ?>
                    <td class="progressbar"><li></li></td>
                    <?php } ?>
                  <!-- vendor -->
                    <?php if($row['vendor_status'] == 1){ ?>
                    <td class="progressbar"><li class="active"></li></td>
                    <?php }elseif($row['vendor_status'] == 2){ ?>
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
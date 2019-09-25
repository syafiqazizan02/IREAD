<?php
    include 'dbSetting.php';
      settingData();
    if(isset($_GET['book_limit']))
        updateBookLimit();
    if(isset($_GET['borrow_day']))
       updateBorrowDay();
    if(isset($_GET['penalty_rate']))
       updatePenaltyRate();
    if(isset($_GET['borrow_day_teacher']))
        updateTeacherBorrowDay();
    if(isset($_GET['borrow_day_student']))
        updateStudentBorrowDay();
    if(isset($_GET['penalty_rate_student']))
        updateStudentPenaltyRate();
    if(isset($_GET['penalty_rate_teacher']))
        updateTeacherPenaltyRate();
?>
<!doctype html>
    <?php include 'title.php'; ?>
<body>
    <?php include 'left-panel.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php include 'header2.php'; ?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Setting</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Setting</a></li>
                            <li class="active">Setup Position</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <small>Setup Position</small>
                        </div>
                        <div class="card-body">

                          <?php
                              while($row = $result->fetch_assoc()){
                              echo '<div>
                              <strong class="card-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['type_name'].':</strong>
                              </div><br>

                          <div class="col col-sm-4">
                              <div class="card">
                                  <div class="card-header">
                                      <strong class="card-title">Book Limit '.$row['type_name'].'</strong>
                                  </div>
                                  <div class="card-body card-block">
                                          <form action="" method="get" class="form-horizontal">
                                              <div class="row form-group">
                                                  <div class="col col-md-5">
                                                      <input type="number" name="book_limit" id="book_limit" value="'. $row['book_limit'] .'" required="" class="form-control">
                                                  </div>
                                                  <div class="col col-md-3">
                                                      <label for="exampleInputName2" class="pr-1  form-control-label">Books</label>
                                                  </div>
                                                  <div class="col-12">
                                                      <div class="form-group"><label for="submit" class="px-1  form-control-label"></label>
                                                      <input type="hidden" name="submit" value="'.$row['type_name'].'" />
                                                      <button  type="submit" name="sub" id="submit" class="form-control btn-secondary"><i class="fa fa-refresh"></i>&nbsp;Update</button></div>
                                                  </div>
                                              </div>
                                          </form>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              <div class="card">
                                  <div class="card-header">
                                      <strong class="card-title">Penalty Rate '.$row['type_name'].'</strong>
                                  </div>
                                  <div class="card-body card-block">
                                          <form action="" method="get" class="form-horizontal">
                                          <div class="row form-group">
                                              <div class="col col-md-2">
                                                  <label for="exampleInputName2" class="pr-1  form-control-label">RM:</label>
                                              </div>
                                              <div class="col col-md-5">
                                                  <input step="0.01" type="number" name="penalty_rate" id="" value="'.$row["penalty_rate"].'" required="" class="form-control">
                                              </div>
                                              <div class="col-12">
                                                  <div class="form-group"><label for="submit" class="px-1  form-control-label"></label>
                                                  <input type="hidden" name="submit" value="'.$row['type_name'].'" />
                                                  <button  type="submit" name="sub" id="submit" class="form-control btn-secondary"><i class="fa fa-refresh"></i>&nbsp;Update</button></div>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              <div class="card">
                                  <div class="card-header">
                                      <strong class="card-title">Borrow Day '.$row['type_name'].'</strong>
                                  </div>
                                  <div class="card-body card-block">
                                          <form action="" method="get" class="form-horizontal">
                                              <div class="row form-group">
                                                  <div class="col col-md-5">
                                                      <input type="number" name="borrow_day" id="" value="'.$row['borrow_day'].'" required="" class="form-control">
                                                  </div>
                                                  <div class="col col-md-3">
                                                      <label for="exampleInputName2" class="pr-1  form-control-label">Days</label>
                                                  </div>
                                                  <div class="col-12">
                                                      <div class="form-group"><label for="submit" class="px-1  form-control-label"></label>
                                                      <input type="hidden" name="submit" value="'.$row['type_name'].'" />
                                                      <button  type="submit" name="sub" id="submit" class="form-control btn-secondary"><i class="fa fa-refresh"></i>&nbsp;Update</button></div>
                                                  </div>
                                              </div>
                                          </form>
                                  </div>
                              </div>
                          </div>';
                              }
                              ?>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

    <?php include 'script.php'; ?>
    <script>
    function setTwoNumberDecimal(event) {
    this.value = parseFloat(this.value).toFixed(2);
}   </script>
</body>

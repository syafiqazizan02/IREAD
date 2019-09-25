<!doctype html>
<?php include 'title.php'; ?>
<?php include 'function.php'; ?>
<body>
  <?php include 'left-panel.php'; ?>
  <div id="right-panel" class="right-panel">
    <?php include 'header2.php'; ?>

    <div class="breadcrumbs">
      <div class="col-sm-4">
        <div class="page-header float-left">
          <div class="page-title">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="content mt-3">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <small>Dashboard</small>
              </div>
              <div class="card-body">

                <div class="col-sm-6 col-lg-4">
                  <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                      <div class="dropdown float-right">
                        <i class="fa fa-cog"></i>
                      </div>
                      <h2 class="mb-0">
                        <span><?php echo borrow(); ?></span>
                      </h2>
                      <p class="text-light">Book Borrowed</p>
                      <div class="chart-wrapper px-0" style="height:90px;" height="70">
                        <i class="fa fa-share-square fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="manage_issue_list_view.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">More info&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                  <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                      <div class="dropdown float-right">
                        <i class="fa fa-cog"></i>
                      </div>
                      <h2 class="mb-0">
                        <span><?php echo overdue(); ?></span>
                      </h2>
                      <p class="text-light">Book Overdue</p>
                      <div class="chart-wrapper px-0" style="height:90px;" height="70">
                        <i class="fa fa-warning fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="manage_issue_list_view.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">More info&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                  <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                      <div class="dropdown float-right">
                        <i class="fa fa-cog"></i>
                      </div>
                      <h2 class="mb-0">
                        <span><?php echo damage(); ?></span>
                      </h2>
                      <p class="text-light">Book Damaged</p>
                      <div class="chart-wrapper px-0" style="height:90px;" height="70">
                        <i class="fa fa-ban fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="manage_book_damage_list.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">More info&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-sm-6 col-lg-4">
                  <div class="card text-white bg-flat-color-5">
                    <div class="card-body pb-0">
                      <div class="dropdown float-right">
                        <i class="fa fa-cog"></i>
                      </div>
                      <h2 class="mb-0">
                        <span><?php echo member(); ?></span>
                      </h2>
                      <p class="text-light">Member Registered</p>
                      <div class="chart-wrapper px-0" style="height:90px;" height="70">
                        <i class="fa fa-user fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="reportTotalMemberRegister.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">View Report&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                  <div class="card text-white bg-flat-color-6">
                    <div class="card-body pb-0">
                      <div class="dropdown float-right">
                        <i class="fa fa-cog"></i>
                      </div>
                      <h2 class="mb-0">
                        <span><?php echo nilam(); ?></span>
                      </h2>
                      <p class="text-light">Nilam Reviewed</p>
                      <div class="chart-wrapper px-0" style="height:90px;" height="70">
                        <i class="fa fa-book fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="reportTotalNilam.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">View Report&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                  <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                      <div class="dropdown float-right">
                        <i class="fa fa-cog"></i>
                      </div>
                      <h2 class="mb-0">
                        <span><?php echo penalty(); ?></span>
                      </h2>
                      <p class="text-light">Penalty Charged</p>
                      <div class="chart-wrapper px-0" style="height:90px;" height="70">
                        <i class="fa fa-dollar fa-4x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="reportTotalPenaltyCharged.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">View Report&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->

  <div class="content mt-3">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <small>Admin Remainder :</small>
            </div>
            <div class="card-body">

              <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-1">
                  <div class="card-body pb-0">
                    <div class="dropdown float-right">
                      <i class="fa fa-cog"></i>
                    </div>
                    <h2 class="mb-0">
                      <span><?php echo borrow(); ?></span>
                    </h2>
                    <p class="text-light">Book Pending</p>
                    <div class="chart-wrapper px-0" style="height:90px;" height="70">
                      <i class="fa fa-share-square fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="manage_issue_list_view.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">More info&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-3">
                  <div class="card-body pb-0">
                    <div class="dropdown float-right">
                      <i class="fa fa-cog"></i>
                    </div>
                    <h2 class="mb-0">
                      <span><?php echo overdue(); ?></span>
                    </h2>
                    <p class="text-light">Book Overdue</p>
                    <div class="chart-wrapper px-0" style="height:90px;" height="70">
                      <i class="fa fa-warning fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="manage_issue_list_view.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">More info&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-4">
                  <div class="card-body pb-0">
                    <div class="dropdown float-right">
                      <i class="fa fa-cog"></i>
                    </div>
                    <h2 class="mb-0">
                      <span><?php echo damage(); ?></span>
                    </h2>
                    <p class="text-light">Book Damaged</p>
                    <div class="chart-wrapper px-0" style="height:90px;" height="70">
                      <i class="fa fa-ban fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="manage_book_damage_list.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">More info&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
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
              <small>Years Report :</small>
            </div>
            <div class="card-body">

              <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-5">
                  <div class="card-body pb-0">
                    <div class="dropdown float-right">
                      <i class="fa fa-cog"></i>
                    </div>
                    <h2 class="mb-0">
                      <span><?php echo member(); ?></span>
                    </h2>
                    <p class="text-light">Member Registered</p>
                    <div class="chart-wrapper px-0" style="height:90px;" height="70">
                      <i class="fa fa-user fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="reportTotalMemberRegister.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">View Report&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-6">
                  <div class="card-body pb-0">
                    <div class="dropdown float-right">
                      <i class="fa fa-cog"></i>
                    </div>
                    <h2 class="mb-0">
                      <span><?php echo nilam(); ?></span>
                    </h2>
                    <p class="text-light">Nilam Reviewed</p>
                    <div class="chart-wrapper px-0" style="height:90px;" height="70">
                      <i class="fa fa-book fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="reportTotalNilam.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">View Report&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-2">
                  <div class="card-body pb-0">
                    <div class="dropdown float-right">
                      <i class="fa fa-cog"></i>
                    </div>
                    <h2 class="mb-0">
                      <span><?php echo penalty(); ?></span>
                    </h2>
                    <p class="text-light">Penalty Charged</p>
                    <div class="chart-wrapper px-0" style="height:90px;" height="70">
                      <i class="fa fa-dollar fa-4x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="reportTotalPenaltyCharged.php?id=<?php echo $id; ?>" style="color:white;" class="small-box-footer">View Report&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <?php include 'script.php'; ?>

  </body>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('navbar.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <small>Dashboard</small>
                            </div>
                            <div class="card-body">
                              <?php $id = $_SESSION['id']; ?>
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

<?php include('footer.php'); ?>

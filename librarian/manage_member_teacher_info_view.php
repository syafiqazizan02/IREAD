<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('navbar.php'); ?>
<?php include('db_conn.php'); ?>
<?php include('function3.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Member</h1> <?php $member_id = $_GET["tech_id"];?>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Member</a></li>
                            <li class="active">Member Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-lg-6">
                    </div>
                    <?php

                        $stmt8 = $conn->prepare("SELECT member_fullname, k.type_name as type_name
                                                 FROM member AS e
                                                 JOIN type AS k ON e.type_id = k.type_id
                                                 AND e.member_id=?");

                        $stmt8->bind_param("s", $member_id);
                        $stmt8->execute();
                        $result8 = $stmt8->get_result();
                        $row8 = $result8->fetch_assoc();
                          $member_fullname = $row8 ['member_fullname'];
                          $type_name = $row8 ['type_name'];

                     ?>
                    <div class="col-lg-6">
                          <aside class="profile-nav alt">
                              <section class="card">
                                  <div class="card-header user-header alt bg-dark">
                                      <div class="media">
                                          <a href="#">
                                              <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                                          </a>
                                          <div class="media-body">
                                              <h2 class="text-light display-6"><?php echo $member_fullname; ?></h2>
                                              <p><?php echo $type_name; ?></p>
                                          </div>
                                      </div>
                                  </div>

                                  <ul class="list-group list-group-flush">
                                      <li class="list-group-item">
                                          <i class="fa fa-bell-o"></i> Pending Book <span class="badge badge-danger pull-right"><?php echo pendingbBook(); ?></span>
                                      </li>
                                      <li class="list-group-item">
                                          <i class="fa fa-comments-o"></i> 0utstanding Penalty <span class="badge badge-info pull-right"><?php echo totalPenalty(); ?></span>
                                      </li>
                                      <li class="list-group-item">
                                          <i class="fa fa-tasks"></i> Recent Book <span class="badge badge-success pull-right"><?php echo recentBook(); ?></span>
                                      </li>
                                  </ul>

                              </section>
                          </aside>
                      </div>

                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header">
                                  <small>Member Details</small>
                              </div>
                              <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                  <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Current Borrow</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">History Borrow</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Nilam Review</a>
                                  </li>
                              </ul>
                              <div class="tab-content pl-3 p-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br>
                                  <?php include ('manage_member_teacher_borrow_view.php'); ?>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>
                                  <?php include ('manage_member_teacher_return_view.php'); ?>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><br>
                                  <?php include ('manage_member_teacher_nilam_view.php'); ?>
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

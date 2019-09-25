<!doctype html>
<?php include 'title.php'; ?>

<body>
<?php include 'left-panel.php'; ?>
<?php include('navbar.php'); ?>
<?php include('db_conn.php'); ?>

<?php

    $member_id = $_GET["member_id"];

    $stmt4 = $conn->prepare("SELECT e.member_id as member_id,  e.member_ic as member_ic, e.member_fullname as member_fullname, e.member_email as member_email, e.member_contact as member_contact, e.member_address as member_address, e.member_contact as member_contact, e.member_register as member_register, f.type_name as type_name
                             FROM member AS e
                             JOIN type AS f ON e.type_id=f.type_id
                             AND e.member_id=?");

    $stmt4->bind_param("s", $member_id);
    $stmt4->execute();
    $result4 = $stmt4->get_result();
    $row4 = $result4->fetch_assoc();
      $member_id = $row4 ['member_id'];
      $member_ic = $row4 ['member_ic'];
      $member_fullname = $row4 ['member_fullname'];
      $member_email = $row4 ['member_email'];
      $member_contact = $row4 ['member_contact'];
      $member_register = $row4 ['member_register'];
      $member_position = $row4 ['type_name'];

?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Member</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Member</a></li>
                            <li class="active">Member Fingerprint</li>
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
                        <small>Member Fingerprint</small>
                      </div>
                      <div class="card-body card-block">
                          <div class="col-lg-2">
                          </div>
                            <div class="col-lg-8">
                                  <aside class="profile-nav alt">
                                      <section class="card">
                                          <div class="card-header user-header alt bg-dark">
                                              <div class="media">
                                                  <a href="#">
                                                      <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                                                  </a>
                                                  <div class="media-body">
                                                      <h2 class="text-light display-6"><?php echo $member_fullname; ?></h2>
                                                      <p><?php echo $member_position; ?></p>
                                                  </div>
                                              </div>
                                          </div>
                                          <ul class="list-group list-group-flush">
                                              <li class="list-group-item">
                                                  <i class="fa fa-calendar"></i>&nbsp;Register Date <span class="badge badge-secondary  pull-right" style="font-size:15px;"><?php  echo date_format(date_create($member_register), 'd F y'); ?></span>
                                              </li>
                                              <li class="list-group-item">
                                                  <i class="fa  fa-user"></i>&nbsp;Member ID <span class="badge badge-danger pull-right" style="font-size:15px;"><?php echo $member_ic; ?></span>
                                              </li>
                                              <li class="list-group-item">
                                                  <i class="fa fa-phone-square"></i>&nbsp;Member Contact <span class="badge badge-success pull-right" style="font-size:15px;">+6<?php echo $member_contact; ?></span>
                                              </li>
                                              <li class="list-group-item">
                                                  <i class="fa fa-inbox"></i>&nbsp;Member Email <span class="badge badge-info pull-right" style="font-size:15px;"><?php echo $member_email; ?></span>
                                              </li>
                                          </ul>
                                      </section>
                                  </aside>
                              </div>
                            <div class="col-lg-2">
                            </div>
                          <input type="hidden" id="MemberID" value="<?php echo $member_id; ?>">
                      </div>
                      <div class="card-footer">
                          <?php $libraian_id = $_GET["id"]; $member_id = $_GET["member_id"];?>
                          <a  href="manage_member_register_socket_button.php?id=<?php echo $libraian_id?>&member_id=<?php echo $member_id?>" onclick="return confirm('Scaning Fingerprint?');"><button style="color:#ffffff;" class="btn btn-warning btn-sm" id="btn_register"><i class='fa fa-arrow-circle-o-right'></i>&nbsp;&nbsp;Register</button></a>
                      </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>

   </div>

<?php include('footer.php'); ?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('navbar.php'); ?>

<?php

	include "db_conn.php";

	$id = @$_REQUEST['id'];

?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Acoount</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Account</a></li>
                            <li class="active">New Password</li>
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
                        <small>New Password</small>
                      </div>
                      <form action="manage_account_password_update.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                      <div class="card-body card-block">
                          <div class="row form-group">
                              <div class="col col-md-3"><label for="text-input" class=" form-control-label">New Password</label></div>
                              <div class="col-12 col-md-9"><input type="password" name="new_password" placeholder="Enter New Password" class="form-control" pattern=".{6,}" title="Six or more characters" required></div>
                          </div>
                          <div class="row form-group">
                              <div class="col col-md-3"><label for="text-input" class=" form-control-label">Confirm Password</label></div>
                              <div class="col-12 col-md-9"><input type="password" name="confirm_password" placeholder="Enter Confirm Password" class="form-control" pattern=".{6,}" title="Six or more characters" required></div>
                          </div>
                          <div class="row form-group">
                            <input type="hidden" name="librarian_id" value="<?php echo $id; ?>">
                          </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" name="recovery" class="btn btn-success btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Update
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                           <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
                      <form>
                      </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>

   </div>

<?php include('footer.php'); ?>

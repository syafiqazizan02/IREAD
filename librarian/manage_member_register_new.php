<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('navbar.php'); ?>
<?php include('db_conn.php'); ?>

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
                            <li class="active">New Member</li>
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
                        <small>New Member</small>
                      </div>
                      <div class="card-body card-block">
                        <form action="manage_member_register_add.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="col-lg-6">
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="text-input" class=" form-control-label">Member ID :</label></div>
                              <div class="col-12 col-md-8"><input type="text" id="member_ic" name="member_ic" placeholder="Enter ID" class="form-control" size="12" pattern=".{12}" title="Must 12 number of IC format! e.g 101010201010" autofocus required></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="text-input" class=" form-control-label">Member Name :</label></div>
                              <div class="col-12 col-md-8"><input type="text" name="member_fullname" placeholder="Enter Name" class="form-control" required></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="select" class=" form-control-label">Member Gender :</label></div>
                              <div class="col-12 col-md-8">
                                <select name="member_gender" class="form-control" required>
                                  <option value="">Select Gender</option>
                                  <?php

                                      $query = $conn->query("SELECT * FROM gender");

                                      $rowCount = $query->num_rows;

                                        if($rowCount > 0)
                                        {
                                          while($row = $query->fetch_assoc())
                                          {
                                            echo '<option value="'.$row['gender_id'].'">'.$row['gender_name'].'</option>';
                                          }
                                        }
                                        else
                                        {
                                          echo '<option value="">Gender Not Available</option>';
                                        }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="select" class=" form-control-label">Member Position :</label></div>
                              <div class="col-12 col-md-8">
                                <select name="member_position" class="form-control" required>
                                  <option value="">Select Position</option>
                                  <?php

                                      $query = $conn->query("SELECT * FROM type");

                                      $rowCount = $query->num_rows;

                                        if($rowCount > 0)
                                        {
                                          while($row = $query->fetch_assoc())
                                          {
                                            echo '<option value="'.$row['type_id'].'">'.$row['type_name'].'</option>';
                                          }
                                        }
                                        else
                                        {
                                          echo '<option value="">Position Not Available</option>';
                                        }
                                  ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="text-input" class=" form-control-label">Member Email :</label></div>
                              <div class="col-12 col-md-8"><input type="text" name="member_email" placeholder="Enter Email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Must in email format! e.g user@gmail.com" required></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="text-input" class=" form-control-label">Member Contact :</label></div>
                              <div class="col-12 col-md-8"><input type="text" name="member_contact" placeholder="Enter Contact" class="form-control" size="11" pattern=".{10,11}" title="Must in 10 or 11 phone number format! e.g 0001112222" required></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="textarea-input" class=" form-control-label">Member Address :</label></div>
                              <div class="col-12 col-md-8"><textarea name="member_address" rows="3" placeholder="Enter Address" class="form-control" required></textarea></div>
                            </div>
                            <div class="row form-group">
                              <input type="hidden" name="librarian_id" value="<?php echo $id; ?>">
                            </div>
                          </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-success btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" name="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
                    </form>
                    </div>
                  </div>

                </div>
            </div>
        </div>

   </div>

<?php include('footer.php'); ?>

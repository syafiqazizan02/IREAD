<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('navbar.php'); ?>

<?php

	include "db_conn.php";

	$id = @$_REQUEST['id'];

	$stmt = $conn->prepare("SELECT * FROM librarian WHERE librarian_id=?");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

		$librarian_fullname = $row ['librarian_fullname'];
		$librarian_email = $row ['librarian_email'];
		$librarian_contact = $row ['librarian_contact'];
		$librarian_address= $row ['librarian_address'];
		$librarian_favQues = $row ['librarian_favQues'];
		$librarian_favAnsw= $row ['librarian_favAnsw'];


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
                            <li><a href="#">Manage Acoout</a></li>
                            <li class="active">Update Profile</li>
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
                        <small>Update Profile</small>
                      </div>
                      <form action="manage_account_profile_update.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                      <div class="card-body card-block">
                          <div class="row form-group">
                              <div class="col col-md-3"><label for="text-input" class=" form-control-label">Librarian Name :</label></div>
                              <div class="col-12 col-md-9"><input type="text" name="librarian_fullname" value="<?php echo $librarian_fullname; ?>" class="form-control" required></div>
                          </div>
                          <div class="row form-group">
                              <div class="col col-md-3"><label for="text-input" class=" form-control-label">Librarian Email :</label></div>
                              <div class="col-12 col-md-9"><input type="text" name="librarian_email" value="<?php echo $librarian_email; ?>" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></div>
                          </div>
                          <div class="row form-group">
                             <div class="col col-md-3"><label for="text-input" class=" form-control-label">Librarian Contact :</label></div>
                             <div class="col-12 col-md-9"><input type="text" name="librarian_contact" value="<?php echo $librarian_contact; ?>" class="form-control" size="11" pattern=".{10,11}" required></div>
                          </div>
													<div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Librarian Address :</label></div>
                            <div class="col-12 col-md-9"><textarea name="librarian_address" rows="3" class="form-control" required><?php echo $librarian_address; ?></textarea></div>
                          </div><br><br>
													<div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class="form-control-label">Favorite Question :</label></div>
                            <div class="col-12 col-md-9">
															<select class="form-control" name="librarian_favQues" required>
								                <option><?php echo $librarian_favQues; ?></option>
                                <option value="What is your Mother Name?">What is your Mother Name?</option>
                                <option value="What is your Favourite Movie?">What is your Favourite Movie?</option>
                                <option value="What is your Pet Name?">What is your Pet Name?</option>
								                <option value="What is your Favourite Colour?">What is your Favourite Colour?</option>
							               </select>
													 </div>
                          </div>
													<div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Favorite Answer :</label></div>
                            <div class="col-12 col-md-9"><input type="text" name="librarian_favAnsw" value="<?php echo $librarian_favAnsw; ?>" class="form-control" required></div>
                          </div>
                          <div class="row form-group">
                            <input type="hidden" name="librarian_id" value="<?php echo $id; ?>">
                          </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-success btn-sm">
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

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('navbar.php'); ?>

<?php if(isset($_GET['member_id']) && $_GET['member_id']=="error"){
  echo "<script>alert('Failed Validate Member!');</script>";
}?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Issue</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Issue</a></li>
                            <li class="active">Borrow Book</li>
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
            								<small>Borrow Book</small>
            							</div>
            							<div class="card-body">
            								<div class="col-md-3">
                              <input type="hidden" id="member_id" value="<?php if(isset($_GET['member_id']) && $_GET['member_id']=="error"){
                              }else{echo $_GET['member_id'];  }?>">
            									<label for="text-input" class=" form-control-label">Member ID :</label>
            									<input type="text" name="member_ic" id="member_ic" class="form-control"><br><br>
            									<label for="text-input" class=" form-control-label">Member Name :</label>
            									<input type="text" name="member_fullname" id="member_fullname" class="form-control" readonly>
            									<label for="text-input" class=" form-control-label">Member Email :</label>
            									<input type="text" name="member_email" id="member_email" class="form-control" readonly>
            									<label for="text-input" class=" form-control-label">Member Contact :</label>
            									<input type="text" name="member_contact" id="member_contact" class="form-control" readonly><br>
                              <input type="hidden" name="member_limit" id="member_limit">
                              <input type="hidden" name="member_id" id="member_id">
                              <?php $libraian_id = $_GET["id"];?>
                              <p align="right"><a href="manage_issue_borrow_socket_listen.php?id=<?php echo $libraian_id;?>" onclick="return confirm('Scaning Fingerprint?');"><button class="btn btn-success btn-xs"><i class='fa fa-arrow-circle-o-right'></i>&nbsp;&nbsp;Validate</button></a>
                              <button id="check" class="btn btn-info btn-xs"><i class='fa fa-arrow-circle-o-right'></i>&nbsp;&nbsp;Check</button></p>
                            </div>
            								<div class="col-md-9">
            									<!-- MODAL BOX-->
            									<?php include('manage_issue_borrow_book.php'); ?>
                              <a href="#borrow" data-toggle="modal"><button class="btn btn-info btn-xs"  id="btn_borrow" hidden><i class='fa  fa-plus-circle'></i>&nbsp;&nbsp;Book</button></a>
                              <br><br><div id="availability"></div>
            									<!-- MODAL BOX-->
            									<!-- TABLE DISPLAY-->
            									<form method="post" id="user_form">
            										<div class="table-responsive">
            											<table class="table table-striped table-bordered" id="user_data">
            												<tr>
            													<th>Book Code</th>
            													<th>Book Title</th>
              												<th>Book Category</th>
                											<th>Book Author</th>
                                      <th>Remove</th>
            												</tr>
            											</table>
            										</div>
            										<div align="center">
                                	<button type="submit" name="insert" id="insert" class="btn btn-success" hidden><i class='fa fa-check-square-o'></i>&nbsp;&nbsp;Done</button>
            										</div>
            									</form>
            									<!-- TABLE DISPLAY-->
            								</div>
							          </div>
						         </div>
					          </div>
                  </div>
                </div>
            </div>
   </div>

<?php include('footer.php'); ?>

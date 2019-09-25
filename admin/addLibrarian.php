<!doctype html>
<?php
include 'dbLibrarian.php';
if(isset($_POST['Add'])){
    addLibrarian();
}
?>
    <?php include 'title.php'; ?>
<body>
<?php include 'left-panel.php'; ?>
    <div id="right-panel" class="right-panel">
    <?php include 'header2.php'; ?>
    <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Librarian</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Librarian</a></li>
                            <li class="active">New Librarian</li>
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
                              <small>New Librarian</small>
                          </div>
                          <div class="card-body">
                            <form action="" method="post" class="form-horizontal" autocomplete="off">
                            <div class="col-lg-12">
                              <div class="row form-group">
                                <div class="col col-md-3">
                                  <label for="" class="px-1  form-control-label">Librarian Username :</label>
                                  </div>
                                <div class="col-12 col-md-9">
                                  <input name="username" type="text"  placeholder="Enter Username" required="" class="form-control">
                                  </div>
                              </div>
                              <div class="row form-group">
                                  <div class="col col-md-3">
                                      <label for="" class="px-1  form-control-label">Librarian Name:</label>
                                  </div>
                                    <div class="col-12 col-md-9">
                                        <input name="fullname" type="text" placeholder="Enter Name" required="" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col col-md-3">
                                  <label for="" class="px-1  form-control-label">Librarian Email :</label>
                                    </div>
                                  <div class="col-12 col-md-9">
                                  <input name="email" type="text" placeholder="Enter Email" required="" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Must in email format! e.g user@gmail.com">
                                </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col col-md-3">
                                  <label for="" class="px-1  form-control-label">Librarian Contact :</label>
                                    </div>
                                  <div class="col-12 col-md-9">
                                  <input name="contact" type="text" placeholder="Enter Contact" required="" class="form-control" pattern="[0]+[0-9]{9,}$" title="Must in 10 or 11 phone number format! e.g 0001112222">
                                </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col col-md-3">
                                  <label for="" class="px-1  form-control-label">Librarian Address :</label>
                                    </div>
                                  <div class="col-12 col-md-9">
                                    <textarea name="address" rows="3" placeholder="Enter Address" class="form-control" required ></textarea>
                                  </div>
                                </div>
                                    <input type="hidden" name="admin_id" value="<?php echo $id;?>">
                                </div>
                            </div>
                          <div class="card-footer">
                            <button type="submit" name="Add" class="btn btn-success btn-sm">
                              <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                               <i class="fa fa-ban"></i> Reset
                            </button>
                            </form>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    <?php include 'script.php'; ?>
</body>

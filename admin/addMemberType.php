
<?php
  include 'dbSetting.php';
  if(isset($_POST['Add'])){
      addMemberType();
  }
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
                            <li class="active">New Position</li>
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
                            <small>New Position</small>
                        </div>
                        <div class="card-body">
                          <form action="" method="post" class="form-horizontal" autocomplete="off">
                            <div class="form-group"><label for="" class="px-1  form-control-label">Position Name :</label><input name="type_name" type="" id="" placeholder="Enter New Position" required class="form-control"></div>
                            <div class="form-group"><label for="" class="px-1  form-control-label">Book Limit :</label><input name="book_limit" type="number" min="1" max="99" id="" placeholder="Enter Book Limit" required class="form-control"></div>
                            <div class="form-group"><label for="" class="px-1  form-control-label">Borrow Day :</label><input name="borrow_day" type="number" min="1" max="99" id="" placeholder="Enter Borrow Day" required class="form-control"></div>
                            <div class="form-group"><label for="" class="px-1  form-control-label">Penalty Rate :</label><input name="penalty_rate" min="0.01" max="99" step="0.01" type="number" id="" placeholder="Enter Penalty Rate" required class="form-control"></div>
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

    </div>
    <?php include 'script.php'; ?>
</body>

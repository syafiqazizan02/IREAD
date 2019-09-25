<!doctype html>
<?php
include 'dbSetting.php';
if(isset($_REQUEST['Add'])){
    addCategory();
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
                        <h1>Manage Setting</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Setting</a></li>
                            <li class="active">New Category</li>
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
                              <small>New Category</small>
                          </div>
                          <div class="card-body">
                            <form action="" method="post" class="form-horizontal" autocomplete="off">
                              <div class="form-group"><label for="" class="px-1  form-control-label">Category Code :</label><input name="category_code" type="number" id="" placeholder="Enter Category Code" required="" class="form-control"></div>
                              <div class="form-group"><label for="" class="px-1  form-control-label">Category Name :</label><input name="category_name" type="text" id="" placeholder="Enter Category Name" required="" class="form-control"></div>
                              <div class="form-group"><label for="" class="px-1  form-control-label">Shelf No :</label><input name="shelf_no" type="text" id="" placeholder="Enter Shelf No" required="" class="form-control"></div>
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

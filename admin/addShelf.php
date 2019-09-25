<!doctype html>
<?php
include 'dbSetting.php';
displayShelf();
if(isset($_REQUEST['Add'])){
    addShelf();
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
                            <li class="active">New Shelf</li>
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
                            <small>New Shelf</small>
                        </div>
                        <div class="card-body">
                          <form action="" method="post" class="form-horizontal" autocomplete="off">
                            <?php $erow = $result3->fetch_assoc() ?>
                            <input type="hidden" name="category_id" value="<?php echo $erow['category_id']; ?>">
                            <div class="form-group"><label for="" class="px-1  form-control-label">Category Code :</label><input type="text" name="" value="<?php echo $erow['category_code']; ?>" class="form-control" disabled></div>
                            <div class="form-group"><label for="" class="px-1  form-control-label">Category Name : </label><input type="text" name="" value="<?php echo $erow['category_name']; ?>" class="form-control" disabled></div>
                            <?php do { ?>
                            <div class="form-group"><label for="" class="px-1  form-control-label">Shelf Existed :</label><input type="text" name="" value="<?php echo $erow['shelf_no']; ?>" class="form-control" disabled></div>
                            <?php } while($erow = $result3->fetch_assoc());?>
                            <div class="form-group"><label for="" class="px-1  form-control-label">Shelf New :</label><input type="text" name="shelf_no" placeholder="Enter Shelf No" class="form-control" required></div>
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

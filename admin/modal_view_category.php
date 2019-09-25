<!-- modal-->
<div class="modal fade" id="edit<?php echo $category_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <?php
                  $category_id = $category_id;

                  $stmt2 = $conn->prepare("SELECT * FROM category JOIN shelf ON category.category_id=shelf.category_id WHERE category.category_id=? ");
                  $stmt2->bind_param("s", $category_id);
                  $stmt2->execute();
                  $result2 = $stmt2->get_result();
                  $erow = $result2->fetch_assoc();
                ?>
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Setting <small>View Category</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Category Code : </label></div>
                      <div class="col-12 col-md-9"><input type="text" name="" value="<?php echo $erow['category_code']; ?>" class="form-control" disabled></div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Category Name : </label></div>
                      <div class="col-12 col-md-9"><input type="text" name="" value="<?php echo $erow['category_name']; ?>" class="form-control" disabled></div>
                    </div>
                    <?php do { ?>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Shelf Info : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-9"><input type="text" name="" value="<?php echo $erow['shelf_no']; ?>" class="form-control" disabled></div>
                    </div>
                    <?php } while($erow = $result2->fetch_assoc());?>

                    <?php ?>
                </div>
                <div class="modal-footer">
                    <a href="addShelf.php?cat_id=<?php echo $category_id?>"><button type="submit" class="btn btn-success btn-xs" ><span class="fa fa-plus-circle">&nbsp;&nbsp;New Shelf</span></button></a>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->

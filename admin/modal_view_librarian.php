<!-- modal-->
<div class="modal fade" id="edit<?php echo $librarian_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <?php
                  $librarianId = $librarian_id;

                  $stmt2 = $conn->prepare("SELECT * FROM librarian where librarian_id=?");
                  $stmt2->bind_param("s", $librarianId);
                  $stmt2->execute();
                  $result2 = $stmt2->get_result();
                  $erow = $result2->fetch_assoc();
                ?>
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Librarian <small>Reset Password</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Librarian Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-9"><input type="text" name="" value="<?php echo $erow['librarian_fullname']; ?>" class="form-control" disabled></div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Librarian Email :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-9"><input type="text" name="" value="<?php echo $erow['librarian_email']; ?>" class="form-control" disabled></div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Librarian Contact :</label></div>
                      <div class="col-12 col-md-9"><input type="text" name="" value="<?php echo $erow['librarian_contact']; ?>" class="form-control" disabled></div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Librarian Address :</label></div>
                      <div class="col-12 col-md-9"><textarea name="member_address" rows="3" class="form-control" disabled><?php echo $erow['librarian_address']; ?></textarea></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="manageLibrarian.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                      <input type="hidden" name="librarian_id" value="<?php echo $erow['librarian_id'];?>">
                      <button type="submit" name="default_password" class="btn btn-success btn-md" onclick="return confirm('Are you sure?');"><i class="fa fa-gears"></i>&nbsp;Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->

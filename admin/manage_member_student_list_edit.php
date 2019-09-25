<!-- modal-->
     <div class="modal fade" id="edit<?php echo $member_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <?php

                  $memberId = $member_id;

                  $stmt2 = $conn->prepare("SELECT * FROM member where member_id=?");
                  $stmt2->bind_param("s", $memberId);
                  $stmt2->execute();
                  $result2 = $stmt2->get_result();
                  $erow = $result2->fetch_assoc();

                    $member_id = $erow['member_id'];
                    $member_ic = $erow['member_ic'];
                    $member_fullname = $erow['member_fullname'];
                    $member_contact = $erow['member_contact'];
                    $member_email = $erow['member_email'];
                    $member_address = $erow['member_address'];

                ?>
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Member   <small>Rest Password</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="manage_member_student_list_update.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
          					<div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Member ID :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-9"><input type="text" name="member_ic" value="<?php echo $member_ic; ?>" class="form-control"  size="12" pattern=".{12}" readonly></div>
          					</div>
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Member Name :&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-9"><input type="text" name="member_fullname" value="<?php echo $member_fullname; ?>" class="form-control" readonly></div>
                    </div>
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Member Email :&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-9"><input type="text" name="member_email" value="<?php echo $member_email; ?>" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" readonly></div>
                    </div>
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Member Contact :</label></div>
                      <div class="col-12 col-md-9"><input type="text" name="member_contact" value="<?php echo $member_contact; ?>" class="form-control" size="11" pattern=".{10,11}" readonly></div>
                    </div>
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Member Address :</label></div>
                      <div class="col-12 col-md-9"><textarea name="member_address" rows="3" class="form-control" readonly><?php echo $member_address; ?></textarea></div>
                    </div>
                    <div class="row">
                      <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                      <input type="hidden" name="librarian_id" value="<?php echo $id; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                  	<button type="submit" name="submit" class="btn btn-success btn-md" onclick="return confirm('Are you sure?');"><span class="fa fa-gear"></span>&nbsp;Reset Password</button>
                </div>
				       </form>
            </div>
        </div>
    </div>
<!-- /.modal -->

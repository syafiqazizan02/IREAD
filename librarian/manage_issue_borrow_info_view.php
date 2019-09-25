<!-- modal-->
     <div class="modal fade" id="viewborrow<?php echo $return_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Issue   <small>Member Details</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <?php

                   include "db_conn.php";

                    $query = mysqli_query($conn, "SELECT  c.borrow_date as borrow_date, c.due_date as due_date, e.member_ic as member_ic, e.member_fullname as member_fullname
                                                  FROM `return` AS a
                                                  JOIN borrow AS c ON a.borrow_id=c.borrow_id
                                                  JOIN member AS e ON c.member_id=e.member_id
                                                  AND a.return_id = '$return_id'");

                    $data = mysqli_fetch_assoc($query);

                      $borrow_date = $data['borrow_date'];
                      $due_date = $data['due_date'];
                      $member_ic = $data['member_ic'];
                      $member_fullname = $data['member_fullname'];

                 ?>
                <div class="modal-body">
        					<div class="row">
        						<div class="col col-md-3"><label for="text-input" class=" form-control-label">Member ID :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
        						<div class="col-12 col-md-9"><input type="text" class="form-control" value="<?php echo $member_ic; ?>" readonly/></div>
                  </div>
        					<div style="height:10px;"></div>
        					<div class="row">
        						<div class="col col-md-3"><label for="text-input" class=" form-control-label">Member Name :&nbsp;&nbsp;</label></div>
        						<div class="col-12 col-md-9"><input type="text" class="form-control" value="<?php echo $member_fullname; ?>"readonly/></div>
                  </div>
        					<div style="height:10px;"></div>
        					<div class="row">
        						<div class="col col-md-3"><label for="text-input" class=" form-control-label">Borrow Date :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
        						<div class="col-12 col-md-9"><input type="text"  class="form-control" value="<?php echo date_format(date_create($borrow_date), 'd F y'); ?>" readonly/></div>
                	</div>
        					<div style="height:10px;"></div>
        					<div class="row">
        						<div class="col col-md-3"><label for="text-input" class=" form-control-label">Due Date :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
        						<div class="col-12 col-md-9"><input type="text" class="form-control" value="<?php echo date_format(date_create($due_date), 'd F y'); ?>" readonly/></div>
                	</div>
        					<div style="height:10px;"></div>
        				</div>
                <div class="modal-footer">
                </div>
			      </div>
        </div>
    </div>
<!-- /.modal -->

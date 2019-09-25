<!-- modal-->
     <div class="modal fade" id="nilam<?php echo $return_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <?php

                  $return_ID = $return_id;

                  $stmt2 = $conn->prepare("SELECT * FROM `return` WHERE return_id=?");
                  $stmt2->bind_param("s", $return_ID);
                  $stmt2->execute();
                  $result2 = $stmt2->get_result();
                  $erow = $result2->fetch_assoc();
                    $nilam_desc = $erow['nilam_desc'];

                ?>
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Member   <small>Nilam Review</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Description:</label>
                    <textarea class="form-control" rows="5" readonly><?php echo $nilam_desc; ?></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <br>
                </div>
				       </form>
            </div>
        </div>
    </div>
<!-- /.modal -->

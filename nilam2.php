
<!-- modal-->


     <div class="modal fade" id="a<?php echo $returnId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Nilam   <small>Book Review</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" id="user_form" action="nilam3.php" enctype="multipart/form-data">

                  <?php
                  $nilam = "SELECT `return`.return_id,book.book_tittle, `return`.done_id, `return`.nilam_desc FROM `return` INNER JOIN book ON `return`.book_id = book.book_id WHERE `return`.return_id = '$returnId'";
                	$nil= mysqli_query($db, $nilam);


                             foreach ($nil as $key) {
                               $booktitle = $key['book_tittle'];
                               $return_id = $key['return_id'];
                               $nilamdesc = $key['nilam_desc'];
                             }

                   ?>

                  <?php  $return_id; ?>
                <div class="modal-body">
                  <div class="form-group">

                   <label for="comment"><?php echo $booktitle;  ?></label>
                   <input type="hidden" name="return_id" value="<?php echo $return_id; ?>">
                   <textarea class="form-control" rows="5" minlength="50" maxlength="300" name="submitnilam" required><?php echo $nilamdesc; ?></textarea>

                 </div>
                </div>
                <div class="modal-footer">
                  	<button type="submit"  name="submitnil" class="btn btn-success btn-md"><span class="fa fa-bullseye"></span></button>
          				  <button type="reset" class="btn btn-danger btn-md"><span class="fa fa-ban"></span></button>
                </div>
				       </form>

            </div>
        </div>
    </div>


<!-- /.modal -->

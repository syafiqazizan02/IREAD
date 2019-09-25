<!-- modal-->
     <div class="modal fade" id="borrow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Issue   <small>Add Book</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
        					<div class="row">
        						<div class="col col-md-3"><label for="text-input" class=" form-control-label">Book ID :</label></div>
        						<div class="col-12 col-md-9"><input type="text" name="book_code" id="book_code" class="form-control" autofocus required/></div>
                  </div>
        					<div style="height:30px;"></div>
        					<div class="row">
        						<div class="col col-md-3"><label for="text-input" class=" form-control-label">Book Title :</label></div>
        						<div class="col-12 col-md-9"><input type="text" name="book_tittle" id="book_tittle" class="form-control" readonly/></div>
                  </div>
        					<div style="height:10px;"></div>
        					<div class="row">
        						<div class="col col-md-3"><label for="text-input" class=" form-control-label">Book Category :</label></div>
        						<div class="col-12 col-md-9"><input type="text" name="book_category" id="book_category" class="form-control" readonly/></div>
                	</div>
        					<div style="height:10px;"></div>
        					<div class="row">
        						<div class="col col-md-3"><label for="text-input" class=" form-control-label">Book Author :</label></div>
        						<div class="col-12 col-md-9"><input type="text" name="book_author" id="book_author" class="form-control" readonly/></div>
                	</div>
						         <input type="hidden" name="book_id" id="book_id">
        					<div style="height:10px;"></div>
        				</div>
                <div class="modal-footer">
      					<!--BUTTON-->
      						<input type="hidden" name="row_id" id="hidden_row_id" />
      						<button type="button" name="save" id="save" class="btn btn-success">Save</button>
    				    <!--BUTTON-->
                </div>
			      </div>
        </div>
    </div>
<!-- /.modal -->

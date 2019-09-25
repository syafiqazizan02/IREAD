<!doctype html>
<?php
if(isset($_POST['default_password'])){
    include 'dbLibrarian.php';
    updateLibrarianData();
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
                        <h1>Manage Librarian</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Librarian</a></li>
                            <li class="active">View Librarian</li>
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
                              <small>View Librarian</small>
                          </div>
                          <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                              <thead>
                                  <tr align="center">
                                  <th>Librarian Username</th>
                                  <th>Librarian Name</th>
                                  <th>Status</th>
                                  <th width="10px"><button type="button" name="btn_active" id="btn_active" class="btn btn-success btn-sm pull-right"><b>Change</b>&nbsp;&nbsp;<i class='fa fa-exchange'></i></button></th>
                                  <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php include 'dbLibrarian.php'; displayLibrarianData();?>
                              </tbody>
                            </table>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>

    <?php include 'script.php'; ?>

    <script src="../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../assets/js/lib/data-table/datatables-init.js"></script>

    <script type="text/javascript">
    <!--Change Librarian Status-->
		$(document).ready(function(){
		 $('#btn_active').click(function(){
		  if(confirm("Are you sure?")){
			 var id = [];
		   $(':checkbox:checked').each(function(i){
		    id[i] = $(this).val();
		   });
		   if(id.length === 0){
		     alert("Please tick at least one checkbox");
		   }else{
		    $.ajax({
		     url:'ajax_librarian_status.php',
		     method:'POST',
		     data:{id:id},
		     success:function(){
					 alert("Successfully Change Librarian Status!");
					  window.location.reload(true);
		     }
		    });
		   }
		  }else{
		   return false;
		  }
		 });
		});

        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>

</body>

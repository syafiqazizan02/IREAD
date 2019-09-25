<!doctype html>
<?php include 'title.php'; ?>

<body>
<?php include 'left-panel.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php include 'header2.php'; ?>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                        <strong class="card-title">Member Data</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>IC Number</th>
                        <th>Full Name</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                    <tbody>
                        <?php include 'dbMember.php'; displayMemberData();?>
                    </tbody>
                    </table>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--sm-8-->
    </div><!--right panel -->

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
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>

    <!-- <script src="assets/js/lib/chart-js/Chart.bundle.js"></script> -->
    <!-- <script src="assets/js/dashboard.js"></script> -->
    <!-- <script src="assets/js/widgets.js"></script> -->
</body>
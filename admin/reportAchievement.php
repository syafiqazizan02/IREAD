<!doctype html>
<?php include 'title.php'; ?>
<?php
include '../connection/conn.php';
$achievement = "SELECT member.member_fullname, member.member_ic,  COUNT(done.done_id) AS a FROM `done`
JOIN `return` ON done.done_id = `return`.done_id
JOIN member ON `done`.member_id = `member`.member_id
WHERE `return`.nilam_status=1
GROUP BY done.member_id ORDER BY a DESC LIMIT 10";
$arc = $conn->query($achievement);
$top = 1;
?>
<body>
<?php include 'left-panel.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php include 'header2.php'; ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Member Report</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Member Report</a></li>
                            <li class="active">Top 10 Member Nilam</li>
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
                              <small>Top 10 Member Nilam</small>
                          </div>
                          <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr align="center">
                                      <th>Rank</th>
                                      <th>Member Name</th>
                                      <th>Member ID</th>
                                      <th>Number Of Nilam</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                <?php

                                    while($row = $arc->fetch_assoc()){
                                        echo "<tr align='center'>";
                                        echo "<td>".$top."</td>";
                                        echo "<td>".$row['member_fullname']."</td>";
                                        echo "<td>".$row['member_ic']."</td>";
                                        echo "<td>".$row['a']."</td>";
                                        echo "</tr>";
                                        $top++;
                                    }
                                    ?>
                                </tbody>
                                </table>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>

    <?php include 'script.php'; ?>

        <!-- <script src="../assets/js/lib/data-table/datatables.min.js"></script>
        <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
        <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
        <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
        <script src="../assets/js/lib/data-table/jszip.min.js"></script>
        <script src="../assets/js/lib/data-table/pdfmake.min.js"></script>
        <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
        <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
        <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
        <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
        <script src="../assets/js/lib/data-table/datatables-init.js"></script> -->

</body>

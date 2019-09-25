<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('navbar.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Issue</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Issue</a></li>
                            <li class="active">Borrow Receipts</li>
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
                            <small>Borrow Receipts</small>
                        </div>
                        <div class="card-body">
                          <table id="bootstrap-data-table" class="table table-striped table-bordered">
                           <thead>
                             <tr align="center">
                               <th>Borrow ID</th>
                               <th>Borrow Date</th>
                               <th>Due Date</th>
                               <th>Member ID</th>
                               <th>Member Name</th>
                               <th>View</th>
                               <th>Print</th>
                             </tr>
                           </thead>
                           <tbody>
                             <?php

                                $id = $_REQUEST['id'];

                                include "db_conn.php";

                                $return_status = 0;

                                $stmt = $conn->prepare("SELECT DISTINCT c.borrow_id as borrow_id, c.borrow_date as borrow_date, c.due_date as due_date, e.member_ic as member_ic, e.member_fullname as member_fullname
                                                        FROM `return` AS a
                                                        JOIN borrow AS c ON a.borrow_id=c.borrow_id
                                                        JOIN member AS e ON c.member_id=e.member_id
                                                        AND c.due_date >= NOW() AND a.return_status=? ORDER BY c.borrow_id DESC");
                                $stmt->bind_param("s", $return_status);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                  while($row = $result->fetch_assoc())
                                  {
                                      $borrow_id = $row['borrow_id'];
                                      $borrow_date = date_format(date_create($row['borrow_date']), 'd M Y');
                                      $due_date = date_format(date_create($row['due_date']), 'd M Y');
                                      $member_ic = $row['member_ic'];
                                      $member_fullname = $row['member_fullname'];
                             ?>
                             <tr align="center">
                               <td>IDB<?php echo $borrow_id; ?></td>
                               <td><?php echo $borrow_date; ?></td>
                               <td><?php echo $due_date; ?></td>
                               <td><?php echo $member_ic; ?></td>
                               <td><?php echo $member_fullname; ?></td>
                               <td>
                                 <?php include('manage_issue_borrow_details.php'); ?>
                                 <a href="#viewdetails<?php echo $borrow_id; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class='fa fa-info-circle'></i></a>
                               </td>
                               <td align="center">
                                 <form action="manage_issue_borrow_print.php" method="post" enctype="multipart/form-data" target="print_popup"  onsubmit="window.open('about:blank','print_popup','width=800,height=500');">
                                  <input type="hidden" name="borrow_id" value="<?php echo $borrow_id; ?>">
                                  <button type="submit" name="submit" class="btn btn-dark btn-sm"><i class="fa fa-print"></i></button>
           										  </form>
                              </td>
                             <?php }?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

   </div>

<?php include('footer.php'); ?>

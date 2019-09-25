<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('navbar.php'); ?>
<?php include('db_conn.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Book</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Book</a></li>
                            <li class="active">Generate Barcode</li>
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
                      <form action="manage_book_barcode_print.php" method="post" enctype="multipart/form-data" target="print_popup"  onsubmit="window.open('about:blank','print_popup','width=800,height=500');">
                      <div class="card-header">
                          <small>Generate Barcode</small>
                          <!-- <button type="submit" name="select" class="btn btn-success btn-sm" ><b>Generate</b>&nbsp;&nbsp;<i class='fa fa-arrow-circle-o-right'></i></button> -->
                      </div>
                      <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                              <thead>
                                <tr align="center">
                                  <th width="15%">Book Code</th>
                                  <th width="25%">Book Title</th>
                                  <th width="20%">Book Category</th>
                                  <th width="15%">Book Author</th>
                                  <th width="15%">Book Publisher</th>
                                  <th width="10%"><button type="submit" name="select" class="btn btn-success btn-sm" ><b>Generate</b>&nbsp;&nbsp;<i class='fa fa-arrow-circle-o-right'></i></button></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php

                              $book_remark = 0;
                              $book_status = 0;

                              $stmt = $conn->prepare("SELECT b.book_id as book_id, b.book_code as book_code, b.book_tittle as book_tittle, d.category_name as book_category, b.book_author as book_author, b.book_publisher as book_publisher
                                                      FROM book AS b
                                                      JOIN category AS d ON b.category_id=d.category_id
                                                      AND b.book_remark=? AND b.book_status=?");
                              $stmt->bind_param("ss", $book_remark, $book_status);
                              $stmt->execute();
                              $result = $stmt->get_result();


                                while($row = $result->fetch_assoc())
                                {
                                    $book_id = $row['book_id'];
                                    $book_code = $row['book_code'];
                                    $book_tittle = $row['book_tittle'];
                                    $book_category = $row['book_category'];
                                    $book_author = $row['book_author'];
                                    $book_publisher = $row['book_publisher'];
                              ?>
                                <tr align="center">
                                  <td><?php echo $book_code; ?></td>
                                  <td><?php echo $book_tittle; ?></td>
                                  <td><?php echo $book_category; ?></td>
                                  <td><?php echo $book_author; ?></td>
                                  <td><?php echo $book_publisher; ?></td>
                                  <td><input type="checkbox" name="selectlist[]" value="<?php echo $book_id; ?>" /></td>
                            <?php }?>
                              </tbody>
                            </table>
                          </form>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

   </div>

<?php include('footer.php'); ?>

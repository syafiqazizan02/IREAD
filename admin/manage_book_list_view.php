<!doctype html>
<?php include 'title.php'; ?>

<body>
<?php include 'left-panel.php'; ?>
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
                            <li class="active">View Book</li>
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
                            <small>View Book</small>
                        </div>
                        <div class="card-body">
                          <table id="bootstrap-data-table" class="table table-striped table-bordered">
                           <thead>
                             <tr align="center">
                               <th width="10%">Book Isbn</th>
                               <th width="25%">Book Title</th>
                               <th width="15">Book Category</th>
                               <th width="15">Book Author</th>
                               <th width="15">Book Publisher</th>
                               <th width="15%">Action</th>
                             </tr>
                           </thead>
                           <tbody>
                             <?php

                                $stmt = $conn->prepare("SELECT DISTINCT b.book_isbn as book_isbn, b.book_tittle as book_tittle, d.category_name as book_category, b.book_author as book_author, b.book_publisher as book_publisher
                                                        FROM book AS b
                                                        JOIN category AS d ON b.category_id=d.category_id");
                                $stmt->execute();
                                $result = $stmt->get_result();

                                  while($row = $result->fetch_assoc())
                                  {
                                      $book_isbn = $row['book_isbn'];
                                      $book_tittle = $row['book_tittle'];
                                      $book_category = $row['book_category'];
                                      $book_author = $row['book_author'];
                                      $book_publisher = $row['book_publisher'];
                             ?>
                             <tr align="center">
                               <td><?php echo $book_isbn; ?></td>
                               <td><?php echo $book_tittle; ?></td>
                               <td><?php echo $book_category; ?></td>
                               <td><?php echo $book_author; ?></td>
                               <td><?php echo $book_publisher; ?></td>
                               <td align="center">
                                 <?php include('manage_book_list_info.php'); ?>
                                 <a href="#info<?php echo $book_isbn; ?>" data-toggle="modal" class="btn btn-info btn-sm" style="color:white"><i class='fa fa-info-circle'></i></a>
                                 <?php include('manage_book_list_edit.php'); ?>
                                 <a href="#edit<?php echo $book_isbn; ?>" data-toggle="modal" class="btn btn-warning btn-sm" style="color:white"><i class='fa fa-edit'></i></a>
                                 <a href="manage_book_list_delete.php?id=<?php echo $id; ?>&book_isbn=<?php echo $book_isbn; ?>" onclick="return confirm('Are you sure?');"><button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a></td>
                               </td>
                             </tr>
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

<!-- modal-->
     <div class="modal fade" id="edit<?php echo $book_isbn; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <?php

                    $bookISBN = $book_isbn;

                    $stmt2 = $conn->prepare("SELECT b.book_isbn as book_isbn, b.book_tittle as book_tittle, d.category_name as book_category, b.book_author as book_author, b.book_publisher as book_publisher, b.book_year as book_year, b.book_price as book_price, f.shelf_no as shelf_no
                                             FROM book AS b
                                             JOIN category AS d ON b.category_id=d.category_id
                                             JOIN shelf AS f ON d.category_id=f.category_id
                                             AND b.book_isbn = ?");

                    $stmt2->bind_param("s", $bookISBN);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();
                    $erow = $result2->fetch_assoc();

                      $book_tittle = $erow['book_tittle'];
                      $book_category = $erow['book_category'];
                      $book_author = $erow['book_author'];
                      $book_isbn = $erow['book_isbn'];
                      $book_publisher = $erow['book_publisher'];
                      $book_year = $erow['book_year'];
                      $book_price = $erow['book_price'];
                      $book_shelf = $erow['shelf_no'];

                ?>
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Book   <small>Edit Book</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="manage_book_list_update.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                  <div class="col-lg-12">
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Title :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_tittle" value="<?php echo $book_tittle; ?>" class="form-control" required></div>
                    </div>
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Price (RM):&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="number" name="book_price" value="<?php echo $book_price; ?>" class="form-control" required></div>
                    </div>
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Author :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_author" value="<?php echo $book_author; ?>" class="form-control" required></div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Publisher :&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_publisher" value="<?php echo $book_publisher; ?>" class="form-control" required></div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Year :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_year" value="<?php echo $book_year; ?>" class="form-control" required></div>
                    </div>
                    <div style="height:10px;"></div>
                  </div>
                  <?php $librarian_id = $_GET["id"];?>
                  <input type="hidden" name="librarian_id" value="<?php echo $librarian_id;?>">
                    <input type="hidden" name="book_isbn" value="<?php echo $book_isbn;?>">
                </div>
                <div class="modal-footer">
                  <button type="submit" name="submit" class="btn btn-success btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Update
                  </button>
                  <button type="reset" class="btn btn-danger btn-sm">
                     <i class="fa fa-ban"></i> Reset
                  </button>
                </div>
				       </form>
            </div>
        </div>
    </div>
<!-- /.modal -->

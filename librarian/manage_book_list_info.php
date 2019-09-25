<!-- modal-->
     <div class="modal fade" id="info<?php echo $book_isbn; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
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


                      $stmt3 = $conn->prepare("SELECT count(1) from book WHERE book_isbn=?");
                      $stmt3->bind_param("s", $book_isbn);
                      $stmt3->execute();
                      $result3 = $stmt3->get_result();
                      $row3 = $result3->fetch_row();
                        $totalQuantity = $row3[0];

                      $book_status = 0;
                      $book_remark = 0;
                      $stmt6 = $conn->prepare("SELECT count(1) from book WHERE book_isbn=? AND book_status=? AND book_remark=?");
                      $stmt6->bind_param("sss", $book_isbn, $book_status, $book_remark);
                      $stmt6->execute();
                      $result6 = $stmt6->get_result();
                      $row6 = $result6->fetch_row();
                        $totalAvailabile = $row6[0];

                      $bookremark = 1;
                      $stmt7 = $conn->prepare("SELECT count(book_remark) from book WHERE book_isbn=? AND book_remark=?");
                      $stmt7->bind_param("ss", $book_isbn, $bookremark);
                      $stmt7->execute();
                      $result7 = $stmt7->get_result();
                      $row7 = $result7->fetch_row();
                        $totalDamage = $row7[0];

                ?>
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Book   <small>Info Book</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col col-md5"><label for="text-input" class=" form-control-label">Book ISBN :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_isbn" value="<?php echo $book_isbn; ?>" class="form-control" readonly></div>
          					</div>
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-5"><label for="text-input" class=" form-control-label">Book Title :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_tittle" value="<?php echo $book_tittle; ?>" class="form-control" readonly></div>
                    </div>
          					<div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-5"><label for="text-input" class=" form-control-label">Book Category :</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_category" value="<?php echo $book_category; ?>" class="form-control" readonly></div>
                    </div>
          					<div style="height:40px;"></div>
                    <div class="row">
                      <div class="col col-md-5"><label for="text-input" class=" form-control-label">Book Price :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_price" value="RM <?php echo $book_price; ?>" class="form-control" readonly></div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-5"><label for="text-input" class=" form-control-label">Book Shelf :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_shelf" value="<?php echo $book_shelf; ?>" class="form-control" readonly></div>
                    </div>
                    <div style="height:10px;"></div>
                  </div>
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col col-md-5"><label for="text-input" class=" form-control-label">Book Author :&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_author" value="<?php echo $book_author; ?>" class="form-control" readonly></div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-5"><label for="text-input" class=" form-control-label">Book Publisher :</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_publisher" value="<?php echo $book_publisher; ?>" class="form-control" readonly></div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                      <div class="col col-md-5"><label for="text-input" class=" form-control-label">Book Year :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                      <div class="col-12 col-md-7"><input type="text" name="book_year" value="<?php echo $book_year; ?>" class="form-control" readonly></div>
                    </div><br>
                    <div style="height:10px;"></div>
                    <div class="row">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="row">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <p style="color:black">Book Quantity : <b><?php echo $totalQuantity; ?></b><br>&nbsp;
                      Book Availabile : <b><?php echo $totalAvailabile; ?></b><br>&nbsp;
                      Book Damage : <b><?php echo $totalDamage; ?></b>&nbsp;&nbsp;</p>
                    </div><br>
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

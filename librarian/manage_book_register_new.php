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
                            <li class="active">New Book</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <small>New Book</small>
                      </div>
                      <div class="card-body card-block">
                        <form action="manage_book_register_add.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="col-lg-6">
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Title :</label></div>
                              <div class="col-12 col-md-8"><input type="text" name="book_tittle" placeholder="Enter Title" class="form-control" required></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="select" class=" form-control-label">Book Category :</label></div>
                              <div class="col-12 col-md-8">
                                <select name="book_category" id="book_category" class="form-control" required>
                                  <option value="">Select Category</option>
                                  <?php

                                      $query = $conn->query("SELECT * FROM category");

                                      $rowCount = $query->num_rows;

                                        if($rowCount > 0)
                                        {
                                          while($row = $query->fetch_assoc())
                                          {
                                            echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
                                          }
                                        }
                                        else
                                        {
                                          echo '<option value="">Category Not Available</option>';
                                        }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Copies :</label></div>
                              <div class="col-12 col-md-8"><input type="number" name="book_copies" placeholder="Enter Copies" class="form-control" required></div>
                            </div>
                            <div style="height:20px;"></div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Author :</label></div>
                              <div class="col-12 col-md-8"><input type="text" name="book_author" placeholder="Enter Author" class="form-control" required></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Publisher :</label></div>
                              <div class="col-12 col-md-8"><input type="text" name="book_publisher" placeholder="Enter Publisher" class="form-control" required></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Year :</label></div>
                              <div class="col-12 col-md-8"><input type="text" name="book_year" placeholder="Enter Year" class="form-control" required></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book ISBN :</label></div>
                            <div class="col-12 col-md-8"><input type="text" name="book_isbn" placeholder="Enter ISBN" class="form-control" required></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Book Price (RM) :</label></div>
                            <div class="col-12 col-md-8"><input type="number" name="book_price" placeholder="Enter Price" class="form-control" required></div>
                          </div>
                          <div class="row form-group">
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-4"><label for="select" class=" form-control-label">Book Shelf :</label></div>
                            <div class="col-12 col-md-8">
                              <select  name="book_shelf" id="book_shelf" class="form-control" required>
                                <option value="">Select Category First!</option>
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <input type="hidden" name="librarian_id" value="<?php echo $id; ?>">
                          </div>
                      </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-success btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                           <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
                    </form>
                    </div>
                  </div>

                </div>
            </div>
        </div>

   </div>

<?php include('footer.php'); ?>

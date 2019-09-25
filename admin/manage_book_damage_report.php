<table id="bootstrap-data-table1" class="table table-striped table-bordered">
  <thead>
    <tr align="center">
      <th width="15%">Book Code</th>
      <th width="25%">Book Title</th>
      <th width="20%">Book Category</th>
      <th width="15%">Book Author</th>
      <th width="15%">Book Publisher</th>
      <th width="10%"><button type="button" name="btn_damage" id="btn_damage" class="btn btn-success btn-sm"><b>Damage</b>&nbsp;&nbsp;<i class='fa fa-arrow-circle-o-right'></i></button></th>
    </tr>
  </thead>
  <tbody>
  <?php

    $book_status = 0;
    $book_remark = 0;

    $stmt4 = $conn->prepare("SELECT b.book_id as book_id, b.book_code as book_code, b.book_tittle as book_tittle, d.category_name as book_category, b.book_author as book_author, b.book_publisher as book_publisher
                            FROM book AS b
                            JOIN category AS d ON b.category_id=d.category_id
                            AND b.book_status=? AND b.book_remark=?");
    $stmt4->bind_param("ss", $book_status, $book_remark);
    $stmt4->execute();
    $result4 = $stmt4->get_result();

    while($row4 = $result4->fetch_assoc())
    {
        $book_id = $row4['book_id'];
        $book_code = $row4['book_code'];
        $book_tittle = $row4['book_tittle'];
        $book_category = $row4['book_category'];
        $book_author = $row4['book_author'];
        $book_publisher = $row4['book_publisher'];
  ?>
    <tr align="center" id="<?php echo $book_id; ?>">
      <td><?php echo $book_code; ?></td>
      <td><?php echo $book_tittle; ?></td>
      <td><?php echo $book_category; ?></td>
      <td><?php echo $book_author; ?></td>
      <td><?php echo $book_publisher; ?></td>
      <td><input type="checkbox" name="bookID[]" class="delete_book" value="<?php echo $book_id; ?>" /></td>
<?php }?>
  </tbody>
</table>

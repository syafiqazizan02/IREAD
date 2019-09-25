<table id="bootstrap-data-table2" class="table table-striped table-bordered">
  <thead>
    <tr align="center">
      <th>Book Code</th>
      <th>Book Title</th>
      <th>Book Category</th>
      <th>Book Author</th>
      <th>Book Publisher</th>
      <th>Damage Date</th>
      <th>Action</th>
   </tr>
  </thead>
  <tbody>
  <?php

    $book_remark = 1;

    $stmt5 = $conn->prepare("SELECT b.book_id as book_id, b.book_code as book_code, b.book_tittle as book_tittle, d.category_name as book_category, b.book_author as book_author, b.book_publisher as book_publisher, b.book_remark as book_remark, b.book_damage as book_damage
                            FROM book AS b
                            JOIN category AS d ON b.category_id=d.category_id
                            AND b.book_remark=?");
    $stmt5->bind_param("s", $book_remark);
    $stmt5->execute();
    $result5 = $stmt5->get_result();

        while($row5 = $result5->fetch_assoc())
        {
            $book_id = $row5['book_id'];
            $book_code = $row5['book_code'];
            $book_tittle = $row5['book_tittle'];
            $book_category = $row5['book_category'];
            $book_author = $row5['book_author'];
            $book_publisher = $row5['book_publisher'];
            $book_remark = $row5['book_remark'];
            $book_damage = date_format(date_create($row5['book_damage']), 'd M Y');

  ?>
    <tr align="center" id="<?php echo $book_id; ?>">
      <td><?php echo $book_code; ?></td>
      <td><?php echo $book_tittle; ?></td>
      <td><?php echo $book_category; ?></td>
      <td><?php echo $book_author; ?></td>
      <td><?php echo $book_publisher; ?></td>
      <td><?php echo $book_damage; ?></td>
      <td>
        <form action="manage_book_damage_status.php" method="post">
          <?php $id = $_SESSION['id']; ?>
					<input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
          <?php if($book_remark==1){
            echo "<a onclick='return confirm(\"Are You Sure?\");'><button type='submit' name='cancel' style='color:#ffffff;' class='btn btn-warning btn-sm'><i class='fa fa-undo'></i></button></a></td>";
          }?>
        </form>
      </td>
  <?php }?>
  </tbody>
</table>

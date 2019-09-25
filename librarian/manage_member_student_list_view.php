<table id="bootstrap-data-table1" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Student ID</th>
     <th>Student Name</th>
     <th>Student Contact</th>
     <th>View</th>
     <th>Action</th>
   </tr>
 </thead>
 <tbody>
   <?php

      $type_id = 1;

      $stmt = $conn->prepare("SELECT * FROM member WHERE type_id=?");
      $stmt->bind_param("s", $type_id);
      $stmt->execute();
      $result = $stmt->get_result();

        while($row = $result->fetch_assoc())
        {
            $member_id = $row['member_id'];
            $member_ic = $row['member_ic'];
            $member_fullname = $row['member_fullname'];
            $member_contact = $row['member_contact'];
   ?>
   <tr align="center">
     <td><?php echo $member_ic; ?></td>
     <td><?php echo $member_fullname; ?></td>
      <td>+6<?php echo $member_contact; ?></td>
     <td align="center">
       <a href="manage_member_student_info_view.php?id=<?php echo $id; ?>&stud_id=<?php echo $member_id; ?>"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i></button></a>
     </td>
     <td align="center">
       	<?php include('manage_member_student_list_edit.php'); ?>
        <a href="#edit<?php echo $member_id; ?>" data-toggle="modal" class="btn btn-warning btn-sm" style="color:white"><i class='fa fa-edit'></i></a>
        <a href="manage_member_student_list_delete.php?id=<?php echo $id; ?>&stud_id=<?php echo $member_id; ?>" onclick="return confirm('Are you sure?');"><button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
     </td>
   </tr>
   <?php }?>
  </tbody>
</table>

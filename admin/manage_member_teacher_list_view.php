<table id="bootstrap-data-table2" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Teacher ID</th>
     <th>Teacher Name</th>
     <th>Teacher Contact</th>
     <th>View</th>
     <th>Action</th>
   </tr>
 </thead>
 <tbody>
   <?php

      $type_id = 2;

      $stmt8 = $conn->prepare("SELECT * FROM member WHERE type_id=?");
      $stmt8->bind_param("s", $type_id);
      $stmt8->execute();
      $result8 = $stmt8->get_result();

        while($row8 = $result8->fetch_assoc())
        {
            $member_id = $row8['member_id'];
            $member_ic = $row8['member_ic'];
            $member_fullname = $row8['member_fullname'];
            $member_contact = $row8['member_contact'];
   ?>
   <tr align="center">
     <td><?php echo $member_ic; ?></td>
     <td><?php echo $member_fullname; ?></td>
      <td>+6<?php echo $member_contact; ?></td>
     <td align="center">
       <a href="manage_member_teacher_info_view.php?id=<?php echo $id; ?>&tech_id=<?php echo $member_id; ?>"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i></button></a>
     </td>
     <td align="center">
       	<?php include('manage_member_teacher_list_edit.php'); ?>
        <a href="#edit<?php echo $member_id; ?>" data-toggle="modal" class="btn btn-warning btn-sm" style="color:white"><i class='fa fa-edit'></i></a>
        <a href="manage_member_teacher_list_delete.php?id=<?php echo $id; ?>&tech_id=<?php echo $member_id; ?>" onclick="return confirm('Are you sure?');"><button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
     </td>
   </tr>
   <?php }?>
  </tbody>
</table>

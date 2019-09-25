<table id="bootstrap-data-table3" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Member ID</th>
     <th>Member Name</th>
     <th>Member Contact</th>
     <th>View</th>
     <th>Action</th>
   </tr>
 </thead>
 <tbody>
   <?php

      $a = 1;
      $b = 2;

      $stmt20 = $conn->prepare("SELECT * FROM member WHERE type_id NOT IN (?, ?)");
      $stmt20->bind_param("ss", $a,$b);
      $stmt20->execute();
      $result20 = $stmt20->get_result();

        while($row = $result->fetch_assoc())
        {
            $member_id = $row20['member_id'];
            $member_ic = $row20['member_ic'];
            $member_fullname = $row20['member_fullname'];
            $member_contact = $row20['member_contact'];
   ?>
   <tr align="center">
     <td><?php echo $member_ic; ?></td>
     <td><?php echo $member_fullname; ?></td>
      <td>+6<?php echo $member_contact; ?></td>
     <td align="center">
       <a href="reportOthers.php?member_id=<?php echo $member_id; ?>"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i></button></a>
     </td>
   </tr>
   <?php }?>
  </tbody>
</table>

<table id="bootstrap-data-table3" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Member ID</th>
     <th>Member Name</th>
     <th>Member Contact</th>
     <th>View</th>
   </tr>
 </thead>
 <tbody>
   <?php
   include "../connection/conn.php";

   $a = 1;
   $b = 2;

   $stmt8 = $conn->prepare("SELECT * FROM member WHERE type_id NOT IN (?, ?)");
   $stmt8->bind_param("ss", $a,$b);
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
       <a href="reportOther.php?other_id=<?php echo $member_id; ?>"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i></button></a>
     </td>
   </tr>
   <?php }?>
  </tbody>
</table>

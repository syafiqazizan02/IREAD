<table id="bootstrap-data-table1" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Student ID</th>
     <th>Student Name</th>
     <th>Student Contact</th>
     <th>View Report</th>
   </tr>
 </thead>
 <tbody>
   <?php
      include "../connection/conn.php";

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
       <a href="reportStudent.php?stud_id=<?php echo $member_id; ?>"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i></button></a>
     </td>
   </tr>
   <?php }?>
  </tbody>
</table>

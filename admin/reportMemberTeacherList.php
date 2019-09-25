<table id="bootstrap-data-table2" class="table table-striped table-bordered">
 <thead>
   <tr align="center">
     <th>Teacher ID</th>
     <th>Teacher Name</th>
     <th>Teacher Contact</th>
     <th>View</th>
   </tr>
 </thead>
 <tbody>
   <?php
   include "../connection/conn.php";

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
       <a href="reportTeacher.php?tech_id=<?php echo $member_id; ?>"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i></button></a>
     </td>
   </tr>
   <?php }?>
  </tbody>
</table>

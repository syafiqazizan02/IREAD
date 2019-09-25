<?php 
    include ('../connection/conn.php');

    function displayStaffData(){
        global $conn ;
        $sql = 'SELECT * FROM staff';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            echo '<tr>';
            echo '<td><a href="updateStaff.php?s='.$row['staff_id'].'">'.$row['staff_id'].'</a></td>';
            echo '<td><a href="updateStaff.php?s='.$row['staff_id'].'">'.$row['staff_username'].'</a></td>';
            echo '<td><a href="updateStaff.php?s='.$row['staff_id'].'">'.$row['staff_fullname'].'</a></td>';
            
            echo '<td align="center">';
            $staff_id = $row['staff_id'];
       	    include('modal_view_staff.php');
            echo '<a href="#edit'.$staff_id.'" data-toggle="modal" class="btn btn-warning btn-xs" style="color:white"><i class="fa fa-edit"></i></a>
                    <a href="manage_staff_student_list_delete.php?id=<?php echo $id; ?>&stud_id=<?php echo $staff_id; ?>" onclick="return confirm("Are you sure?");"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
                </td>';
            echo '</tr>';
            echo '</tr>';
            
        }
        $conn->close();
    }

    function viewUpdateStaffData(){
        global $conn,$row;
        $staff_id = $_GET['s'];
        $sql = 'SELECT * FROM staff WHERE staff_id='.$staff_id.'';
        $row = $conn->query($sql)->fetch_assoc();
    }

    function updateStaffData(){
        global $conn;
        if(isset($_POST['staff_username'])){
            $sql1=sprintf("UPDATE staff SET staff_username=%s,staff_password=%s,staff_fullname=%s,staff_phone=%s,staff_favq=%s WHERE staff_id=%s",
            GetSQLValueString($_POST['staff_username'],"text"),
            GetSQLValueString(md5($_POST['staff_password']),"text"),
            GetSQLValueString($_POST['staff_fullname'],"text"),
            GetSQLValueString($_POST['staff_phone'],"text"),
            GetSQLValueString($_POST['staff_favq'],"text"),
            GetSQLValueString($_POST['staff_id'],"int")    
            );
            if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Staff updated successfully');
                document.location='manageStaff.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='updateStaff.php?s=".$_POST['staff_id']."';
                </script>";
            }
        }else{
            echo "<script>alert('Data cannot empty');";
        }
        
    }
?>
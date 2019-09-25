<?php 
    include ('../connection/conn.php');

    function displayMemberData(){
        global $conn ;
        $sql = 'SELECT * FROM member';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            echo '<tr>';
            echo '<td><a href="updateMember.php?s='.$row['member_id'].'">'.$row['member_id'].'</a></td>';
            echo '<td><a href="updateMember.php?s='.$row['member_id'].'">'.$row['member_ic'].'</a></td>';
            echo '<td><a href="updateMember.php?s='.$row['member_id'].'">'.$row['member_fullname'].' '.$row['member_lastname'].'</a></td>';
            echo '<td align="center">';
            $member_id = $row['member_id'];
       	    include('modal_view_member.php');
            echo '<a href="#edit'.$member_id.'" data-toggle="modal" class="btn btn-warning btn-xs" style="color:white"><i class="fa fa-edit"></i></a>
                    <a href="manage_member_student_list_delete.php?id=<?php echo $id; ?>&stud_id=<?php echo $member_id; ?>" onclick="return confirm("Are you sure?");"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
                </td>';
            echo '</tr>';
        }
        $conn->close();
    }

    function viewUpdateMemberData(){
        global $conn,$row;
        $member_id = $_GET['s'];
        $sql = 'SELECT * FROM member WHERE member_id='.$member_id.'';
        $row = $conn->query($sql)->fetch_assoc();
    }

    function updateMemberData(){
        global $conn;
        if(isset($_POST['member_username'])){
            $sql1=sprintf("UPDATE member SET member_username=%s,member_password=%s,member_firstname=%s,member_lastname=%s,member_contact=%s,member_favQues=%s WHERE member_id=%s",
            GetSQLValueString($_POST['member_username'],"text"),
            GetSQLValueString(md5($_POST['member_password']),"text"),
            GetSQLValueString($_POST['member_firstname'],"text"),
            GetSQLValueString($_POST['member_lastname'],"text"),
            GetSQLValueString($_POST['member_contact'],"text"),
            GetSQLValueString($_POST['member_favQues'],"text"),
            GetSQLValueString($_POST['member_id'],"int")    
            );
            if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Member updated successfully');
                document.location='manageMember.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='updateMember.php?s=".$_POST['member_id']."';
                </script>";
            }
        }else{
            echo "<script>alert('Data cannot empty');";
        }
        
    }
?>
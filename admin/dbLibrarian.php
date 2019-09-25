<?php
    include ('../connection/conn.php');

    function addLibrarian(){
        global $conn,$row2,$result2;
        $condition = true;
        $sql = 'SELECT * FROM `librarian`';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            if($row['librarian_username'] == $_POST['username']){
                echo "<script>alert('User Name Duplicated! Use another...');
                document.location='addLibrarian.php';
                </script>";
                $condition = false;
                break;
            }else{
            }
        }
        $password = md5('000000');
        if($condition){
            $sql2 = "INSERT INTO `librarian` (librarian_fullname,librarian_username,librarian_password,librarian_contact,librarian_address,librarian_email,librarian_register,admin_id)
            VALUES ('".$_POST['fullname']."','".$_POST['username']."','".$password."','".$_POST['contact']."','".$_POST['address']."','".$_POST['email']."',NOW(), '".$_POST['admin_id']."')";
            if($conn->query($sql2)===TRUE)
            {
                echo "<script>alert('Librarian Added Successfully');
                document.location='manageLibrarian.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='addLibrarian.php';
                </script>";
            }
        }else{

        }
    }

    function displayLibrarianData(){
        global $conn ;
        $id;
        $sql = 'SELECT * FROM librarian';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            echo '<tr align="center">';
            echo '<td>'.$row['librarian_username'].'</td>';
            echo '<td>'.$row['librarian_fullname'].'</td>';
            if($row['librarian_status']==0){
                echo '<td><p style="font-weight:bold; color:black;">Active</p></td>';
            }else if($row['librarian_status']==1){
                echo '<td><p <p style="font-weight:bold; color:red;">Inactive</p></td>';
            }else{

            }
            echo '<td><input type="checkbox" name="librarianID[]" class="delete_book" value="'.$row['librarian_id'].'" /></td>';
            echo '<td align="center">';
            $librarian_id = $row['librarian_id'];
       	    include('modal_view_librarian.php');
            echo '<a href="#edit'.$librarian_id.'" data-toggle="modal" class="btn btn-warning btn-sm" style="color:white"><i class="fa fa-edit"></i></a>'
                    ?>
                <a href="manageLibrarianDelete.php?lib_id=<?php echo $librarian_id; ?>" onclick="return confirm('Are you sure?');"><button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                <?php
            echo '</td>';
            echo '</tr>';
        }
        $conn->close();
    }

    function viewUpdateLibrarianData(){
        global $conn,$row;
        $librarian_id = $_GET['s'];
        $sql = 'SELECT * FROM librarian WHERE librarian_id='.$librarian_id.'';
        $row = $conn->query($sql)->fetch_assoc();
    }

    function updateLibrarianData(){
        global $conn;
        if(isset($_POST['default_password'])){
            $sql1="UPDATE librarian SET librarian_password='".md5('000000')."' WHERE librarian_id=".$_POST['librarian_id']."";
            if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Reset Password Successfully');
                document.location='manageLibrarian.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='updateLibrarian.php?s=".$_POST['librarian_id']."';
                </script>";
            }
        }else{
            echo "<script>alert('Data cannot empty');";
        }

    }

    function updateLibrarianStatus(){
        global $conn;
        if(isset($_POST['librarian_status'])){
            $sql1=sprintf("UPDATE librarian SET librarian_status=%s WHERE librarian_id=%s",
            GetSQLValueString($_POST['librarian_status'],"int"),
            GetSQLValueString($_POST['librarian_id'],"int")
        );
            if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Librarian Status Updated');
                document.location='manageLibrarian.php';
                </script>";
            }else
            {
                echo 3;
                echo "<script>alert('".$conn->error."');
                document.location='manageLibrarian.php';
                </script>";
            }
        }
    }

?>

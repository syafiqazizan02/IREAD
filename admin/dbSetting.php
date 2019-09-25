<?php
    include '../connection/conn.php';

    function settingData(){
        global $conn,$row,$result;
        $sql = 'SELECT * FROM `type`';
        $result = $conn->query($sql);
    }

    function addShelf(){
        global $conn;
        $sql4 = "INSERT INTO `shelf` (shelf_no,category_id)
        VALUES ('".$_REQUEST['shelf_no']."','".$_REQUEST['category_id']."')";
            if($conn->query($sql4)===TRUE)
            {
                echo "<script>alert('Shelf Added Successfully');
                document.location='manageCategory.php';
                </script>";
            }else{
                echo "<script>alert('".$conn->error."');
                document.location='manageCategory.php';
                </script>";
            }
    }

    function displayShelf(){
        global $conn,$erow,$result3;
        $sql3 = "SELECT * FROM category JOIN shelf ON category.category_id=shelf.category_id WHERE category.category_id='".$_REQUEST['cat_id']."'";
        $result3 = $conn->query($sql3);
    }

    function displayCategoryData(){
        global $conn;
        $sql = 'SELECT * FROM `category`';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            echo '<tr align="center">';
            echo '<td>'.$row['category_code'].'</td>';
            echo '<td>'.$row['category_name'].'</td>';
            echo '<td align="center">';
            $category_id = $row['category_id'];
       	    include('modal_view_category.php');
            echo '<a href="#edit'.$category_id.'" data-toggle="modal" class="btn btn-primary btn-sm" ><i class="fa fa-info-circle"></i></a>';
            echo '</td>';
            echo '</tr>';
        }
        $conn->close();
    }

    function addCategory(){
        global $conn;
        $condition = true;
        $sql = 'SELECT * FROM `category`';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            if($row['category_code'] == $_REQUEST['category_code']){
                echo "<script>alert('Category Code Duplicated! Use another...');
                document.location='addCategory.php';
                </script>";
                $condition = false;
                break;
            }else{
            }
        }
        if($condition){
            $sql2 = "INSERT INTO `category` (category_code,category_name,admin_id)
            VALUES ('".$_REQUEST['category_code']."','".$_REQUEST['category_name']."','1')";
            if($conn->query($sql2)===TRUE)
            {
                $sql3 = "SELECT category_id FROM category WHERE category_code='".$_REQUEST['category_code']."'";
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();
                $sql4 = "INSERT INTO `shelf` (shelf_no,category_id)
                    VALUES ('".$_REQUEST['shelf_no']."','".$row3['category_id']."')";
                if($conn->query($sql4)===TRUE){
                    echo "<script>alert('Category Added successfully');
                    document.location='manageCategory.php';
                    </script>";
                }else{
                    echo "<script>alert('".$conn->error."');
                    document.location='manageCategory.php';
                    </script>";
                }
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='manageCategory.php';
                </script>";
            }
        }else{

        }
    }

    function addMemberType(){
        global $conn,$row2,$result2;
        $condition = true;
        $sql = 'SELECT * FROM `type`';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            if($row['type_name'] == $_POST['type_name']){
                echo "<script>alert('Position Name Duplicated! Use another...');
                document.location='addMemberType.php';
                </script>";
                $condition = false;
                break;
            }else{
            }
        }
        if($condition){
            $sql2 = "INSERT INTO `type` (type_name,book_limit,borrow_day,penalty_rate,admin_id)
            VALUES ('".$_POST['type_name']."','".$_POST['book_limit']."','".$_POST['borrow_day']."','".$_POST['penalty_rate']."',1)";
            if($conn->query($sql2)===TRUE)
            {
                echo "<script>alert('Position Added successfully');
                document.location='manageSetting.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='manageSetting.php';
                </script>";
            }
        }else{

        }
    }

    function updateBookLimit(){
        global $conn;
        if(isset($_GET['submit'])){
        $sql1 = sprintf('UPDATE `type` SET book_limit=%s WHERE type_name="'.$_GET['submit'].'"',
        GetSQLValueString($_GET['book_limit'],"int")
        );
        if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Setting Updated Successfully');
                document.location='manageSetting.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='manageSetting.php';
                </script>";
            }
        }
    }

    function updatePenaltyRate(){
        global $conn;
        if(isset($_GET['submit'])){
        $sql1 = sprintf('UPDATE `type` SET penalty_rate=%s WHERE type_name="'.$_GET['submit'].'"',
        GetSQLValueString($_GET['penalty_rate'],"double")
        );
        if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Setting Updated Successfully');
                document.location='manageSetting.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='manageSetting.php';
                </script>";
            }
        }
    }

    function updateBorrowDay(){
        global $conn;
        if(isset($_GET['submit'])){
        $sql1 = sprintf('UPDATE `type` SET borrow_day=%s WHERE type_name="'.$_GET['submit'].'"',
        GetSQLValueString($_GET['borrow_day'],"int")
        );
        if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Setting Updated Successfully');
                document.location='manageSetting.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='manageSetting.php';
                </script>";
            }
        }
    }

    function updateTeacherPenaltyRate(){
        global $conn;
        if(isset($_GET['penalty_rate_teacher'])){
        $sql1 = sprintf('UPDATE setting SET penalty_rate_teacher=%s WHERE 1',
        GetSQLValueString($_GET['penalty_rate_teacher'],"double")
        );
        if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Setting Updated Successfully');
                document.location='manageSetting.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='manageSetting.php';
                </script>";
            }
        }
    }

    function updateStudentPenaltyRate(){
        global $conn;
        if(isset($_GET['penalty_rate_student'])){
        $sql1 = sprintf('UPDATE setting SET penalty_rate_student=%s WHERE 1',
        GetSQLValueString($_GET['penalty_rate_student'],"double")
        );
        if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Setting Updated Successfully');
                document.location='manageSetting.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='manageSetting.php';
                </script>";
            }
        }
    }

    function updateStudentBorrowDay(){
        global $conn;
        if(isset($_GET['borrow_day_student'])){
        $sql1 = sprintf('UPDATE setting SET borrow_day_student=%s WHERE 1',
        GetSQLValueString($_GET['borrow_day_student'],"int")
        );
        if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Setting Updated Successfully');
                document.location='manageSetting.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='manageSetting.php';
                </script>";
            }
        }
    }

    function updateTeacherBorrowDay(){
        global $conn;
        if(isset($_GET['borrow_day_teacher'])){
        $sql1 = sprintf('UPDATE setting SET borrow_day_teacher=%s WHERE 1',
        GetSQLValueString($_GET['borrow_day_teacher'],"int")
        );
        if($conn->query($sql1)===TRUE)
            {
                echo "<script>alert('Setting Updated Successfully');
                document.location='manageSetting.php';
                </script>";
            }else
            {
                echo "<script>alert('".$conn->error."');
                document.location='manageSetting.php';
                </script>";
            }
        }
    }
?>

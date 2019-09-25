<?php 
    include ('../connection/conn.php');
    // $sql = 'SELECT MONTHNAME(borrow_date) FROM borrow GROUP BY MONTHNAME(borrow_date)';
    //     $result2 = $conn->query($sql);
    //     $row2 = $result2->fetch_assoc();
    //     echo $row2['MONTHNAME(borrow_date)'];
    function reportBookBorrowYear(){
        global $conn,$result;
        $sql = 'SELECT MONTHNAME(borrow_date) FROM borrow 
        JOIN `return` ON `return`.borrow_id = borrow.borrow_id
        WHERE return_status = 1
        GROUP BY MONTH(borrow_date) ORDER BY MONTH(borrow_date)';
        $result = $conn->query($sql);
    }

    function reportBookBorrowValue(){
        global $conn,$result2;
        $sql = 'SELECT COUNT(MONTH(borrow_date)) FROM borrow 
        JOIN `return` ON `return`.borrow_id = borrow.borrow_id
        WHERE return_status = 1
        GROUP BY MONTH(borrow_date) ORDER BY MONTH(borrow_date)';
        $result2 = $conn->query($sql);
    }

    function reportLibrarianRegisterYear(){
        global $conn,$result;
        $sql = 'SELECT MONTHNAME(librarian_register) FROM librarian GROUP BY MONTH(librarian_register) ORDER BY MONTH(librarian_register)';
        $result = $conn->query($sql);
    }

    function reportLibrarianRegisterValue(){
        global $conn,$result2;
        $sql = 'SELECT COUNT(MONTH(librarian_register)) FROM librarian GROUP BY MONTH(librarian_register) ORDER BY MONTH(librarian_register)';
        $result2 = $conn->query($sql);
    }

    function reportMemberRegisterYear(){
        global $conn,$result;
        $sql = 'SELECT MONTHNAME(member_register) FROM member GROUP BY MONTH(member_register) ORDER BY MONTH(member_register)';
        $result = $conn->query($sql);
    }

    function reportMemberRegisterValue(){
        global $conn,$result2;
        $sql = 'SELECT COUNT(MONTH(member_register)) FROM member GROUP BY MONTH(member_register) ORDER BY MONTH(member_register)';
        $result2 = $conn->query($sql);
    }

    function reportNewBookYear(){
        global $conn,$result;
        $sql = 'SELECT MONTHNAME(book_receive) FROM book GROUP BY MONTH(book_receive) ORDER BY MONTH(book_receive)';
        $result = $conn->query($sql);
    }

    function reportNewBookValue(){
        global $conn,$result2;
        $sql = 'SELECT COUNT(MONTH(book_receive)) FROM book GROUP BY MONTH(book_receive) ORDER BY MONTH(book_receive)';
        $result2 = $conn->query($sql);
    }
    
    function reportDamageBookYear(){
        global $conn,$result;
        $sql = 'SELECT MONTHNAME(book_damage) FROM book WHERE book_remark = 1 GROUP BY MONTH(book_damage) ORDER BY MONTH(book_damage)';
        $result = $conn->query($sql);
    }

    function reportDamageBookValue(){
        global $conn,$result2;
        $sql = 'SELECT COUNT(MONTH(book_damage)) FROM book WHERE book_remark = 1 GROUP BY MONTH(book_damage) ORDER BY MONTH(book_damage)';
        $result2 = $conn->query($sql);
    }

    function reportPenaltyChargedYear(){
        global $conn,$result;
        $sql = 'SELECT YEAR(done_date) FROM `return` 
        JOIN done ON `return`.done_id = done.done_id
        WHERE `return`.penalty_amount>0 GROUP BY `done`.done_date';
        $result = $conn->query($sql);
    }

    function reportPenaltyChargedValue(){
        global $conn,$result2;
        $sql = 'SELECT sum(penalty_amount) FROM `return` 
        JOIN done ON `return`.done_id = done.done_id
        WHERE `return`.penalty_amount>0 GROUP BY `done`.done_date';
        $result2 = $conn->query($sql);
    }
?>

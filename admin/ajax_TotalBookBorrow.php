<?php
    include ('../connection/conn.php');
    $sql1 = 'SELECT MONTHNAME(borrow_date) as a FROM borrow
    JOIN `return` ON `return`.borrow_id = borrow.borrow_id
    WHERE return_status = 1 AND YEAR(borrow_date) = '.$_REQUEST["year"].'
    GROUP BY MONTH(borrow_date) ORDER BY MONTH(borrow_date)';
    $result1 = $conn->query($sql1);

    $sql2 = 'SELECT COUNT(MONTH(borrow_date)) as b FROM borrow
    JOIN `return` ON `return`.borrow_id = borrow.borrow_id
    WHERE return_status = 1 AND YEAR(borrow_date) = '.$_REQUEST["year"].'
    GROUP BY MONTH(borrow_date) ORDER BY MONTH(borrow_date)';
    $result2 = $conn->query($sql2);
        $data->type= 'line';
        $data->defaultFontFamily= 'Montserrat';
        $data->datasets->label= "Book";
        $data->datasets->backgroundColor= 'transparent';
        $data->datasets->borderColor= 'rgba(40,167,69,0.75)';
        $data->datasets->borderWidth= 3;
        $data->datasets->pointStyle= 'circle';
        $data->datasets->pointRadius= 5;
        $data->datasets->pointBorderColor= 'transparent';
        $data->datasets->pointBackgroundColor= 'rgba(40,167,69,0.75)';
        $data->labels = array();
        while($row=$result1->fetch_assoc()){
            array_push($data->labels,$row['a']);
        }

        $data->datasets->data = array();
        while($row=$result2->fetch_assoc()){
            array_push($data->datasets->data,(int)$row['b']);
        }
        // $data->labels = $result1->fetch_array();
        // $data->datasets->data = $result2->fetch_assoc();;

        // $data->labels = $result1->fetch_all(MYSQLI_ASSOC);
        // $data->datasets->data = $result2->fetch_all(MYSQLI_ASSOC);;
    echo json_encode($data);
?>

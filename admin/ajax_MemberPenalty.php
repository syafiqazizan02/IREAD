<?php
    require_once('../connection/conn.php');
    $sql1 = 'SELECT MONTHNAME(done_date) as a FROM `return`
    JOIN done ON `return`.done_id = done.done_id
    WHERE `return`.penalty_amount>0 AND member_id = '.$_REQUEST["member_id"].' AND YEAR(done_date) = '.$_REQUEST["year"].'
    GROUP BY MONTH(done_date)
    ORDER BY MONTH(done_date)';
    $result1 = $conn->query($sql1);

    $sql2 = 'SELECT FORMAT(sum(penalty_amount),2) as b FROM `return`
    JOIN done ON `return`.done_id = done.done_id
    WHERE `return`.penalty_amount>0 AND member_id = '.$_REQUEST["member_id"].' AND YEAR(done_date) = '.$_REQUEST["year"].'
    GROUP BY MONTH(done_date)
    ORDER BY MONTH(done_date)';
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
            array_push($data->datasets->data,(double)$row['b']);
        }
        // $data->labels = $result1->fetch_array();
        // $data->datasets->data = $result2->fetch_assoc();;

        // $data->labels = $result1->fetch_all(MYSQLI_ASSOC);
        // $data->datasets->data = $result2->fetch_all(MYSQLI_ASSOC);;
    echo json_encode($data);
?>

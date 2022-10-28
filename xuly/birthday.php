<?php
    include_once('../connect.php'); 
    $output = '';
    $stmt = "select * from Personal";
    $sql_select = sqlsrv_query($connsqlsv,$stmt);
    while($rows = sqlsrv_fetch_array($sql_select)){
        // $today = date("m-d");
        // $birthday = $rows['Birthday']->format("m-d");
        // var_dump($today); var_dump($birthday);var_dump($today === $birthday); exit();
        
        if(intval(date("d")) == intval($rows['Birthday']->format("d")) && intval(date("m")) == intval($rows['Birthday']->format("m"))){
            $output .='
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">'.$rows['First_Name']." ".$rows['Last_Name'].'</h6>
                            <small><img src="./images/detail.png" alt=""></small>
                        </div>
                    </div>
                </div>
            ';
        }
    }
    echo $output;
?>
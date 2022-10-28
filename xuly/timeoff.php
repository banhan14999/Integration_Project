<?php
    include_once('../connect.php');
        $output = '';
        $stmt = "SELECT * from EMPLOYMENT_WORKING_TIME inner join Personal on EMPLOYMENT_WORKING_TIME.EMPLOYMENT_ID = Personal.Employee_ID order by TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH DESC";
        
        $sql_select = sqlsrv_query($connsqlsv,$stmt);
            while($rows = sqlsrv_fetch_array($sql_select)){
                if(intval($rows['MONTH_WORKING']) == intval(date("m")) && intval($rows['YEAR_WORKING']) == intval(date('Y')) ){
                    if(intval($rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH']) >= 7){
                        $output .= '
                        <div class="d-flex align-items-center border-bottom py-3" style="background-color: red" >
                                <img class="rounded-circle flex-shrink-0" src="images/cheems.jpeg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3" >
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">'.$rows['First_Name'] ." ". $rows['Last_Name'].'</h6>                     
                                        </div>
                                        <span>Vacation days: '.$rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'].'</span>
                                </div>
                                
                            </div>
                        ';
                    }
                    else if((int)$rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH']>=4){
                        $output .= '
                        <div class="d-flex align-items-center border-bottom py-3" style="background-color: yellow">
                            <img class="rounded-circle flex-shrink-0" src="images/cheems.jpeg" alt="" style="width: 40px; height: 40px;">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">'.$rows['First_Name'] ." ". $rows['Last_Name'].'</h6>                                  
                                </div>
                                <span>Vacation days: '.$rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'].'</span>
                            </div>
                        </div>
                        '; 
                    }
                }              
            }
        echo $output;
?>
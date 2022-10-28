<?php
    include_once('../../connect.php');
    if(isset($_POST['vacation_type'])){
        //echo $_POST['vacation_type'];
        $output = "";       
        if($_POST['vacation_type'] === "Shareholder_Status"){  
            //query
            $stmt = "SELECT * FROM (EMPLOYMENT_WORKING_TIME INNER JOIN Personal ON Personal.Employee_ID = EMPLOYMENT_WORKING_TIME.EMPLOYMENT_ID)";
            $sql_select = sqlsrv_query($connsqlsv,$stmt);  
            //end query      
            $last_year_1 = 0; $last_year_2=0;
            while($rows = sqlsrv_fetch_array($sql_select)){
                if(intval(date("Y"))-1 == $rows['YEAR_WORKING']){
                    if($rows['Shareholder_Status'] == 1){
                        $last_year_1 += $rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                    }
                    else{
                        $last_year_2 += $rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                    }
                }               
            }
            $output .= '
                            <div class="col-sm-6 col-xl-4">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                                    <div class="ms-3">
                                        <p class="mb-2">Shareholder</p>
                                        <h6 class="mb-0">'.$last_year_1.' Days</h6>
                                    </div>
                                </div>
                            </div>
                        ';
            $output .= '
                <div class="col-sm-6 col-xl-4">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-line fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Non Shareholder</p>
                            <h6 class="mb-0">'.$last_year_2.' Days</h6>
                        </div>
                    </div>
                </div>
            ';
            echo $output;
        }
        else if($_POST['vacation_type'] === "Gender"){
            //query
            $stmt = "SELECT * FROM (EMPLOYMENT_WORKING_TIME INNER JOIN Personal ON Personal.Employee_ID = EMPLOYMENT_WORKING_TIME.EMPLOYMENT_ID)";
            $sql_select = sqlsrv_query($connsqlsv,$stmt);
            //end query
            $last_year_1 = 0; $last_year_2=0;
            while($rows = sqlsrv_fetch_array($sql_select)){
                if(intval(date("Y"))-1 == $rows['YEAR_WORKING']){
                    if($rows['Gender'] == 1){
                        $last_year_1 += $rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                    }
                    else{
                        $last_year_2 += $rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                    }
                }          
            }
            $output .= '
                            <div class="col-sm-6 col-xl-4">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                                    <div class="ms-3">
                                        <p class="mb-2">Male</p>
                                        <h6 class="mb-0">'.$last_year_1.' Days</h6>
                                    </div>
                                </div>
                            </div>
                        ';
            $output .= '
                <div class="col-sm-6 col-xl-4">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-line fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Female</p>
                            <h6 class="mb-0">'.$last_year_2.' Days</h6>
                        </div>
                    </div>
                </div>
            ';
            echo $output;
        }
        else if($_POST['vacation_type'] === "Ethnicity"){
            $output = '';
            //query
            $stmt = "SELECT * FROM (EMPLOYMENT_WORKING_TIME INNER JOIN Personal ON Personal.Employee_ID = EMPLOYMENT_WORKING_TIME.EMPLOYMENT_ID)";
            $sql_select = sqlsrv_query($connsqlsv,$stmt);
            //end query          
            $ethnicities = array();
            while($rows =  sqlsrv_fetch_array($sql_select)){
                if(intval(date("Y"))-1 == $rows['YEAR_WORKING']){
                    $ethnicity = $rows['Ethnicity'];
                    //Kiểm tra có key dân tốc đó trong mảng chưa
                    if(array_key_exists($ethnicity,$ethnicities)){
                        $ethnicities[$ethnicity] = $ethnicities[$ethnicity] + $rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                    }
                    else{
                        $ethnicities[$ethnicity] = $rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                    }
                }
            }
            //Lấy hết key
            $keys = array_keys($ethnicities);
            for($i=0; $i<sizeof($ethnicities); $i++){
                $output.='
                <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">'.$keys[$i].'</p>
                        <h6 class="mb-0">'.$ethnicities[$keys[$i]].' Days</h6>
                    </div>
                </div>
            </div>
                ';
            }
            echo $output;
        }
        else if($_POST['vacation_type'] === "Employee_Status"){
            $output = '';
            //query
            $stmt = "SELECT * from ((EMPLOYMENT_WORKING_TIME inner join Personal on EMPLOYMENT_WORKING_TIME.EMPLOYMENT_ID = Personal.Employee_ID) inner join Employment on EMPLOYMENT_WORKING_TIME.EMPLOYMENT_ID = Employment.Employee_ID) order by EMPLOYMENT_WORKING_TIME.EMPLOYMENT_ID";
            $sql_select = sqlsrv_query($connsqlsv,$stmt);
            //end query          
            $employees = array();
            while($rows =  sqlsrv_fetch_array($sql_select)){
                $employee = $rows['Employment_Status'];
                //Kiểm tra có key đó trong mảng chưa
                if(intval(date("Y"))-1 == $rows['YEAR_WORKING']){
                if(array_key_exists($employee,$employees)){
                    $employees[$employee] = $employees[$employee] + $rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                }
                else{
                    $employees[$employee] = $rows['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                }
                }
            }
            //Lấy hết key
            $keys = array_keys($employees);
            for($i=0; $i<sizeof($employees); $i++){
                $output.='
                <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">'.$keys[$i].'</p>
                        <h6 class="mb-0">'.$employees[$keys[$i]].' Days</h6>
                    </div>
                </div>
            </div>
                ';
            }
            echo $output;
        }
        else if($_POST['vacation_type'] === "Department"){

        }
    }
?>
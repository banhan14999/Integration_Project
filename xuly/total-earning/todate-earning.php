<?php
    include_once('../../connect.php');
    if(isset($_POST['total_type'])){
        //echo $_POST['total_type'];
        $output = "";       
        if($_POST['total_type'] === "Shareholder_Status"){  
            //query
            $stmt = "SELECT * FROM (Personal INNER JOIN Employment ON Personal.Employee_ID = Employment.Employee_ID)";
            $sql_select = sqlsrv_query($connsqlsv,$stmt);  
            //end query      
            $to_date_1 = 0; $to_date_2=0;
            while($rows = sqlsrv_fetch_array($sql_select)){
                $id = $rows['Employee_ID'];
                if($rows['Shareholder_Status'] == 1){
                    $mysql_select = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from employee where `Employee Number`=$id"));
                    $to_date_1 += $mysql_select['Paid To Date'];
                }
                else{
                    $mysql_select = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from employee where `Employee Number`=$id"));
                    $to_date_2 += $mysql_select['Paid To Date'];
                }
            }
            $output .= '
                            <div class="col-sm-6 col-xl-4">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                                    <div class="ms-3">
                                        <p class="mb-2">Shareholder</p>
                                        <h6 class="mb-0">$'.$to_date_1.'</h6>
                                    </div>
                                </div>
                            </div>
                        ';
            $output .= '
                <div class="col-sm-6 col-xl-4">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-area fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Non Shareholder</p>
                            <h6 class="mb-0">$'.$to_date_2.'</h6>
                        </div>
                    </div>
                </div>
            ';
            echo $output;
        }
        else if($_POST['total_type'] === "Gender"){
            //query
            $stmt = "SELECT * FROM (Personal INNER JOIN Employment ON Personal.Employee_ID = Employment.Employee_ID)";
            $sql_select = sqlsrv_query($connsqlsv,$stmt);
            //end query
            $to_date_1 = 0; $to_date_2=0;
            while($rows = sqlsrv_fetch_array($sql_select)){
                $id = $rows['Employee_ID'];
                if($rows['Gender'] == 1){
                    $mysql_select = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from employee where `Employee Number`=$id"));
                    $to_date_1 += $mysql_select['Paid To Date'];
                }
                else{
                    $mysql_select = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from employee where `Employee Number`=$id"));
                    $to_date_2 += $mysql_select['Paid To Date'];
                }
            }
            $output .= '
                            <div class="col-sm-6 col-xl-4">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                                    <div class="ms-3">
                                        <p class="mb-2">Male</p>
                                        <h6 class="mb-0">$'.$to_date_1.'</h6>
                                    </div>
                                </div>
                            </div>
                        ';
            $output .= '
                <div class="col-sm-6 col-xl-4">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-area fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Female</p>
                            <h6 class="mb-0">$'.$to_date_2.'</h6>
                        </div>
                    </div>
                </div>
            ';
            echo $output;
        }
        else if($_POST['total_type'] === "Ethnicity"){
            $output = '';
            //query
            $stmt = "SELECT * from Personal";
            $sql_select = sqlsrv_query($connsqlsv,$stmt);
            //end query          
            $ethnicities = array();
            while($rows =  sqlsrv_fetch_array($sql_select)){
                $id = $rows['Employee_ID'];
                $ethnicity = $rows['Ethnicity'];
                $mysql_select = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from employee where `Employee Number`=$id"));
                //Kiểm tra có key dân tốc đó trong mảng chưa
                if(array_key_exists($ethnicity,$ethnicities)){
                    $ethnicities[$ethnicity] = $ethnicities[$ethnicity] + $mysql_select['Paid To Date'];
                }
                else{
                    $ethnicities[$ethnicity] = $mysql_select['Paid To Date'];
                }
            }
            //Lấy hết key
            $keys = array_keys($ethnicities);
            for($i=0; $i<sizeof($ethnicities); $i++){
                $output.='
                <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">'.$keys[$i].'</p>
                        <h6 class="mb-0">$'.$ethnicities[$keys[$i]].'</h6>
                    </div>
                </div>
            </div>
                ';
            }
            echo $output;
        }
        else if($_POST['total_type'] === "Employee_Status"){
            $output = '';
            //query
            $stmt = "SELECT * from Employment inner join Personal on Employment.Employee_ID = Personal.Employee_ID";
            $sql_select = sqlsrv_query($connsqlsv,$stmt);
            //end query          
            $employees = array();
            while($rows =  sqlsrv_fetch_array($sql_select)){
                $id = $rows['Employee_ID'];
                $employee = $rows['Employment_Status'];
                $mysql_select = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from employee where `Employee Number`=$id"));
                //Kiểm tra có key đó trong mảng chưa
                if(array_key_exists($employee,$employees)){
                    $employees[$employee] = $employees[$employee] + $mysql_select['Paid To Date'];
                }
                else{
                    $employees[$employee] = $mysql_select['Paid To Date'];
                }
            }
            //Lấy hết key
            $keys = array_keys($employees);
            for($i=0; $i<sizeof($employees); $i++){
                $output.='
                <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">'.$keys[$i].'</p>
                        <h6 class="mb-0">$'.$employees[$keys[$i]].'</h6>
                    </div>
                </div>
            </div>
                ';
            }
            echo $output;
        }
        else if($_POST['total_type'] === "Department"){

        }
    }

   
?>
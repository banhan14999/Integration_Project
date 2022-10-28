<?php
    include_once('../connect.php'); 
        $output = '';
        $stmt = "select * from Employment  inner join Personal on Employment.Employee_ID = Personal.Employee_ID";
        $sql_select = sqlsrv_query($connsqlsv,$stmt);
        $output .= '
        
        <div class="table-responsive"> 
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Employee</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Hire Date</th>
                        <th scope="col">Pay Rate</th>
                        <th scope="col">Value</th>
                        <th scope="col">Tax</th>
                        <th scope="col">Pay Amount</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
        ';
            while($rows = sqlsrv_fetch_array($sql_select)){                
                $row_mysql_1 = mysqli_fetch_assoc(mysqli_query($connmysql,"Select * from employee where employee.idEmployee=".$rows['Employee_ID']));
                $row_mysql_2 = mysqli_fetch_assoc(mysqli_query($connmysql,"Select * from payroll.`pay rates` where `idPay Rates` = ".$row_mysql_1['Pay Rates_idPay Rates']));
                $hire_date = $rows['Hire_Date'];                        
                    $gender = "";
                    if($rows['Gender']==0) $gender = "Nữ"; else $gender= "Nam";
                    $output .='                    
                     <tr>
                            <input type="hidden" class="form-control" name="idEmployee" value="'.$rows['Employee_ID'].'">
                            <td>'.$rows['First_Name'] ." ". $rows['Last_Name'].'</td>
                            <td>'.$rows['Address1'].'</td>
                            <td>'.$rows['City'].'</td>
                            <td>'.$rows['Phone_Number'].'</td>
                            <td>'.$gender.'</td>
                            <td>'.$hire_date->format('d-m-Y').'</td>
                            <td>'.$row_mysql_1['Pay Rate'].'</td>
                            <td>'.$row_mysql_2['Value'].'</td>
                            <td>'.$row_mysql_2['Tax Percentage'].'%</td>
                            <td>'.number_format((double)$row_mysql_2['Pay Amount']).'</td>
                         <td>
                             <a class="" href="./update-employee.php?id='.$rows['Employee_ID'].'"><img src="./images/edit.png" alt="" title="Edit"/></a>
                             <a class="" href="./employee-function.php?function=delete&id='.$rows['Employee_ID'].'"><img src="./images/delete.png" alt="" title="Delete"/></a>
                         </td>
                     </tr>
                 ';           
            }
        $output .='
            </tbody></table></div>
        ';
        echo $output;
?>
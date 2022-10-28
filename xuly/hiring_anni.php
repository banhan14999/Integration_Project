<?php
    include_once('../connect.php');
        $d=0;    
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
                        <th scope="col">Phone Number</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Hiring Day</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
        ';
            while($rows = sqlsrv_fetch_array($sql_select)){                             
                //get day and month current
                $date = new DateTime();
                date_timezone_set($date, timezone_open('Asia/Ho_Chi_Minh'));
                //getdate in db
                $hire_date = $rows['Hire_Date'];                        
                //compare
                if( intval(date("d")) == intval($hire_date->format("d")) && intval(date("m") == intval($hire_date->format("m")) ) ){
                    $gender = "";
                    if($rows['Gender']==0) $gender = "Nữ"; else $gender= "Nam";
                    $output .='
                     <tr>
                         <td>'.$rows['First_Name'] ." ". $rows['Last_Name'].'</td>
                            <td>'.$rows['Address1'].'</td>
                            <td>'.$rows['City'].'</td>
                            <td>'.$rows['Phone_Number'].'</td>
                            <td>'.$gender.'</td>
                            <td>'.$hire_date->format('d-m-Y').'</td>
                         <td>
                             <a class="" href="#"><img src="./images/detail.png" alt="" title="Details"/></a>
                             
                         </td>
                     </tr>
                 ';
                 $d++;
                }
            }
            if($d==0){
                $output .= '
                <tr>
                    <td colspan = "7">Hôm nay không có anniversary của ai cả</td>
                </tr>
            ';
            }
            else{
                $d=0;
            }

        $output .='
            </tbody></table></div>
        ';
        echo $output;
?>
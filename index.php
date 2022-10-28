<?php
    include_once('./connect.php');
    session_start();
    if(!isset($_SESSION['account'])){
        header("Location: signin.php");
    }
    else{
        // $stmt = "select * from employee";
        // $sql_select = mysqli_query($connmysql,$stmt);
        //Total earning default
            //To date
            $stmt = "select * from Personal";
            $sql_select = sqlsrv_query($connsqlsv,$stmt);
            //create variable
            $to_date_1=0; $to_date_2=0; $last_year_1=0; $last_year_2=0;
            $soluong_shareholder = 0; $soluong_nonshareholder = 0;
            //end create variable
            while($rows = sqlsrv_fetch_array($sql_select)){
                $id = $rows['Employee_ID'];
                if($rows['Shareholder_Status'] == 1){
                    $mysql_select = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from employee where `Employee Number`=$id"));
                    $to_date_1 += $mysql_select['Paid To Date'];
                    $last_year_1 += $mysql_select['Paid Last Year'];
                    $soluong_shareholder++;
                }
                else{
                    $mysql_select = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from employee where `Employee Number`=$id"));
                    $to_date_2 += $mysql_select['Paid To Date'];
                    $last_year_2 += $mysql_select['Paid Last Year'];
                    $soluong_nonshareholder++;
                }
            }
            //Last year
        // End total earning default
        
        //Total number of vacation days default
            //sql
            $stmt_vacation = "SELECT * FROM (EMPLOYMENT_WORKING_TIME INNER JOIN Personal ON Personal.Employee_ID = EMPLOYMENT_WORKING_TIME.EMPLOYMENT_ID)";
            $sql_select_vacation = sqlsrv_query($connsqlsv,$stmt_vacation);
            //end sql
            //create variable
            $to_date_vacation_1 = 0 ; $to_date_vacation_2 =0; $last_year_vacation_1 =0 ; $last_year_vacation_2=0;
            //end create variable
            //To date - last year
            while($rows_vacation = sqlsrv_fetch_array($sql_select_vacation)){
                if($rows_vacation['Shareholder_Status'] == 1){
                    $to_date_vacation_1 += $rows_vacation['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                }
                else{
                    $to_date_vacation_2 += $rows_vacation['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                }
                if(intval(date("Y"))-1 == $rows_vacation['YEAR_WORKING']){
                    if($rows_vacation['Shareholder_Status'] == 1){
                        $last_year_vacation_1 += $rows_vacation['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                    }
                    else{
                        $last_year_vacation_2 += $rows_vacation['TOTAL_NUMBER_VACATION_WORKING_DAYS_PER_MONTH'];
                    }
                }   
            }

        
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include '_sidebar.php' ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include '_nav.php' ?>
            <!-- Navbar End -->


            <!-- Total Earning -->
                <div class="container-fluid pt-4 px-4" >
                <div class=" text-center rounded p-4" style="background-color: #ced4da">
                    <div class="d-flex align-items-center justify-content-between mb-4" >
                            <h6 class="mb-0">Total Earning</h6>
                            <!-- <a href="">Show All</a> -->
                            
                            <div class="col-sm-2">
                                <select class="form-control selcls" name="TotalEarning" id = "TotalEarning" onchange="onchangeTotalEarning()" >
                                    <option value="Shareholder_Status" selected>Shareholder</option>
                                    <option value="Gender" >Gender</option>
                                    <option value="Ethnicity" >Ethnicity</option>
                                    <option value="Employee_Status" >Employee</option>
                                    <!-- <option value="Department" >Department</option> -->
                                    
                                </select>                    
                            </div>
                        
                    </div> 
                    <!-- <p id="demo1"></p>        -->
                    <div class="row g-4" id="total_todate">      
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-area fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Shareholder</p>
                                    <h6 class="mb-0">$<?php echo $to_date_1 ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-area fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Non Shareholder</p>
                                    <h6 class="mb-0">$<?php echo $to_date_2 ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center justify-content-between mb-4" >
                            <h6 class="mb-0">Previous Year</h6>                        
                    </div>
                    <div class="row g-4" id="total_previous">   
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-area fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Shareholder</p>
                                    <h6 class="mb-0">$<?php echo $last_year_1 ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-area fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Shareholder</p>
                                    <h6 class="mb-0">$<?php echo $last_year_2 ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            
            <!-- Total earning End -->



            <!-- Total number of vacation days -->
            <div class="container-fluid pt-4 px-4" >
            <div class=" text-center rounded p-4" style="background-color: #ced4da">
                <div class="d-flex align-items-center justify-content-between mb-4" >
                        <h6 class="mb-0">Total Number of Vacation Days</h6>
                        <!-- <a href="">Show All</a> -->
                        <div class="col-sm-2">
                                <select class="form-control selcls" name="vacation_type" id = "vacation_type" onchange="onchangeVacation()" >
                                    <option value="Shareholder_Status" selected>Shareholder</option>
                                    <option value="Gender" >Gender</option>
                                    <option value="Ethnicity" >Ethnicity</option>
                                    <option value="Employee_Status" >Employee</option>
                                    <!-- <option value="Department" >Department</option> -->
                                    
                                </select>                    
                            </div>
                </div>

                <div class="row g-4" id="vacation_todate">
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Shareholder</p>
                                <h6 class="mb-0"><?php echo $to_date_vacation_1 ?> Days</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Non Shareholder</p>
                                <h6 class="mb-0"><?php echo $to_date_vacation_2 ?> Days</h6>
                            </div>
                        </div>
                    </div>     
                </div>
                <hr>
                <div class="d-flex align-items-center justify-content-between mb-4" >
                        <h6 class="mb-0">Previous Year</h6>                        
                </div>
                <div class="row g-4" id="vacation_lastyear">
                <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Non Shareholder</p>
                                <h6 class="mb-0"><?php echo $last_year_vacation_1 ?> Days</h6>
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Non Shareholder</p>
                                <h6 class="mb-0"><?php echo $last_year_vacation_2 ?> Days</h6>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            </div>
            <!-- Total number of vacation days End -->
            <!-- Average Benefit-->
            <div class="container-fluid pt-4 px-4" >
            <div class=" text-center rounded p-4" style="background-color: #ced4da">
                <div class="d-flex align-items-center justify-content-between mb-4" >
                        <h6 class="mb-0">Average Benefit</h6>
                        <!-- <a href="">Show All</a> -->
                </div>               
                <div class="row g-4" >
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2" style="font-weight: bold;">Shareholders</p>
                                <h6 class="mb-0">$<?php if($soluong_shareholder!=0) echo round($to_date_1/$soluong_shareholder); else echo 0; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                            <p class="mb-2" style="font-weight: bold;">Non-Shareholders</p>
                                <h6 class="mb-0">$<?php if($soluong_nonshareholder!=0) echo round($to_date_2/$soluong_nonshareholder); else echo 0; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex align-items-center justify-content-between mb-4" >
                        <h6 class="mb-0">Previous Year</h6>                        
                </div>
                <div class="row g-4" >
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2" style="font-weight: bold;">Shareholders</p>
                                <h6 class="mb-0">$<?php  if($soluong_shareholder!=0) echo round($last_year_1/$soluong_shareholder); else echo 0; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                            <p class="mb-2" style="font-weight: bold;">Non-Shareholders</p>
                                <h6 class="mb-0">$<?php if($soluong_nonshareholder!=0) echo round($last_year_2/$soluong_nonshareholder); else echo 0; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- Average Benefit End -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Today Hiring Anniversary</h6>
                        <a href="#">Show All</a>
                    </div>
                    <div id="table-hiring">

                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Benefit change -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Benefit Change</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="images/cheems.jpeg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="images/cheems.jpeg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="images/cheems.jpeg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-3">
                                <img class="rounded-circle flex-shrink-0" src="images/cheems.jpeg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- End Benefit change -->
                <!-- Employee Birthday -->
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Today Employees' Birthday</h6>
                                <a href="./list_birthday.php">Show All</a>
                            </div>
                            <div id="birthday">

                            </div>
                        </div>
                    </div>
            <!-- End Employee birthday -->
            <!-- Unpaid timeofff -->
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Unpaid Timeoff</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="unpaid-timeoff">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Unpaid timeofff End -->


            <!-- Footer Start -->
            <?php include '_footer.php' ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- function Javascript -->
    <script type="text/javascript">
        
        // Load du lieu total earning

        // Load du lieu total vacation

        // Load du lieu Average benefit

        // Load du lieu Hiring Anniversary
        
        $(document).ready(function(){
            function fetch_data_hiring(){
                $.ajax({
                    url : "./xuly/hiring_anni.php",
                    method: "POST",
                    success:function(data){
                        //alert("Tajo barng thnagf coong");
                        $('#table-hiring').html(data);
                        //fetch_data_hiring();
                    }
                });
            }
            fetch_data_hiring();
        // Load du~ lieu benefit change

        // Load du~ lieu Employee birthday
            function fetch_data_birthday(){
                $.ajax({
                    url : "./xuly/birthday.php",
                    method : "POST",
                    success:function(data){
                        $('#birthday').html(data);
                    }
                });
            };
            fetch_data_birthday();
        // Load du~ lieu unpaid timeoff
            function fetch_data_timeoff(){
                $.ajax({
                    url : "./xuly/timeoff.php",
                    method: "POST",
                    success:function(data){
                        $('#unpaid-timeoff').html(data);
                    }
                });
            }
            fetch_data_timeoff();
        
        });
        function onchangeTotalEarning(){
            total_type = document.getElementById("TotalEarning").value;
            //  document.getElementById("total_todate").innerHTML = total_type;
            //  document.getElementById("total_previous").innerHTML = total_type;
             //
             //document.getElementById("total_todate").innerHTML = total_type();
             $.ajax({
                url : "./xuly/total-earning/todate-earning.php",
                method : "POST",
                data: {total_type : total_type},
                success:function(data){
                    //alert("Thay doi lua chon thanh cong")
                    $('#total_todate').html(data);
                }
             });
             $.ajax({
                url : "./xuly/total-earning/lastyear-earning.php",
                method : "POST",
                data: {total_type : total_type},
                success:function(data){
                    //alert("Thay doi lua chon thanh cong2 ")
                    $('#total_previous').html(data);
                }
             });
        }
        function onchangeVacation(){
            vacation_type = document.getElementById("vacation_type").value;
            $.ajax({
                url : "./xuly/total-vacation/todate-vacation.php",
                method : "POST",
                data: {vacation_type : vacation_type},
                success:function(data){
                    //alert("Thay doi lua chon thanh cong")
                    $('#vacation_todate').html(data);
                }
             });
             $.ajax({
                url : "./xuly/total-vacation/lastyear-vacation.php",
                method : "POST",
                data: {vacation_type : vacation_type},
                success:function(data){
                    //alert("Thay doi lua chon thanh cong2 ")
                    $('#vacation_lastyear').html(data);
                }
             });
        }
        
    </script>
    <!-- End function js -->
</body>
</html>
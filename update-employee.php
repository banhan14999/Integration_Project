<?php
    include_once ("./connect.php");
    session_start();
    $payrates = mysqli_query($connmysql,"Select * from payroll.`pay rates`");
    $d=0;
    $employee = sqlsrv_fetch_array(sqlsrv_query($connsqlsv,"SELECT * from Personal INNER JOIN Employment ON Personal.Employee_ID = Employment.Employee_ID where Personal.Employee_ID =".$_GET['id']));
    $employee_mysql = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from employee where `Employee Number`=".$_GET['id']));
    $payrateName = mysqli_fetch_array(mysqli_query($connmysql,"SELECT * from `pay rates` where `idPay Rates`=".$employee_mysql['Pay Rates_idPay Rates']))['Pay Rate Name'];
    $benefit_plan = sqlsrv_fetch_array(sqlsrv_query($connsqlsv,"SELECT * from Benefit_Plans"));
    // var_dump($payrateName);exit();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Employee</title>
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

            <div class="container-fluid pt-4  ">
                <h1>Update Employee</h1>
                <form action="./employee-function.php?function=update" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        
                        <input type="hidden" class="form-control" name="ID" value="<?php echo $employee['Employee_ID'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">First Name</label>
                        <input type="text" class="form-control" name="FirstName" value="<?php echo $employee['First_Name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Last Name</label>
                        <input type="text" class="form-control" name="LastName" placeholder="" value="<?php echo $employee['Last_Name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Birthday</label>
                        <input type="date" class="form-control" name="Birthday" placeholder="" value="<?php echo date_format($employee['Birthday'],"Y-m-d"); ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Middle Initial</label>
                        <input type="text" class="form-control" name="Middle" placeholder="" value="<?php if($employee['Middle_Initial'] == null) echo ""; else echo $employee['Middle_Initial'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Address 1</label>
                        <input type="text" class="form-control" name="Address1" placeholder="" value="<?php echo $employee['Address1'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Address 2</label>
                        <input type="text" class="form-control" name="Address2" placeholder="" value="<?php if($employee['Address2'] == null) echo ""; else echo $employee['Address2'] ?>">
                    </div>
                                        
                    <div class="form-group">
                        <label for="exampleFormControlInput1">City</label>
                        <input type="text" class="form-control" name="City" placeholder="" value="<?php echo $employee['City'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">State</label>
                        <input type="text" class="form-control" name="State" placeholder="" value="<?php if($employee['State'] == null) echo ""; else echo $employee['State'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Zip</label>
                        <input type="numeric" class="form-control" name="Zip" placeholder="" value="<?php if($employee['Zip'] == null) echo ""; else echo $employee['Zip'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" name="Email" value="<?php echo $employee['Email'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Phone</label>
                        <input type="text" class="form-control" name="Phone" placeholder="" value="<?php echo $employee['Phone_Number'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Social Security Number</label>
                        <input type="text" class="form-control" name="Social" placeholder="" value="<?php if($employee['Social_Security_Number'] == null) echo ""; else echo $employee['Social_Security_Number'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Drivers License</label>
                        <input type="text" class="form-control" name="Driver" placeholder="" value="<?php if($employee['Drivers_License'] == null) echo ""; else echo $employee['Drivers_License'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Marital Status</label>
                        <input type="text" class="form-control" name="Marital" placeholder="" value="<?php if($employee['Marital_Status'] == null) echo ""; else echo $employee['Marital_Status'] ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Gender</label>
                        <select class="form-select" aria-label="Default select example" name="Gender">
                            <option value="<?php echo $employee['Gender'] ?>" selected><?php if($employee['Gender']==0) echo "Female"; else echo "Male" ?></option>
                            <option value="<?php if($employee['Gender']==0) echo 1; else echo 0  ?>"><?php if($employee['Gender']==0) echo "Male"; else echo "Female" ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Shareholder</label>
                        <select class="form-select" aria-label="Default select example" name="shareholder_status">
                            <option value="<?php echo $employee['Shareholder_Status'] ?>" selected><?php if($employee['Shareholder_Status']==0) echo "Non Shareholder"; else echo "Shareholder" ?></option>
                            <option value="<?php if($employee['Shareholder_Status']==0) echo 1; else echo 0  ?>"><?php if($employee['Shareholder_Status']==0) echo "Shareholder"; else echo "Non Shareholder" ?></option>
                        </select>
                    </div>         
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Benefit Plans</label>
                        <select class="form-select" aria-label="Default select example" name="Benefit_plan">
                            <option value="1" selected><?php echo $benefit_plan['Plan_Name'] ?></option>
                        </select>
                    </div>           
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Ethnicity</label>
                        <select class="form-select" aria-label="Default select example" name="Ethnicity">
                            <option value="<?php echo $employee['Ethnicity'] ?>" selected><?php if($employee['Ethnicity']==='Kinh') echo "Kinh"; else echo "Others" ?></option>
                            <option value="<?php if($employee['Ethnicity']==='Kinh') echo 'Others'; else echo 'Kinh'  ?>"><?php if($employee['Ethnicity']==='Kinh') echo "Others"; else echo "Kinh" ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Employment Status</label>
                        <select class="form-select" aria-label="Default select example" name="Employment_status">
                            <option value="<?php echo $employee['Employment_Status'] ?>" selected><?php if($employee['Employment_Status']==='Part time') echo "Part time"; else echo "Full time" ?></option>
                            <option value="<?php if($employee['Employment_Status']==='Part time') echo 'Full time'; else echo 'Part time'  ?>"><?php if($employee['Employment_Status']==='Part time') echo "Full time"; else echo "Part time" ?></option>
                        </select>
                    </div>         
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Workers Com Code</label>
                        <input type="text" class="form-control" name="Wcc" placeholder=""  value="<?php if($employee['Workers_Comp_Code'] == null) echo ""; else echo $employee['Workers_Comp_Code'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Termination Date</label>
                        <input type="date" class="form-control" name="Ter" placeholder="" required value="<?php if($employee['Termination_Date'] == null) echo ""; else echo $employee['Termination_Date']->format('Y-m-d') ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Rehire Date</label>
                        <input type="date" class="form-control" name="Rehire" placeholder="" required value="<?php if($employee['Rehire_Date'] == null) echo ""; else echo $employee['Rehire_Date']->format('Y-m-d') ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Last Review Date</label>
                        <input type="date" class="form-control" name="Review" placeholder="" required value="<?php if($employee['Last_Review_Date'] == null) echo ""; else echo $employee['Last_Review_Date']->format('Y-m-d');  ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">SSN</label>
                        <input type="numeric" class="form-control" name="SSN" value="<?php echo $employee_mysql['SSN'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Pay Rate</label>
                        <input type="numeric" class="form-control" name="PayRate" value="<?php echo $employee_mysql['Pay Rate'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Pay Type</label>
                        <select class="form-select" aria-label="Default select example" name="PayRates">
                        <option value="<?php echo $employee_mysql['Pay Rates_idPay Rates'] ?>" selected><?php echo $payrateName; ?></option>
                            <?php while($item = mysqli_fetch_array($payrates)){ 
                                if($item['idPay Rates']!=$employee_mysql['Pay Rates_idPay Rates']){ ?>
                                <option value="<?php echo $item['idPay Rates'] ?>"><?php echo $item['Pay Rate Name']; ?></option>

                            <?php    }}?>                                                        
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Paid To Date</label>
                        <input type="numeric" class="form-control" name="Paidtodate" value="<?php echo $employee_mysql['Paid To Date'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Paid Last Year</label>
                        <input type="numeric" class="form-control" name="Paidlastyear" value="<?php echo $employee_mysql['Paid Last Year'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><img src="./images/update.png" alt=""> &nbsp;Update</button>
                    </div>
                </form>
                
            </div>



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
        // $(document).ready(function(){
        //     function loadDataEmployees(){
        //         $.ajax({
        //             url : "./xuly/employees.php",
        //             method: "POST",
        //             success:function(data){
        //                 $('#employee-management').html(data);
        //             }
        //         });
        //     }
        //     loadDataEmployees();
        // });
    </script>
    <!-- End function js -->
</body>
</html>
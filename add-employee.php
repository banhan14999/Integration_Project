<?php
    include_once ("./connect.php");
    session_start();
    $payrates = mysqli_query($connmysql,"Select * from payroll.`pay rates`");
    $d=0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ADD NEW EMPLOYEE</title>
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
                <h1>Add new Employee</h1>
                <form action="./employee-function.php?function=add" enctype="multipart/form-data" method="post" id="form">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Employee ID</label>
                        <input type="number" class="form-control" name="ID" placeholder="" id="employeeId">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">First Name</label>
                        <span id="err_name"></span>
                        <input type="text" class="form-control" name="FirstName" placeholder="" id="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Last Name</label>
                        <span id="err_lastname"></span>
                        <input type="text" class="form-control" name="LastName" placeholder="" id="lastname">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Birthday</label>
                        <span id="err_date"></span>
                        <input type="date" class="form-control" name="Birthday" placeholder="" id="date">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <span id="err_email"></span>
                        <input type="email" class="form-control" name="Email" placeholder="name@example.com" id="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Address</label>
                        <span id="err_address"></span>
                        <input type="text" class="form-control" name="Address" placeholder="" id="address">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">City</label>
                        <span id="err_city"></span>
                        <input type="text" class="form-control" name="City" placeholder="" id="city">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Phone</label>
                        <span id="err_phone"></span>
                        <input type="text" class="form-control" name="Phone" placeholder="" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Gender</label>
                        <select class="form-select" aria-label="Default select example" name="Gender">
                            <option value="1" selected>Male</option>
                            <option value="0">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Shareholder</label>
                        <select class="form-select" aria-label="Default select example" name="shareholder_status">
                            <option value="0" selected>Non Shareholder</option>                            
                            <option value="1">Shareholder</option>                           
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Ethnicity</label>
                        <select class="form-select" aria-label="Default select example" name="ethnicity">
                            <option value="Kinh" selected>Kinh</option>                            
                            <option value="Others">Others</option>
                        </select>
                    </div>    
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Employment Status</label>
                        <select class="form-select" aria-label="Default select example" name="employee_status">
                            <option value="Part time" selected>Part time</option>                            
                            <option value="Full time">Full time</option>                           
                        </select>
                    </div>                 
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Hire Date</label>
                        <span id="err_date"></span>
                        <input type="date" class="form-control" name="HireDate" placeholder="" id="date">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Pay Rate</label>
                        <span id="err_pay"></span>
                        <input type="numeric" class="form-control" name="PayRate" placeholder="" id="payrate">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Pay Type</label>
                        <select class="form-select" aria-label="Default select example" name="PayRates" id="paytype">
                            <?php while($item = mysqli_fetch_array($payrates)){ 
                                if($d==0){ ?>
                                <option value="<?php echo $item['idPay Rates'] ?>" selected><?php echo $item['Pay Rate Name']; ?></option>
                            <?php  $d++;}
                                else{ ?>
                                <option value="<?php echo $item['idPay Rates'] ?>" ><?php echo $item['Pay Rate Name']; ?></option>
                            <?php    }?>
                                
                            <?php }  ?>
                          
                        </select>
                    </div> 
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><img src="./images/add.png" alt=""> &nbsp;Add</button>
                    </div>
                </form>
                
            </div>

            <!-- Employee management -->
            <!-- <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div id="employee-management">

                    </div>
                </div>
            </div> -->
            <!-- End Employee management -->


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
    <script src="js/validate_employee.js"></script>
</body>
</html>
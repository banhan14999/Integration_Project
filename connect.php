<?php
    // Connect to Sql Server
    $serverName = "BANHANN\sqlexpress02";
    $connectionInfo = array("Database"=>"HR", "CharacterSet"=>"UTF-8");
    $connsqlsv = sqlsrv_connect($serverName,$connectionInfo);
    if(!$connsqlsv){
        echo "Failed to connect to SQL Server";
        die(print_r(sqlsrv_errors(),true));
    }
    // else{
    //     echo "Connect successfully <br/>";
    // }
    // Connect to MySql
    $serverName2 = 'localhost';
    $port = 3360;
    $user = 'root';
    $pass = '1234';
    $db = 'Payroll';
    $connmysql = mysqli_connect($serverName2,$user,$pass,$db,$port);
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }

    $serverName3 = 'localhost';
    $db_1 = 'account';
    $conn_account = mysqli_connect($serverName3,$user,$pass,$db_1,$port);
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
?>
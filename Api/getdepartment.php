<?php
    include '../includes/config.php';

    
    error_reporting(0);
    header('Access-Control-Allow-Origin:');
    header('Content_Type: Application/json');
    header('Access-Control-Allow-Method: GET');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization, X-Request-With');

    
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    //ADD EMPLOYEE

    if($requestMethod == "GET")  
    {
        $query = "Select * from department1";
        $result = mysqli_query($conn, $query);
        $departments = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data = [
            'status' => 200,
            'message' => "Department fetched succesfully",
            'data' => $departments
        ];
        header("HTTP/1.0 200 ok");
        echo json_encode($data);
    }
?>
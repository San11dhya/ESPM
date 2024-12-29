<?php
    include '../includes/config.php';

    
    error_reporting(0);
    header('Access-Control-Allow-Origin:');
    header('Content_Type: Application/json');
    header('Access-Control-Allow-Method: GET');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization, X-Request-With');

    
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    
    
    //GET EMPLOYEES
    if($requestMethod == "GET")
    {
        $query = "SELECT e.employee_id, e.name, e.email, e.designation, d.name FROM employee e JOIN department1 d ON e.department_id = d.department_id";
        $result = mysqli_query ($conn,$query);
        $employees = [];

        while($row = mysqli_fetch_assoc($result))
        {
            $employee_id = $row['employee_id'];
            $query1 = "SELECT review_date, score, comments FROM reviews WHERE employee_id = $employee_id";
            $result1 = mysqli_query($conn,$query1);
            $row['reviews'] = mysqli_fetch_all($result1,MYSQLI_ASSOC);
            $employees[] = $row;
        }
        echo json_encode($employees);
    }
    else
    {
        $data = [
            'status' => 405,
            'message' => $requestMethod . " Method not allowed"
        ];
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode($data);
    }


?>
<?php
    include '../includes/config.php';

    
    error_reporting(0);
    header('Access-Control-Allow-Origin:');
    header('Content_Type: Application/json');
    header('Access-Control-Allow-Method: DELETE');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization, X-Request-With');

    
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if($requestMethod == "DELETE")
    {
        $employee_id = $_GET['employee_id'];
        $query = "Delete from employee where employee_id = $employee_id";
        $result = mysqli_query($conn, $query);
        if($result)
        {
            $data = [
                'status' => '200',
                'message' => "Employee deleted successfully."
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        }
        else
        {
            $data = [
                'status' => 404,
                'message' => "No Employee found"
            ];
            header("HTTP/1.0 404 Not Found");
            echo json_encode($data);
        }

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
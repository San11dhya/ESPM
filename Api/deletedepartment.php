<?php
    include '../includes/config.php';

    
    error_reporting(0);
    header('Access-Control-Allow-Origin:');
    header('Content_Type: Application/json');
    header('Access-Control-Allow-Method: DELETE');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization, X-Request-With');

    
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    //DELETE EMPLOYEE

    if($requestMethod == "DELETE")  
    {
        $department_id = $_GET['department_id'];
        $query = "DELETE FROM department1 WHERE department_id = $department_id";
        $result = mysqli_query($conn, $query);
        if($result)
        {
            $data = [
                'status' => 200,
                'message' => "Department deleted successfully."
            ];
            header("HTTP/1.0 200 OK");
        echo json_encode($data);
        }
        else
        {
            $data = [
                'status' => 500,
                'message' => "Failed to delete department."
            ];
            header("HTTP/1.0 500 Failed to delete department.");
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
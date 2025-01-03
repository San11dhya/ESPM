<?php
    include '../includes/config.php';

    
    error_reporting(0);
    header('Access-Control-Allow-Origin:');
    header('Content_Type: Application/json');
    header('Access-Control-Allow-Method: POST');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization, X-Request-With');

    
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    //ADD EMPLOYEE

    if($requestMethod == "POST")  
    {
    $inputData = json_decode(file_get_contents("php://input"),true);
    $name = $inputData['name'];
    $query = "INSERT INTO department1 (name) VALUES ('$name')";
    //$result1=mysqli_query($conn,$unique);
    $result = mysqli_query($conn, $query);
    if($result)
    {
            $data = [
                'status' => 200,
                'message' => "Department added successfully."
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
    }
        else{
            $data = [
                'status' => 500,
                'message' => "Failed to add department"
            ];
            header("HTTP/1.0 500 Internal Server Error");
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
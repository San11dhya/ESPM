<?php
    include '../includes/config.php';

    
    error_reporting(0);
    header('Access-Control-Allow-Origin:');
    header('Content_Type: Application/json');
    header('Access-Control-Allow-Method: POST');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization, X-Request-With');

    
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    //ADD EMPLOYEE

    if($requestMethod == "POST")   {
        $inputData = json_decode(file_get_contents("php://input"),true);
        $name = $inputData['name'];
        $email = $inputData['email'];
        $designation = $inputData['designation'];
        $department_id = $inputData['department_id'];
        $unique="SELECT * from  employee where email='$email'";
        $result1=mysqli_query($conn,$unique);
        // echo $result1;die;
        if(mysqli_num_rows(($result1))>0)
        {
            $data=[
                'status'=>404,
                'message'=>'The email already exist.try different email.'
            ];
            header ("HTTP/1.0 404 Not Found");
            echo json_encode($data);
            exit;
        }

        $query = "Select * from department1 where department_id = $department_id";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) === 0 )
        {
            $data = [
                'status' => 404,
                'message' => 'Invalid department'
            ];
            header ("HTTP/1.0 404 Not Found");
            echo json_encode($data);
        }

        $query = "Insert into employee (name,email,designation,department_id) values ('$name','$email','$designation','$department_id')";
        $result = mysqli_query($conn, $query);
        if($result)
        {
            $data = [
                'status' => 201,
                'message' => "created"
            ];
            header("HTTP/1.0 201 created");
            echo json_encode($data);
        }
        else{
            $data = [
                'status' => 500,
                'message' => "Internal Server Error"
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

    
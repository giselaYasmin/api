<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'database.php';
    include_once 'class/Department.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Department($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->departmentid = $data->departmentid;
    
    // pet values
    $item->name = $data->name;
    $item->description = $data->description;

    $response= array("message" => "Department Modified");
    
    if($item->updateDepartment()){
        http_response_code(200);
        echo json_encode($response);
    } else{
        http_response_code(400);
        echo json_encode("Department could not be updated");
    }
?>
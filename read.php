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

    $items = new Department($db);

    $stmt = $items->getDepartments();
    $itemCount = $stmt->rowCount();


    if($itemCount > 0){                
        //pets array
         $departments_arr=array();
        
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $department_item=array(
                "departmentid" => $departmentid,
                "name" => $name,
                "description" => $description
            );
    
            array_push($departments_arr, $department_item);
            
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($departments_arr);
}

?>
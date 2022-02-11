<?php


class Department{

    // Connection
    private $conn;

    // Table
    private $db_table = "departments";

    // Columns
    public $departmentid;
    public $name;
    public $description;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
    public function getDepartments(){
        $sqlQuery = "SELECT departmentid, name, description FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createDepartment(){
        $sqlQuery = "INSERT INTO
                    ". $this->db_table ."
                SET
                    name = :name,  
                    description = :description";
        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // READ single
    public function getSingleDepartment(){
        $sqlQuery = "SELECT
                    departmentid, 
                    name,  
                    description
                FROM
                    ". $this->db_table ."
                WHERE 
                departmentid = ?";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->departmentid);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->name = $dataRow['name'];        
        $this->description = $dataRow['description'];
        
    }        

    // UPDATE
    public function updateDepartment(){
        $sqlQuery = "UPDATE
                    ". $this->db_table ."
                SET
                    name = :name,  
                    description = :description
                WHERE 
                departmentid = :departmentid";

        $stmt = $this->conn->prepare($sqlQuery);

       // sanitize
       $this->name=htmlspecialchars(strip_tags($this->name));
       $this->description=htmlspecialchars(strip_tags($this->description));
        $this->departmentid=htmlspecialchars(strip_tags($this->departmentid));

 
         // bind data
         $stmt->bindParam(":departmentid", $this->departmentid);
         $stmt->bindParam(":name", $this->name);
         $stmt->bindParam(":description", $this->description);
 

        if($stmt->execute()){
        return true;
        }
        return false;
    }

    

}
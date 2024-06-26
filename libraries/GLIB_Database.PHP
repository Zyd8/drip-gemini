<?php   
    
    class database {
        public $dbhost;
        public $dbuser;
        public $dbpassword;
        public $dbname;
        public $dbport;
        public $con;

    //THIS WILL CREATE AN INSTANCE OF DATABASE
    public function __construct() {
        $this->dbhost = $_SESSION["dbhost"];
        $this->dbuser = $_SESSION["dbusername"];
        $this->dbpassword = $_SESSION["dbpassword"];
        $this->dbname = $_SESSION["dbname"];
        $this->dbport = $_SESSION["dbport"];

        // Connect to MySQL server without specifying the database
        $this->con = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, "", $this->dbport);

        // Check connection
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }

        // Create the database if it doesn't exist
        $this->createDatabaseIfNotExists();

        // Now connect to the specified database
        $this->con->select_db($this->dbname);

        // Create necessary tables
        $this->create_users_table("users");
        $this->create_closet_table("closet");

        // Uncomment when favorite functionality is being developed
        // $this->create_favorite_table("favorite");
        

        // Check connection again after selecting the database
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }

    // CREATE USERS TABLE IF NOT EXISTS
    private function create_users_table($tablename) {
        $query = "CREATE TABLE IF NOT EXISTS $tablename (
            ID VARCHAR(11),
            username VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
        $result = $this->con->query($query);
    
        // PRINTS ONLY WHEN THERE IS AN ERROR
        if (!$result) {
            echo "Error creating table: " . $this->con->error;
        } 
    }

    // CREATE CLOSET TABLE IF NOT EXISTS
    private function create_closet_table($tablename) {
        $query = "CREATE TABLE IF NOT EXISTS $tablename (
            ID VARCHAR(11),
            user_id VARCHAR(11),
            `path` VARCHAR(100),
            file_name VARCHAR(255)
        )";
        $result = $this->con->query($query);
    
        if (!$result) {
            echo "Error creating table: " . $this->con->error;
        }
    }

    // CREATE FAVORITE TABLE IF NOT EXISTS
    private function create_favorite_table($tablename) {
        $query = "CREATE TABLE IF NOT EXISTS $tablename (
            ID VARCHAR(11),
            JSON_string VARCHAR(255) NOT NULL,
            prompt VARCHAR(255) NOT NULL,
        )";
        $result = $this->con->query($query);

        if (!$result) {
            echo "Error creating table: " . $this->con->error;
        }
    }
    

    private function createDatabaseIfNotExists() {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        if (!$this->con->query($sql) === TRUE) {
            die("Error creating database: " . $this->con->error);
        }
    }


    // GET ALL COLUMN DATA SPECIFIC ONLY TO A USER
    public function getUserData($tablename, $columnname, $user_id) {
        $query = "SELECT $columnname FROM $tablename WHERE user_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row[$columnname];
        }

        $stmt->close();
        return $data;
    }


        //ADD A ROW IN THE SPECIFIC DATABASE
        public function data_create ($tablename, $data) {
            //$str = $this->addslash($value);
            $columns = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_fill(0, count($data), '?'));

            $query = "INSERT INTO $tablename ($columns) VALUES ($placeholders)";
            $stmt = $this->con->prepare($query);

            $values = array_values($data);

            $types = str_repeat('s', count($values)); // Assuming all data are strings. Adjust as necessary.

            $stmt->bind_param($types, ...$values);
            $stmt->execute();
            $stmt->close();
        }

        //READ SPECIFIC DATA BASE ON USERS CHOICE
        public function data_read ($select, $tablename, $condition) {
            //$str = $this->addslash($value);
            //mysqli_real_escape_string($con, $_GET['search'])
            $query = "SELECT $select FROM $tablename WHERE $condition";
            $result = $this->con->query($query);
            $datas = [];
            while($row = $result->fetch_assoc()){
                $datas [] = $row;
            }
            $result->free();
            return $datas;
        }

        //READ ALL OF THE DATA BASE ON USERS CHOICE
        public function data_read_all ($tablename) {
            //$str = $this->addslash($value);
            $query = "SELECT * FROM $tablename";
            $result = $this->con->query($query);
            $datas = [];
            while($row = $result->fetch_assoc()){
                $datas [] = $row;
            }
            $result->free();
            return $datas;
        }

        //UPDATE SPECIFIC USER DATA
        public function data_update ($tablename, $columnname, $condition) {
            //$str = $this->addslash($value);
            $query = "UPDATE $tablename SET $columnname WHERE $condition";
            $this->con->query($query);
        }
        
        //UPDATE SPECIFIC USER DATA
        public function data_update_all ($tablename, $columnname) {
            //$str = $this->addslash($value);
            $query = "UPDATE $tablename SET $columnname";
            $this->con->query($query);
        }

        //DROP OR DELETE A ROW IN A SPECIFIC TABLE
        public function data_delete ($tablename, $condition) {
            //$str = $this->addslash($value);
            $query = "DELETE FROM $tablename WHERE $condition";
            $this->con->query($query);
        }

        //DROP OR DELETE ALL OF THE ROW IN A SPECIFIC TABLE
        public function data_delete_all ($tablename) {
            //$str = $this->addslash($value);
            $query = "DELETE FROM $tablename";
            $this->con->query($query);
        }

        //END OR CLOSE THE DATABASE
        public function data_end () {
            $this->con->close();
        }

        //TO CONVERT STRING WITH SLASHES INTO A NORMAL STRING
        public function addslash ($val){
            $str = $val;
            return addslashes($str);
        }

        //TEST FUNCTION - TO ECHO SOMETHING
        public static function show ($show) {
            echo $show;
        }

        //TEST FUNCTION - TO ECHO SOMETHING
        public function show2 ($show) {
            echo $show;
        }

    }

?>
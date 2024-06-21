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

            $this->con = new \mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname, $this->dbport);

            if ($this->con->connect_error) {
                die("Connection failed: " . $this->con->connect_error);
            }
        }

        //ADD A ROW IN THE SPECIFIC DATABASE
        public function data_create ($tablename, $data) {
            //$str = $this->addslash($value);
            $columns = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_fill(0, count($data), '?'));

            $query = "INSERT INTO $tablename ($columns) VALUES ($placeholders)";
            $stmt = $this->con->prepare($query);

            $types = str_repeat('s', count($data)); // Assuming all data are strings. Adjust as necessary.
            $values = array_values($data);
            
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
        public function data_read_all ($select, $tablename) {
            //$str = $this->addslash($value);
            $query = "SELECT $select FROM $tablename";
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
<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/18
 * Time: 9:41
 */
include "dbconfig.php";

class dbInterface
{
    private static $instance = NULL;
    private $dbConn;
    private $projectsList = 'projects';
    private $logFields = "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, log_date TIMESTAMP, log_data LONGTEXT NOT NULL";
    private $projectsListFields = "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, proj_name VARCHAR(30) NOT NULL";

    private function __construct() {

        try {
            $this->dbConn = new PDO("mysql:host=". DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASSWD);
            $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            die();
        }
        $this->assertTable($this->projectsList, $this->projectsListFields);
    }

    private function assertTable ($name, $fields) {
        $stmt = "CREATE TABLE IF NOT EXISTS " . $name . " ( " . $fields . " ) CHARACTER SET utf8 COLLATE utf8_unicode_ci";
        $query = $this->dbConn->prepare($stmt);
        $query->execute();
    }

    public static function getInstance() {
        static $instance = null;
        if (self::$instance === null){
            $instance = new dbinterface();
        }
        return $instance;
    }

    public function makeLog($table, $data) {
        $this->assertTable($table, $this->logFields);

        $stmt = "INSERT INTO " . $table . " (log_data) VALUES (:data)";

        $query = $this->dbConn->prepare($stmt);
        $query->bindParam(':data',$data );

        $query->execute();
    }

    public function pullLog($table) {
        $this->assertTable($table, $this->logFields);

        $query = $this->dbConn->prepare("SELECT log_date, log_data FROM " . $table);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);

        $result = $query->fetchAll();
        return $result;
    }

    public function makeProject($project) {
        $this->assertTable($this->projectsList, $this->projectsListFields);

        $stmt = "INSERT INTO " . $this->projectsList . " (proj_name) VALUES (:data)";

        $query = $this->dbConn->prepare($stmt);
        $query->bindParam(':data', $project);
        $query->execute();

        $this->assertTable($project, $this->logFields);
    }

    public function killProject($project) {
        $this->assertTable($this->projectsList, $this->projectsListFields);

        $stmt = "DROP TABLE " . $project;

        $query = $this->dbConn->prepare($stmt);
        $query->execute();

        $stmt = "DELETE FROM " . $this->projectsList . " WHERE proj_name=:project";

        $query = $this->dbConn->prepare($stmt);
        $query->bindParam(':project', $project);
        $query->execute();
    }

    public function pullProjects() {
        $this->assertTable($this->projectsList, $this->projectsListFields);

        $query = $this->dbConn->prepare("SELECT proj_name FROM " . $this->projectsList);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);

        $result = $query->fetchAll();
        return $result;
    }

}
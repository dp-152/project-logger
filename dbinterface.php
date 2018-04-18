<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/18
 * Time: 9:41
 */

class dbInterface
{
    private static $instance = NULL;
    private $dbConn;
    private $table = 'logtable';

    private function __construct() {
        $dbServer = "***REMOVED***";
        $dbUser = "***REMOVED***";
        $dbPasswd = "***REMOVED***";
        $dbName = "***REMOVED***";
        try {
            $this->dbConn = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUser, $dbPasswd);
            $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->assertTable();
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public static function getInstance() {
        static $instance = null;
        if (self::$instance === null){
            $instance = new dbinterface();
        }
        return $instance;
    }

    private function assertTable () {
        $stmt = "CREATE TABLE IF NOT EXISTS " . $this->table . " (
              id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              log_date TIMESTAMP,
              log_data LONGTEXT NOT NULL) 
              CHARACTER SET utf8
              COLLATE utf8_unicode_ci ";
        $query = $this->dbConn->prepare($stmt);
        $query->execute();
    }

    public function logData($data) {
        $stmt = "INSERT INTO " . $this->table . " (log_data) VALUES (:data)";

        $query = $this->dbConn->prepare($stmt);
        $query->bindParam(':data',$data );

        $query->execute();
    }

    public function logHistory() {
        $query = $this->dbConn->prepare("SELECT log_date, log_data FROM " . $this->table);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);

        $result = $query->fetchAll();
        return $result;
    }

}
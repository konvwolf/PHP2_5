<?php
include_once('config/config.php');

class C_DataBase {
    private $db;
    function __construct() {
        try {
            $connect_str = DRIVER . ':host='. SITE . ';dbname=' . DATABASE;
            $this->db = new PDO($connect_str, ADMIN, PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        catch(PDOException $error) {
	        die("Error: ".$error->getMessage());
        }
    }

    function selectFromDB($colName, $tableName, $extQuery = null) {
        $select = 'SELECT '.$colName.' FROM '.$tableName;
        if ($extQuery !== null) {
            $select .= ' '.$extQuery;
        }
        $query = $this->db->query($select);
        // $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateDB($tableName, $colName, $data) {
        $query = $this->db->prepare('UPDATE :table SET :column = :data');
        $query->execute([':table' => $tableName, ':column' => $colName, ':data' => $data]);
    }

    function insertIntoDB($tableName, $colName, $data) {
        $insert = 'INSERT INTO '.$tableName.' ('.$colName.') VALUES ('.$data.')';
        return $this->db->exec($insert);
    }

    function deleteFromTable($tableName, $colName, $data) {
        $query = $this->db->prepare('DELETE FROM :table WHERE :column = :data');
        $query->execute([':table' => $tableName, ':column' => $colName, ':data' => $data]);
    }
}
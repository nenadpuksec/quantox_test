<?php
    require __DIR__ . '../../vendor/autoload.php';

    class Student
    {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getStudent($id)
        {
            $pdo = new PDO('mysql:host=localhost;dbname=quantox','root','',array(PDO::ATTR_PERSISTENT => true));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getAllStudents()
        {
            $pdo = new PDO('mysql:host=localhost;dbname=quantox','root','',array(PDO::ATTR_PERSISTENT => true));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $pdo->prepare("SELECT * FROM students");
            $sth->execute();
            $row = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
    }
?>

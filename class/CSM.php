<?php
    require __DIR__ . '../../vendor/autoload.php';

    class CSM
    {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getCSMoardResult($student_id)
        {
            $grades = array();
            $br = 0;
            $sr = 0;
            $s = 0;

            $pdo = new PDO('mysql:host=localhost;dbname=quantox','root','',array(PDO::ATTR_PERSISTENT => true));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("SELECT s.name, g.grade FROM students as s INNER JOIN grades as g ON s.id = g.student_id WHERE s.id=?");
            $stmt->execute([$student_id]);
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($grades, $row['grade']);
                $name = $row['name'];
                $s += $row['grade'];
                $br++;
            }

            $sr = $s / $br;
            $result = $sr >= '7' ? 'Pass' : 'Fail';
            $response = array(
                'name' =>  $name,
                'grades' => $grades,
                'average' => $sr,
                'result' => $result
            );
            return json_encode($response);
        }

    }
?>
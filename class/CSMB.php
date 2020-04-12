<?php
    require __DIR__ . '../../vendor/autoload.php';

    class CSMB
    {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getCSMBoardResult($student_id)
        {
            $grades = array();
            $br = 0;
            $sr = 0;
            $s = 0;
            $service = new Sabre\Xml\Service();

            $pdo = new PDO('mysql:host=localhost;dbname=quantox','root','',array(PDO::ATTR_PERSISTENT => true));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT s.name, g.grade FROM students as s INNER JOIN grades as g ON s.id = g.student_id WHERE s.id=? ORDER BY g.grade");
            $stmt->execute([$student_id]);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($grades, $row['grade']);
                $name = $row['name'];
                $s += $row['grade'];
                $br++;
            }

            $number = count($grades);
            $grade_check =  $number > 1 ? array_shift($grades) : $grades;
            $result = end($grades) >= 8 ? 'Pass' : 'Fail';
            $sr = $s / $br;

            return $service->write('{http://example.org/}CSMB', [
                '{http://example.org/ns}student_name' => $name,
                '{http://example.org/ns}grades' => $grades,
                '{http://example.org/ns}average' => $sr,
                '{http://example.org/ns}result' => $result,
            ]);
        }

    }
?>
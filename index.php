<?php
require_once 'class/Database.php';
require_once  'class/Student.php';
require_once  'class/CSM.php';
require_once  'class/CSMB.php';

$db = new Database();
$student = new Student($db);
$csm = new CSM($db);
$csmb = new CSMB($db);

    if(isset($_GET['student']))
        $student_id = $_GET['student'];

    $all = $student->getAllStudents();

    if(isset($_GET['student']))
    {
        $dohvati = $student->getStudent($student_id);
        $board_type_id = $dohvati['school_board_id'];

        if($board_type_id == '1')
        {
            $result = $csm->getCSMoardResult($student_id);
            echo $result;

            $data = json_decode($result);
            $id = $_GET['student'];
            echo "<table class='table table-dark'>
            <thead>
                <tr>
                <th scope='col'>No.</th>
                <th scope='col'>Student name</th>
                <th scope='col'>Grades</th>
                <th scope='col'>Average</th>
                <th scope='col'>Result</th>
                </tr>
            </thead>
            <tbody>";
                echo "<tr>";
                    echo "<th scope='row'>".$id."</th>";
                    echo "<td>".$data->name."</td>";
                    echo "<td>";
                    $allGrades = $data->grades;
                    foreach($allGrades as $grade) 
                    {
                        echo "(".$grade.") ";
                    }
                    echo "<td>".$data->average."</td>";
                    echo "<td>".$data->result."</td>"; 
                echo "</tr>";
            echo "</tbody>
            </table>";
        }
        else
        {
            $result = $csmb->getCSMBoardResult($student_id);
            echo $result;
        }
    }
    
?>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>School board</title>
</head>
<body>
<div>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">No.</th>
        <th scope="col">Student name</th>
        <th scope="col">Board type</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach ($all as $key=>$value) 
        {
            $board = $value['school_board_id'];
            $board == 1 ? $board = "CSM" : $board = "CSMB";
            $id = intval($key + 1);
            echo "<tr><th scope='row'>".$id."</th><td><a href='http://localhost/quantox/index.php?student=".$id."'>".$value['name']."</a></td><td>".$board."<td/></tr>";
        }
    ?>
    </tbody>
    </table>
</div>
</body>
</html>


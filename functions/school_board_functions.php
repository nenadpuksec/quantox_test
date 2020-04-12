<?php
require_once '../class/Database.php';
require_once '../class/Registration.php';

if(isset($_REQUEST['function']) && $_REQUEST['function'] == 'registration')
{
    registraion();
}

function registraion()
{
    $name = $_POST['name'];
    $board_type_id = $_POST['board_type_id'];
    $ret = new StdClass();

    $database = new Database();

    $registration = new Registration($database);

    $flag = $registration->register($name, $board_type_id);

    if($flag)
    {
        $ret->message = "Successfully";
    }
    else
    {
        $ret->message = "Error";
    }

    echo json_encode($ret);
    exit();
}
?>

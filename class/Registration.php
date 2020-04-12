<?php

class Registration
{
    /**
     * @var PDO
     */
    private $conn;

    public function __construct($database)
    {
        $this->conn = $database;
    }

    public function register($name, $board_type_id)
    {
        $response = true;
        $conn  = new PDO('mysql:host=localhost;dbname=quantox','root','',array(PDO::ATTR_PERSISTENT => true));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO students ( name, school_board_id) VALUES ( '$name' , $board_type_id )");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":school_board_id", $board_type_id);

        $stmt->execute();

        return $response;
    }
}

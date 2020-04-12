<?php

class Database
{
    /**
     * @var PDO
     */
    private $conn;

    public function __construct()
    {
        try
        {
            $this->conn  = new PDO('mysql:host=localhost;port=3306;dbname=quantox','root','',array(PDO::ATTR_PERSISTENT => true));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
           die();
        }

        return $this->conn;
    }
}

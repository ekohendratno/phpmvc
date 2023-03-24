<?php

class Database
{
    private $dbhost = DB_HOST;
    private $dbuser = DB_USER;
    private $dbpass = DB_PASS;
    private $dbname = DB_NAME;


    private $handle;
    private $statement;

    public function __construct()
    {

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $dsn = 'mysql:host='.$this->dbhost.';dbname='.$this->dbname;
        try {
            $this->handle = new PDO($dsn, $this->dbuser, $this->dbpass, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function query($query)
    {

        $this->statement = $this->handle->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {

        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param,$value,$type);
    }

    public function execute(){
        $this->statement->execute();
    }

    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }


    public function result(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resultCount(){
        $this->execute();
        return $this->statement->rowCount();
    }

}

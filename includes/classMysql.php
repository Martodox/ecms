<?php

class classMysql
{

    private $connection;
    private $prepareQuery;
    private $charset = "utf8";
    private $return = true;

    private function __construct()
    {

        $host = config_MySql_host;
        $dbname = config_MySql_dbname;
        $username = config_MySql_username;
        $password = config_MySql_password;
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$this->charset", '' . $username . '', '' . $password . '');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            Help::printer($ex);
        }
    }

    public static function instance()
    {
        return new classMysql();
    }

    public static function create($query)
    {
        $instance = new classMysql();
        $instance->prepare($query);
        return $instance;
    }

    public function bind($value, $name, $type = "str")
    {
        $type = self::getDataType($type);

        $value = stripslashes(htmlspecialchars($value));
        $this->prepareQuery->bindParam(':' . $name, $value, $type);
        return $this;
    }

    public static function simpleQuery($query = null, $forceReturn = false)
    {
        $instance = new classMysql();
        $instance->checkReturn($query);
        $zapytanie = $instance->connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        try {
            $zapytanie->execute();
        } catch (Exception $ex) {
            echo "<pre>$ex</pre>";
        }

        if ($instance->return || $forceReturn) {
            return $zapytanie->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function lastId()
    {
        return $this->connection->lastInsertId();
    }

    public static function getDbname()
    {

        return config_MySql_dbname;
    }

    private function checkReturn($query = null)
    {
        $query = explode(" ", $query);
        $sqlCommands = array('delete', 'insert', 'replace', 'update', 'create');
        if (!in_array(strtolower($query[0]), $sqlCommands)) {
            $this->return = true;
        } else {
            $this->return = false;
        }
    }

    private function prepare($query)
    {
        $this->checkReturn($query);
        $this->prepareQuery = null;
        $this->prepareQuery = $this->connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    }

    public function execute()
    {
        try {
            $this->prepareQuery->execute();
            if ($this->return) {
                return $this->prepareQuery->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $this;
            }
        } catch (PDOException $ex) {
            echo $ex;
        }

        return $this;
    }

    private static function getDataType($short)
    {
        $return = "";
        switch ($short) {
            case 'bool':
                $return = 'PDO::PARAM_BOOL';
            case 'null':
                $return = 'PDO::PARAM_NULL';
            case 'int':
                $return = 'PDO::PARAM_INT';
            case 'lob':
                $return = 'PDO::PARAM_LOB';
            case 'str':
            default:
                $return = 'PDO::PARAM_STR';
        }

        return intval($return);
    }

}

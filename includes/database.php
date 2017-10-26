<?php
require_once(LIB_PATH_INC . DS . "config.php");

class MySqli_DB
{

    private $connection;
    public $query_id;

    function __construct()
    {
        $this->db_connect();
    }

    public function db_connect()
    {
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
        if (!$this->connection) {
            die(" Database connection failed:" . mysqli_connect_error());
        } else {
            $select_db = $this->connection->select_db(DB_NAME);
            if (!$select_db) {
                die("Failed to Select Database" . mysqli_connect_error());
            }
        }
    }

    public function db_disconnect()
    {
        if (isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function run_query($sql)
    {
        if (trim($sql != "")) {
            $this->query_id = $this->connection->query($sql);
        }

        if (!$this->query_id) {
            die("Error on this query :<pre> " . $sql . "</pre>");
        }

        return $this->query_id;
    }

    public function fetch_array($statement)
    {
        return mysqli_fetch_array($statement);
    }

    public function fetch_object($statement)
    {
        return mysqli_fetch_object($statement);
    }

    public function fetch_associative_array($statement)
    {
        return mysqli_fetch_assoc($statement);
    }

    public function num_rows($statement)
    {
        return mysqli_num_rows($statement);
    }

    public function insert_id()
    {
        return mysqli_insert_id($this->connection);
    }

    public function affected_rows()
    {
        return mysqli_affected_rows($this->connection);
    }

    public function get_escape_string($str)
    {
        return $this->connection->real_escape_string($str);
    }

    public function while_loop($loop)
    {
        global $db;
        $results = array();
        while ($result = $this->fetch_array($loop)) {
            $results[] = $result;
        }
        return $results;
    }

}

$db = new MySqli_DB();

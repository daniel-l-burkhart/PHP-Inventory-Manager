<?php
require_once(LIB_PATH_INC . DS . "config.php");

class MySqli_DB
{

    private $connection;
    public $query_id;

    /**
     * MySqli_DB constructor.
     */
    function __construct()
    {
        $this->db_connect();
    }

    /**
     * Makes connection to the database.
     */
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

    /**
     * Disconnects from the database
     */
    public function db_disconnect()
    {
        if (isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    /**
     * Runs a SQL squery
     * @param $sql
     *      The sql command
     * @return mixed
     *      The query result or dies.
     */
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

    /**
     * Gets the insert ID
     *
     * @return int|string
     *      The insert ID
     */
    public function insert_id()
    {
        return mysqli_insert_id($this->connection);
    }


    /**
     * MySQLI fetch array
     *
     * @param $statement
     *      The sql statement result
     * @return array|null
     *      The array of the results
     */
    public function fetch_array($statement)
    {
        return mysqli_fetch_array($statement);
    }

    /**
     * Fetches the DB object.
     *
     * @param $statement
     *      The sql statement result
     * @return null|object
     *      the result object
     */
    public function fetch_object($statement)
    {
        return mysqli_fetch_object($statement);
    }

    /**
     * The number of resulting rows
     *
     * @param $statement
     *      The SQL statement result
     * @return int
     *      Gets the number of result rows
     */
    public function num_rows($statement)
    {
        return mysqli_num_rows($statement);
    }

    /**
     * Gets the number of affected rows
     *
     * @return int
     *      The number of changed rows
     */
    public function affected_rows()
    {
        return mysqli_affected_rows($this->connection);
    }

    /**
     * Gets an escaped string
     * @param $str
     *      The passed in string
     * @return mixed
     *      The escaped string
     */
    public function get_escape_string($str)
    {
        return $this->connection->real_escape_string($str);
    }

    /**
     * Runs a while loop on a SQL result
     *
     * @param $loop
     *      The SQL result
     * @return array
     *      The array of results
     */
    public function while_loop($loop)
    {
        global $db;
        $results = array();
        while ($result = $this->fetch_array($loop)) {
            $results[] = $result;
        }
        return $results;
    }

    /**
     * Fetches the associative array
     *
     * @param $statement
     *      The SQL statement result
     * @return array|null
     *      The associate arrays
     */
    public function fetch_associative_array($statement)
    {
        return mysqli_fetch_assoc($statement);
    }


}

$db = new MySqli_DB();

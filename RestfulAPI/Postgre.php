<?php

class Postgre {

    private $linkid;    // PostgreSQL link identifier
    private $host;      // PostgreSQL server host
    private $port;      // PostgreSQL server port
    private $user;      // PostgreSQL user
    private $password;  // PostgreSQL password
    private $db;        // PostgreSQL database
    private $result;    // Query result

    /* Class constructor. Initializes the $host, $user, $password and $db fields. */
    function __construct($host, $port, $user, $password, $db) {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
    }

    /* Connects to the PostgreSql Database */
    public function connect() {
        try {
            $this->linkid = @pg_connect("host=$this->host port=$this->port dbname=$this->db user=$this->user 
                password=$this->password");
            if (!$this->linkid) {
                throw new Exception("Could not connect to PostgreSQL server.");
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    /* Execute database query. */
    public function query($query) {
        try {
            $this->result = @pg_query($this->linkid, $query);
            if (!$this->result) {
                throw new Exception("The database query failed.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->result;
    }

    /* Determine total rows affected by query. */
    public function affectedRows() {
        $count = @pg_affected_rows($this->linkid);
        return $count;
    }

    /* Determine total rows returned by query */
    public function numRows() {
        $count = @pg_num_rows($this->result);
        return $count;
    }

    /* Return query result row as an object. */
    public function fetchObject() {
        $row = @pg_fetch_object($this->result);
        return $row;
    }

    /* Return query result row as an indexed array. */
    public function fetchRow() {
        $row = @pg_fetch_row($this->result);
        return $row;
    }

    /* Return query result row as an associated array. */
    public function fetchArray() {
        $row = @pg_fetch_array($this->result);
        return $row;
    }

    /* Return all query result as an array */
    public function fetchAll() {
        $all = @pg_fetch_all($this->result);
        return $all;
    }

    /* Return the number of fields in a result set */
    public function numberFields() {
        $count = @pg_num_fields($this->result);
        return $count;
    }

    /* Return a field name given an integer offset. */
    public function fieldName($offset) {
        $field = @pg_field_name($this->result, $offset);
        return $field;
    }

    public function getResultAsTable() {
        if ($this->numRows() > 0) {
            /* Start the table */
            $resultHTML = "<table border='1'>\n<tr>\n";

            /* Output the table headers */
            $fieldCount = $this->numberFields();
            for ($i = 0; $i < $fieldCount; $i++) {
                $rowName = $this->fieldName($i);
                $resultHTML .= "<th>$rowName</th>";
            } // end for

            /* Close the row */
            $resultHTML .= "</tr>\n";

            /* Output the table data */
            while ($row = $this->fetchRow()) {
                $resultHTML .= "<tr>\n";
                for ($i = 0; $i < $fieldCount; $i++) {
                    $resultHTML .= "<td>" . htmlentities($row[$i]) . "</td>";
                }
                $resultHTML .="</tr>\n";
            }

            /* Close the table */
            $resultHTML .= "</table>";
        } else {
            $resultHTML = "<p>No Results Found</p>";
        }
        return $resultHTML;
    }
    
    /* Example 
    public function getAllCities() {
        if ($this->connection == NULL) {
            return;
        }

        $query = 'SELECT * FROM "Cities" ';
        $result = pg_query($this->connection, $query);

        while ($row = pg_fetch_array($result, Null, PGSQL_ASSOC)) {
            print "City ID: $row[cityid]  Name: $row[city]";
            print "<br />\n";
        }
    }
    */
}
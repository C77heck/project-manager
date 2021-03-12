<?php

class Database
{

    /**
     * Get the database connection
     *
     * @return PDO object Connection to the database server
     */

    // protected props
    protected $db_host;
    protected $db_name;
    protected $db_user;
    protected $db_pass;

    /**
     * Constructor
     *
     * @param string $host Hostname
     * @param string $name Database name
     * @param string $user Username
     * @param string $password Password
     *
     * @return void
     */
    public function __construct($host, $name, $user, $password)
    {
        $this->db_host = $host;
        $this->db_name = $name;
        $this->db_user = $user;
        $this->db_pass = $password;

    }

    public function getConn()
    {
        $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=utf8';

        try {
            $db = new PDO($dsn, $this->db_user, $this->db_pass);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}

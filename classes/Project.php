<?php

/**
 * projects database handler class
 * 
 */
class Project
{

    //private props
    private $db;

    //public props
    public $id;
    public $title;
    public $description;
    public $status;
    public $owner_name;
    public $owner_email;


    public function __construct($db)
    {
        $this->db = $db;
    }


    /**
     * Get a count of the total number of records from the filtered array
     *
     * @param object $db Connection to the database
     *
     * @return integer The total number of records
     */
    public static function getFilterCount($db, $status)
    {

        $sql = "SELECT COUNT(*) FROM project_status_pivot WHERE status_id = {$status}";

        return $db->query($sql)->fetchColumn();
    }


    /**
     * get filtered projects
     *
     * @param object $db Connection to the database
     *
     * @return array An associative array of the page of projects records
     */
    public static function filterByStatus($db, $limit, $offset, $status)
    {
        // query string
        $sql = "SELECT p.*, statuses.name AS status,
        owners.name AS owner_name,
        owners.email AS owner_email
        FROM (
            SELECT *
            FROM projects
            ORDER BY title
            LIMIT :limit
            OFFSET :offset) AS p
        INNER JOIN project_status_pivot AS psp 
        ON p.id = psp.project_id AND psp.status_id = :status
        INNER JOIN statuses
        ON psp.status_id = statuses.id
        INNER JOIN project_owner_pivot AS pop
        ON p.id = pop.project_id
        INNER JOIN owners
        ON pop.owner_id = owners.id";
        // prep statement
        $stmt = $db->prepare($sql);
        // bind values
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':status', $status, PDO::PARAM_INT);

        // execute statement
        $stmt->execute();
        // fetch results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Get status table
     *
     * @param object $db Connection to the database
     *
     * @return array An associative array of the page of projects records
     */
    public static function getStatus($db)
    {
        return  $db->query("SELECT * FROM statuses")->fetchAll();
    }

    /**
     * Get a count of the total number of records
     *
     * @param object $db Connection to the database
     *
     * @return integer The total number of records
     */
    public static function getProjectCount($db)
    {
        return $db->query("SELECT COUNT(*) FROM projects")->fetchColumn();
    }
    /**
     * Get a page of projects
     *
     * @param object $conn Connection to the database
     * @param integer $limit Number of records to return
     * @param integer $offset Number of records to skip
     *
     * @return array An associative array of the page of projects records
     */
    public static function getPage($db, $limit, $offset)
    {
        // query string
        $sql = "SELECT p.*, statuses.name AS status,
              owners.name AS owner_name,
              owners.email AS owner_email
              FROM (
                  SELECT *
                  FROM projects
                  ORDER BY title
                  LIMIT :limit
                  OFFSET :offset) AS p
              INNER JOIN project_status_pivot AS psp 
              ON p.id = psp.project_id
              INNER JOIN statuses
              ON psp.status_id = statuses.id
              INNER JOIN project_owner_pivot AS pop
              ON p.id = pop.project_id
              INNER JOIN owners
              ON pop.owner_id = owners.id";
        // prep statement
        $stmt = $db->prepare($sql);
        // bind values
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        // execute statement
        $stmt->execute();
        // fetch results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     *get project by id

     * @param class $db connection to database* 
     * @param integer $id project id value
     *
     * @return object
     */
    public static function getById($db, $id)
    {

        $sql = "SELECT p.*, statuses.key AS status,
                owners.name AS owner_name,
                owners.email AS owner_email
                FROM (
                    SELECT *
                    FROM projects
                    WHERE id = :id) AS p
                INNER JOIN project_status_pivot AS psp 
                ON p.id = psp.project_id
                INNER JOIN statuses
                ON psp.status_id = statuses.id
                INNER JOIN project_owner_pivot AS pop
                ON p.id = pop.project_id
                INNER JOIN owners
                ON pop.owner_id = owners.id";
        // prep statement
        $stmt = $db->prepare($sql);
        // bind value to the placeholder
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        // set fetch to return an object
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // execute  statement and fetch the object.
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }
    /**
     *get project by id

     * @param class db connection to database* 
     * @param integer $id project id value
     *
     * @return 
     */
    public static function delete($db, $id)
    {
        try {
            $sql = "DELETE FROM projects WHERE id = :id";
            // prep statement
            $stmt = $db->prepare($sql);
            // bind id value
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            // execute the query
            if ($stmt->execute()) {
                echo 'deleted successfully';
            }
        } catch (Exception $e) {

            echo $e;
        }
    }

    /**
     * create new project
     *
     * @return boolean checks if statement was executed succesfully or not
     */
    public function create()
    {

            // we set the id to null to condition how the setOwner and setStatus functions will work
            $this->id = NULL;

            $sql = "INSERT INTO projects (title, description)
                VALUES (:title, :description)";
            // prepare statement
            $stmt = $this->db->prepare($sql);
            // bind values
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);

            // execute
            if ($stmt->execute()) {
                $this->id =  $this->db->lastInsertId();
                if ($this->setStatus()) {
                    if ($this->doesOwnerExist()) {
                        return true;
                    }
                }
            }

    }
    /**
     * update existing project
     *
     * @return boolean checks if statement was executed succesfully or not
     */
    public function update($id)
    {
        // we set the class id prop 
        $this->id = $id;

        $sql = "UPDATE projects
            SET title = :title,
            description = :description
            WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            if ($this->setStatus()) {
                if ($this->doesOwnerExist()) {
                    return true;
                }
            }
        }
    }
    /**
     * update existing owner 
     *
     * @return boolean checks if statement was executed succesfully or not
     */

    public function updateOwner()
    {
        $sql = "UPDATE owners
        SET name = :name
        WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':email', $this->owner_email, PDO::PARAM_STR);
        $stmt->bindValue(':name', $this->owner_name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
    }


    /**
     * sets the bridge table values for the new project with its status
     * 
     * @return boolean checks if statement was executed succesfully or not
     */
    public function setStatus()
    {


        if ($this->id != NULL) {
            $sql = " DELETE FROM project_status_pivot 
                    WHERE project_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $sql = "INSERT INTO project_status_pivot (project_id, status_id)
            VALUES (:id, (SELECT id 
            FROM statuses 
            WHERE statuses.key = :status))";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
                $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    return true;
                }
            }
        } else {
            $sql = "INSERT INTO project_status_pivot (project_id, status_id)
            VALUES (:id, (SELECT id 
            FROM statuses 
            WHERE statuses.key = :status))";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            }
        }
    }


    /**
     * checks if owner exists if not it creates a new owner
     * 
     * @return boolean checks if owner has been created succesfully or if the owner already exists
     */

    public function doesOwnerExist()
    {
        // CHECK IF OWNER EXISTS
        $sql = "SELECT *
                FROM owners
                WHERE owners.email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $this->owner_email, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $owner = $stmt->fetch();
        if ($owner) { // if owner exists
            if ($owner['name'] != $this->owner_name) { // if owner name doesn't match
                if ($this->updateOwner()) {
                    // we call the setOwner method
                    if ($this->setOwner()) {
                        return true;
                    }
                }
            }
        } else {
            // We create a new owner
            $sql = "INSERT INTO owners (name, email)
                VALUES (:name, :email)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email', $this->owner_email, PDO::PARAM_STR);
            $stmt->bindValue(':name', $this->owner_name, PDO::PARAM_STR);
            if ($stmt->execute()) {
                // we call the setOwner method
                if ($this->setOwner()) {
                    return true;
                }
            }
        }
    }

    /**
     * sets the bridge table values for the new project with its owner
     * 
     * @return boolean checks if statement was executed succesfully or not
     */
    public function setOwner()
    {

        if ($this->id != NULL) { // update
            $sql = " DELETE FROM project_owner_pivot 
            WHERE project_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $sql = "INSERT INTO project_owner_pivot (project_id, owner_id)
                           VALUES (:id, (SELECT id 
                           FROM owners 
                           WHERE owners.email = :email))";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':email', $this->owner_email, PDO::PARAM_STR);
                $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    return true;
                }
            }
        } else { // create
            $sql = "INSERT INTO project_owner_pivot (project_id, owner_id)
               VALUES (:id, (SELECT id 
               FROM owners 
               WHERE :email = owners.email))";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email', $this->owner_email, PDO::PARAM_STR);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            }
        }
    }
}

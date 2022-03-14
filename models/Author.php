<?php

class Author {
    // DB stuff
    private $conn;
    private $table = 'authors';

    // Properties
    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = 'INSERT INTO ' . $this->table. '
            SET author = :name';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Bind data
        $stmt->bindParam(':name', $this->name);

        // Execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Get Authors
    function read() {
        $query = 'SELECT *
            FROM ' . $this->table . '
            ORDER BY id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    // read a single author
    // sets this object value to the author
    function read_single() {
        $query = 'SELECT *
            FROM ' . $this->table . '
            WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(':id', $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties if row exists
        if ($row) { $this->name = $row['author']; }
    }

    function update() {
        $query = 'UPDATE ' . $this->table . '
            SET author = :author
            WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':author', $this->name);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    function delete()
    {
        $query = '  DELETE FROM ' . $this->table . '
        WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


}
?>
<?php

class Quote {
    // DB stuff
    private $conn;
    private $table = 'quotes';

    // Properties
    public $id;
    public $theQuote;
    public $theAuthor;
    public $theCategory;
    public $authorId;
    public $categoryId;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = 'INSERT INTO ' . $this->table . ' (quote, authorId, categoryId) 
            VALUES (:quote, :authorId, :categoryId);';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->theQuote = htmlspecialchars(strip_tags($this->theQuote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

        // Bind values
        $stmt->bindParam(':quote', $this->theQuote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        // Execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        // Print error if something goes wrong
        printf("ErrorL %s.\n", $stmt->error);
        return false;

    }

    // query returns json object of all quotes in the db
    function read() {
        $query = 'SELECT q.id, q.quote, a.author, c.category 
            FROM ' . $this->table . ' q 
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id;';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    // query returns all quotes from the matching authorId
    function read_author() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a on  q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id
            WHERE a.id = :authorId';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(':authorId', $this->authorId);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    // query returns all quotes from the matching category
    function read_category() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a on  q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id
            WHERE c.id = :categoryId';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(':categoryId', $this->categoryId);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    // query returns all quotes from the matching author and category
    function read_author_and_category() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a on  q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id
            WHERE a.id = :authorId AND c.id = :categoryId';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(':categoryId', $this->categoryId);
        $stmt->bindParam(':authorId', $this->authorId);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    // query returns a single quote based on the quote id
    function read_single() {
        $query = 'SELECT q.id, q.quote, a.author, c.category, a.id AS "authorId", c.id AS "categoryId"
            FROM ' . $this->table . ' q
            LEFT JOIN authors a on  q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id
            WHERE q.id = :id;';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(':id', $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties if row exists
        if ($row) { 
            $this->theQuote = $row['quote'];
            $this->theAuthor = $row['author'];
            $this->theCategory = $row['category'];
            $this->authorId = $row['authorId'];
            $this->categoryId = $row['categoryId'];
        }
    }

    function update() {
        $query = 'UPDATE ' . $this->table . ' 
            SET quote = :quote, 
                authorId = :authorId, 
                categoryId = :categoryId
            WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->theQuote = htmlspecialchars(strip_tags($this->theQuote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

        // Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->theQuote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    function delete() {
        $query = 'DELETE FROM ' . $this->table . '
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
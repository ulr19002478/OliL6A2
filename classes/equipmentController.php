<?php

class equipmentController {

    protected $db; // Property to store the database controller object

    // Constructor to initialize the equipmentController with a database controller object
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    // Function to create a new equipment entry in the database
    public function create_equipment(array $equipment) 
{
    // SQL query to insert new equipment data into the equipments table
    $sql = "INSERT INTO equipments(name, description, image, catergory_id, supplier_id)
            VALUES (:name, :description, :image, :catergory_id, :supplier_id);";
    
    // Execute the SQL query with the provided equipment data
    $this->db->runSQL($sql, $equipment);
    
    // Return the ID of the last inserted equipment
    return $this->db->lastInsertId();
}

    // Function to retrieve a specific equipment by its ID
    public function get_equipment_by_id(int $id)
    {
        // SQL query to select equipment data by ID
        $sql = "SELECT * FROM equipments WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the query and return the result
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Function to retrieve all equipment entries from the database
    public function get_all_equipments()
{
    // Fetch all equipment entries
    $equipments = $this->db->runSQL("SELECT * FROM equipments")->fetchAll();

    // Iterate through each equipment entry
    foreach ($equipments as &$equipment) {
        // Fetch category details
        $catergory = $this->db->runSQL("SELECT * FROM categories WHERE id = ?", [$equipment['catergory_id']])->fetch();
        // Fetch supplier details
        $supplier = $this->db->runSQL("SELECT * FROM suppliers WHERE id = ?", [$equipment['supplier_id']])->fetch();

        // Add category and supplier details to the equipment entry
        $equipment['catergory_name'] = $catergory ? $catergory['name'] : null;
        $equipment['supplier_name'] = $supplier ? $supplier['name'] : null;
    }

    return $equipments;
}

    // Function to update an existing equipment entry in the database
    // Function to update an existing equipment entry in the database
public function update_equipment(array $equipment)
{
    // SQL query to update equipment data
    $sql = "UPDATE equipments SET name = :name, description = :description, image = :image, 
            supplier_id = :supplier_id, catergory_id = :catergory_id WHERE id = :id";
    
    // Execute the update query with the provided equipment data
    return $this->db->runSQL($sql, $equipment)->execute();
}

    // Function to delete a specific equipment entry by its ID
    public function delete_equipment(int $id)
    {
        // SQL query to delete equipment data by ID
        $sql = "DELETE FROM equipments WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the delete query
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>

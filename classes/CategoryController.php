<?php

class CategoryController
{
    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    public function create_category(array $category_data)
    {
        $sql = "INSERT INTO categories (name) VALUES (:name)";
    
        try {
            $this->db->runSQL($sql, $category_data);
    
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return false; 
            }
            throw $e; 
        }
    }

    public function get_category_by_id(int $category_id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $args = ['id' => $category_id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_all_categories()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->runSQL($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_category(array $category_data)
    {
        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        return $this->db->runSQL($sql, $category_data)->execute();
    }

    public function delete_category(int $category_id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $args = ['id' => $category_id];
        return $this->db->runSQL($sql, $args)->execute();
    }
}
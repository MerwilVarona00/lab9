<?php

namespace App\Models;

use App\Models\BaseModel;
use \PDO;

class Customer extends BaseModel
{
    // Retrieve all customers
    public function all()
    {
        $sql = "SELECT * FROM customers"; // Ensure you have a customers table
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, '\App\Models\Customer');
    }

    // Get a single customer by ID
    public function getCustomer($id)
    {
        $sql = "SELECT * FROM customers WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetchObject('\App\Models\Customer');
    }

    // Update customer information
    public function update()
    {
        $sql = "UPDATE customers SET name = :name WHERE id = :id"; // Adjust according to your fields
        $statement = $this->db->prepare($sql);
        return $statement->execute(['name' => $this->name, 'id' => $this->id]);
    }

    // Optionally, fill method to set properties (add if needed)
    public function fill($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}

<?php
// Include the functions file for necessary functions and classes
require_once './inc/functions.php';

// Retrieve all equipment data using the equipment controller
$suppliers = $controllers->suppliers()->get_all_suppliers();
?>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Suppliers</h2> 
    <div class="mb-3">
    </div>
    <table class="table table-striped"> 
        <thead>
            <tr>
                <th>ID</th> 
                <th>Company Name</th> 
                <th>Contact Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier): ?> <!-- Loop through each equipment item -->
                <tr>

                    <td><?= htmlspecialchars($supplier['id']) ?></td> 
                    <td><?= htmlspecialchars($supplier['name']) ?></td> 
                    <td><?= htmlspecialchars($supplier['contact_email']) ?></td>
                    <td>
                        <a href="supplier_update.php?id=<?= htmlspecialchars($supplier['id']) ?>" class="btn btn-primary">Edit</a>


                        <a href="delete_suppliers.php?id=<?= htmlspecialchars($supplier['id']) ?>" class="btn btn-primary">Delete</a>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
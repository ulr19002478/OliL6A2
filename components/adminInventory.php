<?php
// Include the functions file for necessary functions and classes
require_once './inc/functions.php';

// Retrieve all equipment data using the equipment controller
$equipment = $controllers->equipment()->get_all_equipments();
?>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Equipment Inventory</h2> 
    <div class="mb-3">
        <!-- Button to navigate to the Add Equipment form -->
        <a href="addEquipment.php" class="btn btn-primary">Add Equipment</a>
    </div>
    <table class="table table-striped"> 
        <thead>
            <tr>
                <th>Image</th> 
                <th>Name</th> 
                <th>Description</th>
                <th>Category</th> <!-- New column for category -->
                <th>Supplier</th> <!-- New column for supplier -->
                <th>Actions</th> <!-- New column for edit and delete buttons -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipment as $equip): ?> <!-- Loop through each equipment item -->
                <tr>
                    <td>
                        <img src="<?= htmlspecialchars($equip['image'] ?? '') ?>"
                             alt="Image of <?= htmlspecialchars($equip['description'] ?? '') ?>" 
                             style="width: 100px; height: auto;"> 
                    </td>
                    <td><?= htmlspecialchars($equip['name'] ?? '') ?></td> 
                    <td><?= htmlspecialchars($equip['description'] ?? '') ?></td>
                    <td><?= isset($equip['catergory_name']) ? htmlspecialchars($equip['catergory_name']) : '' ?></td>
                    <td><?= isset($equip['supplier_name']) ? htmlspecialchars($equip['supplier_name']) : '' ?></td>
                    <td>
                        <a href="equipment_update.php?id=<?= htmlspecialchars($equip['id'] ?? '') ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_equipment.php?id=<?= htmlspecialchars($equip['id'] ?? '') ?>" class="btn btn-primary">Delete</a>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// Include the functions file for necessary functions and classes
require_once './inc/functions.php';

// Retrieve all equipment data using the equipment controller
$categories = $controllers->categories()->get_all_categories();
?>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Manage Categories</h2> 
    <div class="mb-3">
    </div>
    <table class="table table-striped"> 
        <thead>
            <tr>
                <th>ID</th> 
                <th>Category</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?> <!-- Loop through each equipment item -->
                <tr>

                    <td><?= htmlspecialchars($category['id']) ?></td> 
                    <td><?= htmlspecialchars($category['name']) ?></td> 
                    <td>
                        <a href="categoriesUpdate.php?id=<?= htmlspecialchars($category['id'] ?? '') ?>" class="btn btn-primary">Edit</a>


                        <a href="delete_categories.php?id=<?= htmlspecialchars($category['id']) ?>" class="btn btn-primary">Delete</a>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
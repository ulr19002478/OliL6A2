<?php
// Include the functions file for utility functions
require_once './inc/functions.php';

// Retrieve all suppliers and categories data using the respective controllers
$suppliers = $controllers->suppliers()->get_all_suppliers();
$categories = $controllers->categories()->get_all_categories();

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the submitted form data
    $name = InputProcessor::processString($_POST['name']);
    $description = InputProcessor::processString($_POST['description']);
    $image = InputProcessor::processString($_POST['image']);
    $supplier_id = InputProcessor::processString($_POST['supplier_id']);
    $catergory_id = InputProcessor::processString($_POST['catergory_id']); // Keep the original name

    // Validate all inputs
    $valid = $name['valid'] && $description['valid'] && $image['valid'] && $supplier_id['valid'] && $catergory_id['valid'];

    // Set an error message if any input is invalid
    $message = !$valid ? "Please fix the above errors:" : '';

    // If all inputs are valid, proceed with adding new equipment
    if ($valid) {
        // Prepare the data for adding a new equipment
        $args = [
            'name' => $name['value'],
            'description' => $description['value'],
            'image' => $image['value'],
            'supplier_id' => $supplier_id['value'],
            'catergory_id' => $catergory_id['value'], // Use the correct name
        ];

        // Create new equipment in the database
        $newEquipmentId = $controllers->equipment()->create_equipment($args);

        if ($newEquipmentId) {
            // Redirect to the inventory page after successful addition
            redirect('adminInventory');
        } else {
            // Set an error message if the addition fails
            $message = 'Failed to add new equipment. Please try again.';
        }
    }
}
?>

<!-- HTML form for adding new equipment -->
<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <section class="vh-100">
        <div class="container py-5 h-75">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-2">Add New Equipment</h3>
                            <div class="form-outline mb-4">
                                <input required type="text" id="name" name="name" class="form-control form-control-lg"
                                    placeholder="Name" value="<?= htmlspecialchars($name['value'] ?? '') ?>" />
                                <small class="text-danger"><?= htmlspecialchars($name['error'] ?? '') ?></small>
                            </div>

                            <div class="form-outline mb-4">
                                <input required type="text" id="description" name="description"
                                    class="form-control form-control-lg" placeholder="Description"
                                    value="<?= htmlspecialchars($description['value'] ?? '') ?>" />
                                <small class="text-danger"><?= htmlspecialchars($description['error'] ?? '') ?></small>
                            </div>

                            <div class="form-outline mb-4">
                                <input required type="text" id="image" name="image" class="form-control form-control-lg"
                                    placeholder="Image" value="<?= htmlspecialchars($image['value'] ?? '') ?>" />
                                <small class="text-danger"><?= htmlspecialchars($image['error'] ?? '') ?></small>
                            </div>

                            <!-- Supplier Selection Dropdown -->
                            <div class="form-group">
                                <label for="supplier">Supplier:</label>
                                <select class="form-control" id="supplier" name="supplier_id">
                                    <?php foreach ($suppliers as $supplier) : ?>
                                        <option value="<?= htmlspecialchars($supplier['id']) ?>">
                                            <?= htmlspecialchars($supplier['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Category Selection Dropdown -->
                            <div class="form-group">
                                <label for="catergory">Catergory:</label>
                                <select class="form-control" id="catergory" name="catergory_id">
                                    <?php foreach ($categories as $catergory) : ?>
                                        <option value="<?= htmlspecialchars($catergory['id']) ?>">
                                            <?= htmlspecialchars($catergory['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Add Equipment</button>

                            <?php if ($message): ?>
                                <div class="alert alert-danger mt-4">
                                    <?= $message ?? '' ?>
                                </div>
                            <?php endif ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

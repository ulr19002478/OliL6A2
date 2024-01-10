<?php
// Include the functions file for utility functions
require_once './inc/functions.php';

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the submitted form data
    $name = InputProcessor::processString($_POST['name']);
    $description = InputProcessor::processString($_POST['description']);
    $image = InputProcessor::processString($_POST['image']);

    // Validate all inputs
    $valid = $name['valid'] && $description['valid'] && $image['valid'];

    // Set an error message if any input is invalid
    $message = !$valid ? "Please fix the above errors:" : '';

    // If all inputs are valid, proceed with adding new equipment
    if ($valid) {
        // Prepare the data for adding a new equipment
        $args = [
            'name' => $name['value'],
            'description' => $description['value'],
            'image' => $image['value'],
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

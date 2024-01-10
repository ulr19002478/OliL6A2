<?php
// Include the functions file for utility functions
require_once './inc/functions.php';

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  // Process the submitted form data
  $name = InputProcessor::processString($_POST['name']);
  $description =  InputProcessor::processString($_POST['description']);
  $image =  InputProcessor::processString($_POST['image']);

  
  // Validate all inputs
  $valid = $name['valid'] && $description['valid'] && $image['valid'];

  // Set an error message if any input is invalid
  $message = !$valid ? "Please fix the above errors:" : '';

  // If all inputs are valid, proceed with registration
  if ($valid)
  {
    // Prepare the data for registration
    $args = ['name' => $name['value'],
             'description' => $description['value'],
             'image' => $image['value'],
             'id' => $_POST['id']];

             print_r($args);

    $controllers->equipment()->update_equipment($args);

    redirect('adminInventory');
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
$equipment = $controllers->equipment()->get_equipment_by_id($_GET['id']);
}

?>



<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-2">Update Equipment</h3>
              <div class="form-outline mb-4">
                <input required type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Name" value="<?= htmlspecialchars($equipment['name'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($name['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="description" name="description" class="form-control form-control-lg" placeholder="Description" value="<?= htmlspecialchars($equipment['description'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($description['error'] ?? '') ?></small>
              </div>


              <div class="form-outline mb-4">
                <input required type="text" id="image" name="image" class="form-control form-control-lg" placeholder="Image" value="<?= htmlspecialchars($equipment['image'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($image['error'] ?? '') ?></small>
              </div>
              <input type="hidden" id="id" name="id" value="<?= $equipment['id'] ?>"/>



              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Update</button>


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